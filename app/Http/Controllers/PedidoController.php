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
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'correo_cliente' => 'nullable|email',
            'telefono_cliente' => 'nullable|string|max:20',
        ]);

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);

        $pedido = Pedido::create([
            'codigo' => 'PED-' . strtoupper(Str::random(6)),
            'nombre_cliente' => $request->nombre_cliente,
            'correo_cliente' => $request->correo_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'total' => $total,
            'estado' => 'pendiente',
        ]);

        foreach ($cart as $item) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto' => $item['name'],
                'cantidad' => $item['qty'],
                'precio_unitario' => $item['price'],
                'subtotal' => $item['qty'] * $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('pedido.exito', ['codigo' => $pedido->codigo]);
    }

    public function exito($codigo)
    {
        $pedido = Pedido::where('codigo', $codigo)->firstOrFail();
        return view('carrito.exito', compact('pedido'));
    }
}

