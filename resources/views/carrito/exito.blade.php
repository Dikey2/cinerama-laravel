@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-900 text-center px-4">
    
    <!-- 🎉 Encabezado de éxito -->
    <div class="bg-gray-800 rounded-2xl shadow-2xl p-10 max-w-lg w-full border border-yellow-500">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-4">
            🎉 ¡Pedido realizado con éxito!
        </h1>

        <p class="text-gray-300 text-lg mb-6">
            Tu pedido fue registrado correctamente.  
            A continuación encontrarás tu <strong class="text-yellow-400">código de pedido</strong>:
        </p>

        <!-- 🔢 Código del pedido -->
        <div class="bg-yellow-500 text-black text-2xl font-mono py-4 px-6 rounded-xl shadow-inner mb-8">
            {{ $pedido->codigo ?? '—' }}
        </div>

        <!-- 📄 Mensaje adicional -->
        <p class="text-sm text-gray-400 mb-8">
            Guarda este código para consultar el estado de tu pedido o presentarlo en el punto de entrega.
        </p>

        <!-- 🔙 Botón para volver -->
        <a href="{{ route('dulceria') }}"
           class="inline-block bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full hover:bg-yellow-400 transition transform hover:scale-105 shadow-lg">
           ← Volver a la Dulcería
        </a>
    </div>

    <!-- 🖤 Pie de página -->
    <p class="text-gray-500 text-sm mt-8">
        © {{ date('Y') }} <span class="text-yellow-500 font-semibold">Cinerama</span> | Gracias por tu compra 🍿
    </p>
</div>
@endsection


