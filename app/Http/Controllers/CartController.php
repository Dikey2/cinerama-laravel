<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    /** 🔹 Obtener carrito actual desde la sesión */
    private function cart()
    {
        return Session::get('cart', []);
    }

    /** 🔹 Guardar carrito actualizado */
    private function setCart(array $cart)
    {
        Session::put('cart', $cart);
    }

    /** 🛒 Mostrar carrito */
    public function index()
{
    $cart = $this->cart();
    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

    if (request()->ajax()) {
        return view('carrito.index', compact('cart', 'total'))->render();
    }

    return view('carrito.index', compact('cart', 'total'));
}


    /** ➕ Agregar producto al carrito (desde fetch o formulario) */
    public function add(Request $request)
    {
        try {
            // Aceptar JSON y formulario normal
            $data = $request->json()->all();
            $name  = $data['name'] ?? $request->input('name');
            $price = $data['price'] ?? $request->input('price');
            $image = $data['image'] ?? null;
            $qty   = $data['qty'] ?? 1;

            if (!$name || !is_numeric($price)) {
                return response()->json(['success' => false, 'error' => 'Datos inválidos.'], 400);
            }

            $cart = $this->cart();
            $key = Str::slug($name);

            // Si ya existe, solo aumentar cantidad
            if (isset($cart[$key])) {
                $cart[$key]['qty'] += (int)$qty;
            } else {
                $cart[$key] = [
                    'name'  => $name,
                    'price' => (float)$price,
                    'image' => $image,
                    'qty'   => (int)$qty,
                ];
            }

            $this->setCart($cart);

            $count = collect($cart)->sum('qty');
            $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

            // Respuesta JSON para fetch()
            return response()->json([
                'success'  => true,
                'count'    => $count,
                'total'    => $total,
                'redirect' => route('carrito.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /** ♻️ Actualizar cantidad de un producto */
    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = $this->cart();

        if (isset($cart[$request->key])) {
            $cart[$request->key]['qty'] = (int)$request->qty;
            $this->setCart($cart);
        }

        return back()->with('success', 'Cantidad actualizada correctamente.');
    }

    /** ❌ Eliminar producto del carrito */
    public function remove(Request $request)
    {
        $request->validate(['key' => 'required|string']);

        $cart = $this->cart();
        unset($cart[$request->key]);
        $this->setCart($cart);

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    /** 🧹 Vaciar todo el carrito */
    public function clear()
    {
        $this->setCart([]);
        return back()->with('success', 'El carrito se vació correctamente.');
    }

    /** ✅ Checkout: registrar pedido en base de datos */
    public function checkout(Request $request)
    {
        $cart = $this->cart();

        if (empty($cart)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        // Validar datos del cliente
        $request->validate([
            'nombre_cliente'   => 'required|string|max:255',
            'correo_cliente'   => 'nullable|email',
            'telefono_cliente' => 'nullable|string|max:20',
        ]);

        // Calcular total
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        // Crear pedido principal
        $order = Order::create([
            'user_name' => $request->nombre_cliente,
            'email'     => $request->correo_cliente,
            'phone'     => $request->telefono_cliente,
            'total'     => $total,
        ]);

        // Registrar ítems del pedido
        foreach ($cart as $item) {
            $order->items()->create([
                'name'     => $item['name'],
                'price'    => $item['price'],
                'quantity' => $item['qty'],
            ]);
        }

        // Vaciar carrito tras registrar pedido
        Session::forget('cart');

        // Redirigir a página de éxito
        return redirect()
            ->route('carrito.exito', ['codigo' => $order->id])
            ->with('success', 'Pedido realizado correctamente 🎉');
    }
}


