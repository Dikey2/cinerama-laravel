<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\SeatLock;
use App\Models\SeatReservation;
use App\Models\Showtime;

class ReservaController extends Controller
{
    /**
     * 🟥 Registrar butacas en BD al confirmar reserva (flujo tradicional)
     */
    public function reservar(Request $request, $showtime_id)
    {
        $seats = $request->input('seats', []);

        if (!is_array($seats) || count($seats) === 0) {
            return redirect()->back()->with('error', 'No seleccionaste butacas.');
        }

        foreach ($seats as $seat) {
            SeatReservation::updateOrCreate(
                [
                    'showtime_id' => $showtime_id,
                    'seat'        => $seat
                ],
                [
                    'status'     => 'reserved',     // reservado, pero no pagado
                    'user_id'    => auth()->id(),
                ]
            );
        }

        return redirect()->route('carrito.index')
            ->with('success', 'Asientos reservados correctamente ✔️');
    }


    /**
     * 🟡 AGREGA AL CARRITO LAS ENTRADAS SELECCIONADAS
     */
    private function agregarEntradasAlCarrito()
    {
        $entradas = Session::get('reserva.entradas', []);
        $seats    = Session::get('reserva.seats', []);
        $cart     = Session::get('cart', []);

        foreach ($entradas as $e) {
            $key = "entrada_" . Str::slug($e['nombre']);

            $cart[$key] = [
                'name'  => "Entrada {$e['nombre']} (" . implode(', ', $seats) . ")",
                'price' => $e['precio'],
                'image' => "/images/ticket.png",
                'qty'   => $e['cantidad'],
            ];
        }

        Session::put('cart', $cart);
    }


    /**
     * 🎭 MOSTRAR ASIENTOS + bloqueos + ocupados
     */
    public function asientos($showtime_id)
    {
        $showtime = Showtime::with(['movie','cinema'])->findOrFail($showtime_id);

        $rows = range('A', 'I');
        $cols = range(1, 12);

        // 🟥 ASIENTOS YA COMPRADOS
        $takenSeats = SeatReservation::where('showtime_id', $showtime_id)
            ->pluck('seat')
            ->toArray();

        // 🔒 ASIENTOS BLOQUEADOS TEMPORALMENTE
        $seatLocks = SeatLock::where('showtime_id', $showtime_id)
            ->where('expires_at', '>', now())
            ->pluck('seat')
            ->toArray();

        return view('reserva.asientos', compact(
            'showtime',
            'rows',
            'cols',
            'takenSeats',
            'seatLocks'
        ));
    }


    /**
     * 🧡 Guardar entradas, asientos y carrito vía AJAX
     * ❗ Versión final unificada
     */
    public function guardarEntradas(Request $request)
    {
        $request->validate([
            'cine_id'      => 'required|integer',
            'showtime_id'  => 'required|integer',
            'seats'        => 'required|array',
            'entradas'     => 'required|array'
        ]);

        // Guardar en sesión
        session([
            'reserva.cine'      => $request->cine_id,
            'reserva.showtime'  => $request->showtime_id,
            'reserva.seats'     => $request->seats,
            'reserva.entradas'  => $request->entradas,
        ]);

        // 🟧 Guardar asientos en BD como reservados temporalmente
        foreach ($request->seats as $seat) {
            SeatReservation::updateOrCreate(
                [
                    'showtime_id' => $request->showtime_id,
                    'seat'        => $seat
                ],
                [
                    'status'  => 'reserved',
                    'user_id' => auth()->id()
                ]
            );
        }

        // 🟨 Agregar entradas al carrito
        $this->agregarEntradasAlCarrito();

        return response()->json([
    'success' => true,
    'cinema_id' => $request->cine_id
]);

    }
}





