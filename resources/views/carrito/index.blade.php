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

        <!-- ✅ Mensajes -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- 🧺 Carrito vacío -->
        @if(!count($cart))
            <div class="bg-white rounded-xl shadow p-10 text-center">
                <p class="cart-empty text-gray-600 text-lg mb-4">Tu carrito está vacío 😅</p>
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
                            <td class="p-3 flex items-center gap-3">
                                <img src="{{ $item['image'] ?? asset('images/no-image.png') }}" 
                                     alt="{{ $item['name'] }}"
                                     class="w-16 h-16 rounded-lg object-cover">
                                <span class="font-semibold text-gray-700">{{ $item['name'] }}</span>
                            </td>
                            <td class="p-3 text-right font-medium">
                                S/ {{ number_format($item['price'], 2) }}
                            </td>
                            <td class="p-3 text-center">
                                <form action="{{ route('carrito.update') }}" method="POST" class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <input 
    type="number"
    name="qty"
    value="{{ $item['qty'] }}"
    min="1"
    class="w-20 text-center border border-gray-300 rounded-lg 
           bg-white text-gray-800 focus:ring-2 focus:ring-yellow-400"
/>

                                    <button type="submit" 
                                            class="px-3 py-1 rounded bg-yellow-500 text-black hover:bg-yellow-400 transition">
                                        🔄
                                    </button>
                                </form>
                            </td>
                            <td class="p-3 text-center text-yellow-600 font-semibold">
                                S/ {{ number_format($item['price'] * $item['qty'], 2) }}
                            </td>
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

                <!-- 🧾 Formulario de confirmación -->
<form action="{{ route('pedido.confirmar') }}" method="POST" class="space-y-4 mt-6">

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

    <!-- 💳 Métodos de pago -->
    <div class="mt-4">
        <label class="block text-gray-700 font-semibold mb-2">Método de pago:</label>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <!-- TARJETA -->
            <label class="flex items-center gap-2 bg-gray-100 border rounded-lg p-3 cursor-pointer hover:bg-gray-200 transition">
                <input type="radio" name="metodo_pago" value="tarjeta" required onclick="mostrarTarjeta()">
                💳 Tarjeta de crédito / débito
            </label>

            <!-- YAPE -->
            <label class="flex items-center gap-2 bg-gray-100 border rounded-lg p-3 cursor-pointer hover:bg-gray-200 transition">
                <input type="radio" name="metodo_pago" value="yape" onclick="mostrarQR('yape')">
                📱 Yape
            </label>

            <!-- PLIN -->
            <label class="flex items-center gap-2 bg-gray-100 border rounded-lg p-3 cursor-pointer hover:bg-gray-200 transition">
                <input type="radio" name="metodo_pago" value="plin" onclick="mostrarQR('plin')">
                💸 Plin
            </label>
        </div>
    </div>

    <!-- 🖼️ FORMULARIO DE TARJETA (OCULTO) -->
    <div id="tarjetaForm" class="hidden mt-6 bg-white border rounded-xl p-6 shadow-lg max-w-md mx-auto">

    <h3 class="text-lg font-bold text-gray-800 mb-4">Datos de tu tarjeta</h3>

    <div class="space-y-4">

        <!-- Número de tarjeta -->
        <div class="flex flex-col">
            <label class="text-gray-600 text-sm font-semibold mb-1">Número de tarjeta</label>
            <input type="text" maxlength="19"
                   class="rounded-lg border-gray-300 p-3 text-lg tracking-widest focus:ring-2 focus:ring-yellow-400"
                   placeholder="1234 5678 9012 3456">
        </div>

        <!-- Nombre del titular -->
        <div class="flex flex-col">
            <label class="text-gray-600 text-sm font-semibold mb-1">Nombre del titular</label>
            <input type="text"
                   class="rounded-lg border-gray-300 p-3 focus:ring-2 focus:ring-yellow-400"
                   placeholder="Como aparece en la tarjeta">
        </div>

        <!-- Fecha y CVV -->
        <div class="grid grid-cols-2 gap-4">

            <div class="flex flex-col">
                <label class="text-gray-600 text-sm font-semibold mb-1">Expira</label>
                <input type="text" maxlength="5"
                       class="rounded-lg border-gray-300 p-3 focus:ring-2 focus:ring-yellow-400"
                       placeholder="MM/AA">
            </div>

            <div class="flex flex-col">
                <label class="text-gray-600 text-sm font-semibold mb-1">CVV</label>
                <input type="text" maxlength="4"
                       class="rounded-lg border-gray-300 p-3 focus:ring-2 focus:ring-yellow-400"
                       placeholder="***">
            </div>

        </div>

        <!-- Logos de tarjetas -->
        <div class="flex items-center justify-end gap-3 opacity-70 mt-2">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" class="h-6">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo_%282018%29.svg" class="h-6">
        </div>

    </div>
</div>  

    <!-- 🖼️ SECCIÓN QR -->
    <div id="qrPago" class="hidden mt-6 text-center">
        <p class="text-gray-700 mb-2 font-semibold">Escanea el QR para completar tu pago:</p>
        <img id="qrImage" src="" alt="QR de pago" class="mx-auto w-56 h-56 rounded-lg shadow">
        <p class="text-gray-600 text-sm mt-2">Luego de pagar, presiona "Confirmar pedido".</p>
    </div>

    <!-- BOTÓN -->
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

<!-- 🧠 Script para mostrar QR -->
<script>
function mostrarTarjeta() {
    const tarjeta = document.getElementById('tarjetaForm');
    const qr = document.getElementById('qrPago');

    // Mostrar tarjeta
    tarjeta.classList.remove('hidden');

    // Ocultar QR
    qr.classList.add('hidden');
}

function mostrarQR(tipo) {
    const tarjeta = document.getElementById('tarjetaForm');
    const qr = document.getElementById('qrPago');
    const img = document.getElementById('qrImage');

    // Ocultar tarjeta
    tarjeta.classList.add('hidden');

    // Mostrar QR
    qr.classList.remove('hidden');

    // Elegir QR según método
    if (tipo === 'yape') {
        img.src = '{{ asset("images/qr-yape.jpeg") }}';
    } else if (tipo === 'plin') {
        img.src = '{{ asset("images/qr-plin.jpeg") }}';
    }
}
</script>


@endsection






