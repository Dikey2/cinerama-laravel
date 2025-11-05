<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservaController extends Controller
{
    // ⏳ Reservar temporalmente por 5 minutos
    public function reservar(Request $request)
    {
        $pelicula = $request->pelicula;
        $cine = $request->cine;
        $ciudad = $request->ciudad;
        $hora = $request->hora;
        $butacas = $request->butacas; // array de ['A5','A6']

        $limite = Carbon::now()->addMinutes(5);

        foreach ($butacas as $butaca) {
            DB::table('reservas')->updateOrInsert(
                [
                    'pelicula' => $pelicula,
                    'cine' => $cine,
                    'ciudad' => $ciudad,
                    'hora' => $hora,
                    'butaca' => $butaca,
                ],
                [
                    'estado' => 'reservada',
                    'reservado_hasta' => $limite,
                    'created_at' => now(),
                ]
            );
        }

        return response()->json(['success' => true, 'limite' => $limite->toDateTimeString()]);
    }

    // 🔓 Liberar si se cancela o expira el tiempo
    public function liberar(Request $request)
    {
        DB::table('reservas')
            ->whereIn('butaca', $request->butacas)
            ->where('estado', 'reservada')
            ->delete();

        return response()->json(['success' => true]);
    }

    // ✅ Confirmar compra (ocupar butacas)
    public function confirmar(Request $request)
    {
        DB::table('reservas')
            ->whereIn('butaca', $request->butacas)
            ->update(['estado' => 'ocupada']);

        return response()->json(['success' => true]);
    }
}
