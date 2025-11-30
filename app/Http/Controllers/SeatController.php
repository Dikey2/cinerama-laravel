<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\SeatReservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeatController extends Controller
{
    // ============================================================
    // 🟦 1. MOSTRAR MAPA DE BUTACAS
    // ============================================================
    public function show(Showtime $showtime)
{
    // 🔥 Liberar bloqueos de 5 min o pagos vencidos de 10 min
    SeatReservation::where('showtime_id', $showtime->id)
        ->whereIn('status', ['reserved', 'paid'])
        ->where('expires_at', '<', now())
        ->delete();

    // Obtener butacas ocupadas válidas
    $takenSeats = SeatReservation::where('showtime_id', $showtime->id)
        ->whereIn('status', ['reserved', 'paid'])
        ->pluck('seat')
        ->toArray();

    $rows = range('A', 'J');
    $cols = range(1, 12);

    return view('funciones.butacas', compact('showtime', 'takenSeats', 'rows', 'cols'));
}


    // ============================================================
    // 🟩 2. RESERVAR → LOGIN (SI YA COMPRÓ) → ENTRADAS
    // ============================================================
    public function reserve(Request $request, Showtime $showtime)
{
    $data = $request->validate([
        'seats' => 'required|array|min:1',
        'seats.*' => 'string',
    ]);

    // Guardar en sesión
    session([
        'reserva.showtime' => $showtime->id,
        'reserva.seats'    => $data['seats']
    ]);

    // ⏳ Bloqueo temporal de 5 minutos
    $expiresAt = now()->addMinutes(5);

    foreach ($data['seats'] as $seat) {
        SeatReservation::updateOrCreate(
            [
                'showtime_id' => $showtime->id,
                'seat'        => $seat,
            ],
            [
                'status'     => 'reserved', // bloqueo temporal
                'user_id'    => auth()->id(),
                'expires_at' => $expiresAt,
            ]
        );
    }

    // Si no está logueado → redirigir a login
    if (!auth()->check()) {
        return redirect()->route('login')
            ->with('info', 'Inicia sesión o continúa como invitado.');
    }

    return redirect()->route('asientos.entradas', $showtime);
}

    // ============================================================
    // 🟦 3. PANTALLA DE ENTRADAS
    // ============================================================
    public function entradas(Showtime $showtime)
{
    $seats = session('reserva.seats');

    if (!$seats) {
        return redirect()->route('peliculas')
            ->with('error', 'No seleccionaste butacas.');
    }

    return view('funciones.entradas', [
        'showtime'     => $showtime,
        'seats'        => $seats,
        'totalButacas' => count($seats),
    ]);
}




    // ============================================================
    // 🟧 5. PROCESAR BENEFICIOS (opcional)
    // ============================================================
    public function beneficiosProcesar()
    {
        $showtimeId = session('reserva.showtime');
        $seats      = session('reserva.seats');

        if (!$showtimeId || !$seats) {
            return redirect()->route('peliculas')
                ->with('error', 'No hay reservación activa.');
        }

        return redirect()->route('carrito.index')
            ->with('success', 'Entradas agregadas al carrito ✔️');
    }


    // ============================================================
    // 🟥 6. CONFIRMAR RESERVA
    // ============================================================
    public function confirm(Request $request, Showtime $showtime)
    {
        $seats = session('reserva.seats');

        if (!$seats) {
            return redirect()->route('peliculas')
                ->with('error', 'No seleccionaste butacas.');
        }

        $pricePerSeat = $showtime->price;
        $total = $pricePerSeat * count($seats);

        $ticket = Ticket::create([
            'showtime_id' => $showtime->id,
            'user_id'     => auth()->id(),
            'seats'       => $seats,
            'total'       => $total,
            'code'        => strtoupper(Str::random(8)),
            'status'      => 'paid',
        ]);

        foreach ($seats as $seat) {
    SeatReservation::updateOrCreate(
        [
            'showtime_id' => $showtime->id,
            'seat'        => $seat
        ],
        [
            'status'     => 'paid',  // reserva confirmada
            'user_id'    => auth()->id(),
            'expires_at' => now()->addMinutes(10), // ⏳ reserva real por 10 minutos
        ]
    );
}


        // Marcar compra como invitado
        if (!auth()->check()) {
            session(['invitado_compra_realizada' => true]);
        }

        session()->forget(['reserva.showtime', 'reserva.seats']);

        return redirect()->route('pedido.exito', ['codigo' => $ticket->code]);
    }


    // ============================================================
    // 🟩 7. GUARDAR ENTRADAS VIA AJAX
    // ============================================================
    public function guardarEntradas(Request $request)
    {
        try {
            $data = $request->validate([
                'entradas'    => 'required|array',
                'seats'       => 'required|array|min:1',
                'showtime_id' => 'required|integer',
                'cine_id'     => 'required|integer',
            ]);

            session([
                'entradas.data'     => $data['entradas'],
                'entradas.seats'    => $data['seats'],
                'entradas.showtime' => $data['showtime_id'],
                'entradas.cine'     => $data['cine_id'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Entradas guardadas correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile()
            ], 500);
        }
    }
}







