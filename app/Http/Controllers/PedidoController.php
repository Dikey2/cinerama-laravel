<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pedido;
use App\Models\DetallePedido;

class PedidoController extends Controller
{
    public function confirmar(Request $request)
    {
        // ❗ Leer carrito de dulcería
        $cart = session('cart', []);

        // ❗ Leer entradas y butacas
        $entradas = session('reserva.entradas', []);
        $seats = session('reserva.seats', []);

        // ❗ Calculamos subtotales
        $totalDulceria = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);

        $totalEntradas = 0;
        foreach ($entradas as $e) {
            $totalEntradas += $e['precio'] * $e['cantidad'];
        }

        // ❗ Si NO hay nada comprado
        if (empty($cart) && empty($entradas)) {
            return back()->with('error', 'No tienes ningún producto en el pedido.');
        }

        // Validación de datos del cliente
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'correo_cliente' => 'nullable|email',
            'telefono_cliente' => 'nullable|string|max:20',
        ]);

        // ❗ TOTAL FINAL (entradas + dulcería)
        $total = $totalDulceria + $totalEntradas;

        // Crear pedido
        $pedido = Pedido::create([
            'codigo' => 'PED-' . strtoupper(Str::random(6)),
            'nombre_cliente' => $request->nombre_cliente,
            'correo_cliente' => $request->correo_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'total' => $total,
            'estado' => 'pendiente',
        ]);

        // =============================
        // 📌 GUARDAR DETALLES: ENTRADAS
        // =============================
        foreach ($entradas as $e) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto' => "Entrada: " . $e['nombre'] . " (" . implode(', ', $seats) . ")",
                'cantidad' => $e['cantidad'],
                'precio_unitario' => $e['precio'],
                'subtotal' => $e['cantidad'] * $e['precio'],
            ]);
        }

        // =============================
        // 📌 GUARDAR DETALLES: DULCERÍA
        // =============================
        foreach ($cart as $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto' => $item['name'],
                'cantidad' => $item['qty'],
                'precio_unitario' => $item['price'],
                'subtotal' => $item['qty'] * $item['price'],
            ]);
        }

        // Limpiar sesiones
        session()->forget('cart');
        session()->forget('reserva.entradas');
        session()->forget('reserva.seats');

        return redirect()->route('pedido.exito', ['codigo' => $pedido->codigo]);
    }



    public function exito($codigo)
    {
        $pedido = Pedido::where('codigo', $codigo)->firstOrFail();
        return view('carrito.exito', compact('pedido'));
    }
}


