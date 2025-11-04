@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-8">
    <h2 class="text-3xl font-bold text-yellow-500 text-center mb-8">🥤 Complementos</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $complementos = [
                ['nombre' => 'Nachos con Queso', 'descripcion' => 'Crujientes nachos con salsa cheddar caliente.', 'precio' => 'S/ 16.00', 'imagen' => 'comp1.png'],
                ['nombre' => 'Hot Dog Clásico', 'descripcion' => 'Pan suave con salchicha y salsas.', 'precio' => 'S/ 13.00', 'imagen' => 'comp2.png'],
                ['nombre' => 'Pizza Individual', 'descripcion' => 'Porción de pizza recién horneada.', 'precio' => 'S/ 17.50', 'imagen' => 'comp3.png'],
                ['nombre' => 'Coca-Cola 32oz', 'descripcion' => 'Refrescante bebida gaseosa.', 'precio' => 'S/ 9.00', 'imagen' => 'comp4.png'],
                ['nombre' => 'Agua Mineral San Luis', 'descripcion' => 'Botella de 500ml.', 'precio' => 'S/ 5.50', 'imagen' => 'comp5.png'],
                ['nombre' => 'Café Cinerama', 'descripcion' => 'Café americano caliente.', 'precio' => 'S/ 8.00', 'imagen' => 'comp6.png']
            ];
        @endphp

        @foreach($complementos as $item)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-yellow-400 transition p-4 text-center">
            <img src="{{ asset('images/socio/'.$item['imagen']) }}" class="rounded-lg w-full h-48 object-cover mb-3">
            <h3 class="font-bold text-lg text-gray-800">{{ $item['nombre'] }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ $item['descripcion'] }}</p>
            <p class="font-semibold text-yellow-600 mb-4">{{ $item['precio'] }}</p>
            <button class="bg-yellow-500 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                Agregar 🛒
            </button>
        </div>
        @endforeach
    </div>
</div>
@endsection
