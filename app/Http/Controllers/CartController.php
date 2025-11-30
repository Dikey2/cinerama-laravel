<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    /** 🔹 Obtener carrito */
    private function cart() 
    {
        return Session::get('cart', []);    
    }

    /** 🔹 Guardar carrito */
    private function setCart(array $cart)
    {
        Session::put('cart', $cart);
    }

    

    /** 🛒 Mostrar carrito */
public function index()
{
    
if (!session('tickets_added') && session()->has('reserva.entradas')) {
    $this->addTicketsToCart();
    session(['tickets_added' => true]);

}

    $cart = $this->cart();
    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

    // 🔥 AJAX → se devuelve JSON + HTML
    if (request()->ajax()) {
    return response()->json([
        'html'  => view('carrito._items', [
            'cart' => $cart,
            'total' => $total
        ])->render(),
        'total' => $total,
    ]);
}


    // Vista normal
    return view('carrito.index', compact('cart', 'total'));
}



    /** ➕ Agregar producto al carrito */
    public function add(Request $request)
{
    try {

        // JSON o formulario
        $data = $request->json()->all();
        $name  = $data['name'] ?? $request->input('name');
        $price = $data['price'] ?? $request->input('price');
        $image = $data['image'] ?? $request->input('image');
        $qty   = $data['qty'] ?? 1;

        if (!$name || !is_numeric($price)) {
            return response()->json(['success' => false, 'error' => 'Datos inválidos'], 400);
        }

        $cart = $this->cart();
        $key = Str::slug($name) . '_' . uniqid();


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

        return response()->json([
            'success'  => true,
            'count'    => collect($cart)->sum('qty'),
            'total'    => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
            'redirect' => route('carrito.index'),   // 🔥 NECESARIO PARA TU FRONTEND
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error'   => $e->getMessage(),
        ], 500);
    }
}



    /** 🎫 Agregar ENTRADAS con butacas */
    public function addTicketsToCart()
{
    // 1. Datos desde sesión (caso normal)
    $entradas = session('reserva.entradas', []);
    $seats    = session('reserva.seats', []);
    $showtimeId = session('reserva.showtime');

    // 2. Caso alternativo: datos enviados por GET desde dulcería
    if (empty($entradas) && request()->has('entradas')) {
        try {
            $entradas = json_decode(request()->get('entradas'), true);
            $seats = request()->get('seats') ? explode(',', request()->get('seats')) : [];
        } catch (\Exception $e) {
            return;
        }
    }

    if (empty($entradas)) return;

    $cart = $this->cart();

    // Si existe función showtime
    $showtime = $showtimeId ? \App\Models\Showtime::find($showtimeId) : null;

    foreach ($entradas as $e) {

        $key = 'entrada_' . Str::slug($e['nombre']) . '_' . uniqid();

        $cart[$key] = [
            'name'  => $e['nombre'] . (!empty($seats) ? " (" . implode(', ', $seats) . ")" : ""),
            'price' => $e['precio'],
            'qty'   => $e['cantidad'],
            'image' => '/images/ticket.png',
            'seats' => $seats,
            'showtime' => $showtime?->id,
            'movie'    => $showtime?->movie?->title,
        ];
    }

    $this->setCart($cart);
}

    /** ♻️ Actualizar cantidad */
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

        return response()->json([
            'success' => true,
            'total'   => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        ]);
    }


    /** ❌ Eliminar un producto */
    public function remove(Request $request)
    {
        $request->validate(['key' => 'required|string']);
        
        $cart = $this->cart();
        unset($cart[$request->key]);
        $this->setCart($cart);

        return response()->json([
            'success' => true,
            'total'   => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        ]);
    }


    /** 🧹 Vaciar carrito */
    public function clear()
    {
        $this->setCart([]);
        return redirect()->back();
    }


    /** 💳 Checkout */
    public function checkout(Request $request)
    {
        $cart = $this->cart();
        if (empty($cart)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        $request->validate([
            'nombre_cliente'   => 'required|string|max:255',
            'correo_cliente'   => 'nullable|email',
            'telefono_cliente' => 'nullable|string|max:20',
        ]);

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $codigo = 'CIN-' . strtoupper(substr(uniqid(), -6));

        $order = Order::create([
            'user_name' => $request->nombre_cliente,
            'email'     => $request->correo_cliente,
            'phone'     => $request->telefono_cliente,
            'total'     => $total,
            'codigo'    => $codigo,
        ]);

        // ⛔ Extender bloqueo de butacas a 10 minutos después de la compra
    \App\Models\SeatLock::where('session_id', session()->getId())
    ->update([
        'expires_at' => now()->addMinutes(10)
    ]);


        foreach ($cart as $item) {
            $order->items()->create([
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['qty'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('carrito.exito', ['codigo' => $codigo]);
    }


    /** 🎉 Página de éxito */
    public function exito($codigo)
    {
        $order = Order::where('codigo', $codigo)->firstOrFail();
        return view('carrito.exito', compact('order'));
    }
}





