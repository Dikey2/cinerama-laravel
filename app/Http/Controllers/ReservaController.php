<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * GET /butacas
     * Muestra la vista con las butacas ocupadas
     */
    public function index(Request $request)
    {
        $pelicula = $request->query('pelicula');
        $cine = $request->query('cine');
        $ciudad = $request->query('ciudad');
        $hora = $request->query('hora');

        // 🧹 Limpia reservas vencidas
        DB::table('reservas')
            ->where('estado', 'reservada')
            ->whereNotNull('reservado_hasta')
            ->where('reservado_hasta', '<', now())
            ->delete();

        // 🧾 Obtener las butacas actualmente ocupadas o reservadas
        $butacasOcupadas = DB::table('reservas')
            ->where('pelicula', $pelicula)
            ->where('cine', $cine)
            ->where('ciudad', $ciudad)
            ->where('hora', $hora)
            ->whereIn('estado', ['reservada', 'ocupada'])
            ->pluck('butaca');

        // 📤 Retornar vista con las butacas ocupadas
        return view('butacas', compact('pelicula', 'cine', 'ciudad', 'hora', 'butacasOcupadas'));
    }

    /**
     * POST /reservar-butacas
     * payload: { pelicula, cine, ciudad, hora, butacas: ["H4","H5"] }
     */
    public function reservar(Request $request)
    {
        $data = $request->validate([
            'pelicula' => 'required|string',
            'cine'     => 'required|string',
            'ciudad'   => 'required|string',
            'hora'     => 'required|string',
            'butacas'  => 'required|array|min:1',
            'butacas.*'=> 'string'
        ]);

        // 1️⃣ Limpia reservas vencidas
        DB::table('reservas')
            ->where('estado', 'reservada')
            ->whereNotNull('reservado_hasta')
            ->where('reservado_hasta', '<', now())
            ->delete();

        $limite = Carbon::now()->addMinutes(5);
        $reservadas = [];
        $rechazadas = [];

        DB::beginTransaction();
        try {
            foreach ($data['butacas'] as $butaca) {
                // 2️⃣ Verifica si ya está ocupada
                $ocupada = DB::table('reservas')->where([
                    'pelicula' => $data['pelicula'],
                    'cine'     => $data['cine'],
                    'ciudad'   => $data['ciudad'],
                    'hora'     => $data['hora'],
                    'butaca'   => $butaca,
                    'estado'   => 'ocupada',
                ])->exists();

                if ($ocupada) {
                    $rechazadas[] = $butaca;
                    continue;
                }

                // 3️⃣ Verifica si está reservada pero aún vigente
                $reservadaVigente = DB::table('reservas')
                    ->where([
                        'pelicula' => $data['pelicula'],
                        'cine'     => $data['cine'],
                        'ciudad'   => $data['ciudad'],
                        'hora'     => $data['hora'],
                        'butaca'   => $butaca,
                        'estado'   => 'reservada',
                    ])
                    ->where('reservado_hasta', '>', now())
                    ->exists();

                if ($reservadaVigente) {
                    $rechazadas[] = $butaca;
                    continue;
                }

                // 4️⃣ Crear o actualizar reserva temporal
                DB::table('reservas')->updateOrInsert(
                    [
                        'pelicula' => $data['pelicula'],
                        'cine'     => $data['cine'],
                        'ciudad'   => $data['ciudad'],
                        'hora'     => $data['hora'],
                        'butaca'   => $butaca,
                    ],
                    [
                        'estado'          => 'reservada',
                        'reservado_hasta' => $limite,
                        'updated_at'      => now(),
                        'created_at'      => now(),
                    ]
                );

                $reservadas[] = $butaca;
            }

            DB::commit();

            return response()->json([
                'success'     => true,
                'limite'      => $limite->toDateTimeString(),
                'reservadas'  => $reservadas,
                'rechazadas'  => $rechazadas,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al reservar butacas: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error interno.'], 500);
        }
    }

    /**
     * POST /liberar-butacas
     * payload: { pelicula, cine, ciudad, hora, butacas: [...] }
     */
    public function liberar(Request $request)
    {
        $data = $request->validate([
            'pelicula' => 'required|string',
            'cine'     => 'required|string',
            'ciudad'   => 'required|string',
            'hora'     => 'required|string',
            'butacas'  => 'required|array|min:1',
            'butacas.*'=> 'string'
        ]);

        DB::table('reservas')
            ->where('pelicula', $data['pelicula'])
            ->where('cine',     $data['cine'])
            ->where('ciudad',   $data['ciudad'])
            ->where('hora',     $data['hora'])
            ->whereIn('butaca', $data['butacas'])
            ->where('estado',   'reservada')
            ->delete();

        return response()->json(['success' => true]);
    }

    /**
     * POST /confirmar-butacas
     * payload: { pelicula, cine, ciudad, hora, butacas: [...] }
     */
    public function confirmar(Request $request)
    {
        $data = $request->validate([
            'pelicula' => 'required|string',
            'cine'     => 'required|string',
            'ciudad'   => 'required|string',
            'hora'     => 'required|string',
            'butacas'  => 'required|array|min:1',
            'butacas.*'=> 'string'
        ]);

        // ✅ Confirmar las butacas reservadas vigentes
        $actualizadas = DB::table('reservas')
            ->where('pelicula', $data['pelicula'])
            ->where('cine',     $data['cine'])
            ->where('ciudad',   $data['ciudad'])
            ->where('hora',     $data['hora'])
            ->whereIn('butaca', $data['butacas'])
            ->where('estado',   'reservada')
            ->where('reservado_hasta', '>', now())
            ->update([
                'estado'     => 'ocupada',
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true, 'confirmadas' => $actualizadas]);
    }
}
