@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-10">
    <div class="max-w-6xl mx-auto">

        <!-- 🧭 Encabezado -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-yellow-600 flex items-center">
                🛒 Tu Carrito de Compras
            </h1>

            <div class="space-x-3">
                <a href="{{ route('dulceria') }}" 
                   class="px-4 py-2 rounded-full bg-gray-800 text-white hover:bg-gray-700">
                   ← Seguir comprando
                </a>

                @if(count($cart))
                <form action="{{ route('carrito.clear') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-500 transition">
                        Vaciar carrito
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- ✅ Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- ⚠️ Mensaje de error -->
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- 🧺 Carrito vacío -->
        @if(!count($cart))
            <div class="bg-white rounded-xl shadow p-10 text-center">
                <p class="text-gray-600 text-lg mb-4">Tu carrito está vacío 😅</p>
                <a href="{{ route('dulceria') }}" 
                   class="mt-2 inline-block bg-yellow-500 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                    ← Ir a la Dulcería
                </a>
            </div>

        @else
            <!-- 🧾 Tabla del carrito -->
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg mb-8">
                <table class="min-w-full border-collapse">
                    <thead class="bg-yellow-500 text-black">
                        <tr>
                            <th class="p-3 text-left">Producto</th>
                            <th class="p-3 text-right">Precio</th>
                            <th class="p-3 text-center">Cantidad</th>
                            <th class="p-3 text-center">Subtotal</th>
                            <th class="p-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $key => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <!-- 🧁 Nombre e imagen -->
                            <td class="p-3 flex items-center gap-3">
                                <img src="{{ $item['image'] ?? asset('images/no-image.png') }}" 
                                     alt="{{ $item['name'] }}"
                                     class="w-16 h-16 rounded-lg object-cover">
                                <span class="font-semibold text-gray-700">{{ $item['name'] }}</span>
                            </td>

                            <!-- 💰 Precio -->
                            <td class="p-3 text-right font-medium">
                                S/ {{ number_format($item['price'], 2) }}
                            </td>

                            <!-- 🔢 Cantidad -->
                            <td class="p-3 text-center">
                                <form action="{{ route('carrito.update') }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                           class="w-20 text-center border border-gray-300 rounded-lg">
                                    <button type="submit" 
                                            class="px-3 py-1 rounded bg-yellow-500 text-black hover:bg-yellow-400 transition">
                                        🔄
                                    </button>
                                </form>
                            </td>

                            <!-- 💸 Subtotal -->
                            <td class="p-3 text-center text-yellow-600 font-semibold">
                                S/ {{ number_format($item['price'] * $item['qty'], 2) }}
                            </td>

                            <!-- ❌ Eliminar -->
                            <td class="p-3 text-center">
                                <form action="{{ route('carrito.remove') }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" 
                                            class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-500 transition">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- 💳 Resumen y Confirmación -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="font-bold text-xl mb-4 text-gray-800">Resumen del pedido</h2>

                <div class="flex justify-between text-lg mb-2">
                    <span>Total:</span>
                    <span class="font-bold text-yellow-600">S/ {{ number_format($total, 2) }}</span>
                </div>

                <!-- 🧾 Formulario de confirmación de pedido -->
                <form action="{{ route('carrito.checkout') }}" method="POST" class="space-y-4 mt-6">
                    @csrf
                    <div>
                        <input type="text" name="nombre_cliente" placeholder="Nombre completo"
                               class="w-full rounded-lg border-gray-300 p-2 focus:ring-2 focus:ring-yellow-400" required>
                    </div>
                    <div>
                        <input type="email" name="correo_cliente" placeholder="Correo electrónico"
                               class="w-full rounded-lg border-gray-300 p-2 focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <input type="text" name="telefono_cliente" placeholder="Teléfono"
                               class="w-full rounded-lg border-gray-300 p-2 focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <button type="submit"
                        class="mt-3 w-full py-3 rounded-full bg-yellow-500 text-black font-semibold hover:bg-yellow-400 transition">
                        Confirmar pedido 🧾
                    </button>
                </form>

                <p class="text-xs text-gray-500 mt-3 text-center">
                    * Al confirmar, tu pedido será registrado y el carrito se vaciará automáticamente.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
    



