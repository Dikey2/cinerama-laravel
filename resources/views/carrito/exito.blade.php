@extends('layouts.app')

@section('content')

<!-- ✔️ CHECK ANIMADO DE COMPRA EXITOSA -->
<div class="flex flex-col items-center justify-center py-10">

    <!-- Círculo con animación -->
    <div class="w-28 h-28 rounded-full bg-green-500 flex items-center justify-center shadow-lg animate-bounce-slow">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" 
                  d="M5 13l4 4L19 7" />
        </svg>
    </div>

    <!-- Texto -->
    <h1 class="text-3xl font-bold text-green-600 mt-4">¡Compra confirmada!</h1>
    <p class="text-gray-600 mt-1">Tu pedido ha sido registrado correctamente</p>

</div>

<!-- Animación suave -->
<style>
@keyframes bounce-slow {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}
.animate-bounce-slow {
  animation: bounce-slow 1.8s infinite;
}
</style>

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-center px-4">
    
    <!-- 📄 Tarjeta principal -->
    <div class="bg-gray-800 rounded-2xl shadow-2xl p-10 max-w-2xl w-full border border-yellow-500">

        <!-- 🎉 Título -->
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-4">  
            🎉 ¡Pedido realizado con éxito!
        </h1>

        <p class="text-gray-300 text-lg mb-6">
            Gracias por tu compra. Aquí tienes el detalle completo del pedido:
        </p>

        <!-- 🔢 Código del pedido -->
        <div class="bg-yellow-500 text-black text-2xl font-mono py-4 px-6 rounded-xl shadow-inner mb-8">
            {{ $pedido->codigo }}
        </div>


        <!-- 🧾 DETALLE DEL PEDIDO -->
        <div class="text-left text-gray-200 mb-8 space-y-4">

            <!-- 🧍 Datos del cliente -->
            <div class="bg-gray-700 p-4 rounded-xl">
                <h3 class="text-xl font-bold text-yellow-400 mb-2">👤 Datos del Cliente</h3>
                <p><strong>Nombre:</strong> {{ $pedido->nombre_cliente }}</p>
                @if($pedido->correo_cliente)
                <p><strong>Correo:</strong> {{ $pedido->correo_cliente }}</p>
                @endif
                @if($pedido->telefono_cliente)
                <p><strong>Teléfono:</strong> {{ $pedido->telefono_cliente }}</p>
                @endif
            </div>

            <!-- 🪑 Entradas + butacas -->
            @php
                $detalles = $pedido->detalles ?? collect([]);

                $entradas = $detalles->filter(function($d){
                    return str_contains($d->producto, 'Entrada');
                });

                $dulceria = $detalles->filter(function($d){
                    return !str_contains($d->producto, 'Entrada');
                });
            @endphp

            @if($entradas->count())
            <div class="bg-gray-700 p-4 rounded-xl">
                <h3 class="text-xl font-bold text-yellow-400 mb-3">🎟 Entradas</h3>

                @foreach($entradas as $entrada)
                    <div class="flex justify-between border-b border-gray-600 py-2">
                        <span>{{ $entrada->producto }}</span>
                        <span class="font-bold text-yellow-300">S/ {{ number_format($entrada->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>
            @endif

            <!-- 🍿 Productos de Dulcería -->
            @if($dulceria->count())
            <div class="bg-gray-700 p-4 rounded-xl">
                <h3 class="text-xl font-bold text-yellow-400 mb-3">🍿 Dulcería</h3>

                @foreach($dulceria as $item)
                    <div class="flex justify-between border-b border-gray-600 py-2">
                        <span>{{ $item->cantidad }} × {{ $item->producto }}</span>
                        <span class="font-bold text-yellow-300">S/ {{ number_format($item->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>
            @endif

            <!-- 💰 TOTAL -->
            <div class="bg-gray-900 border-t border-yellow-500 pt-4 mt-4">
                <p class="text-2xl font-extrabold text-yellow-400">Total Pagado: S/ {{ number_format($pedido->total, 2) }}</p>
            </div>
        </div>


        <!-- 🔙 Volver -->
        <a href="{{ route('dulceria') }}"
           class="inline-block bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full hover:bg-yellow-400 transition transform hover:scale-105 shadow-lg">
           ← Volver a la Dulcería
        </a>
    </div>

    <!-- 🖤 Footer -->
    <p class="text-gray-500 text-sm mt-8">
        © {{ date('Y') }} <span class="text-yellow-500 font-semibold">Cinerama</span> | Gracias por tu compra 🍿
    </p>
</div>
@endsection




