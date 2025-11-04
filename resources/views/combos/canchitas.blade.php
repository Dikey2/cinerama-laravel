@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-8">
    <h2 class="text-3xl font-bold text-yellow-500 text-center mb-8">🍿 Canchitas</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $productos = [
                ['nombre' => 'Canchita Gigante', 'descripcion' => 'Perfecta para compartir con amigos.', 'precio' => 'S/ 17.00', 'imagen' => 'pop1.png'],
                ['nombre' => 'Canchita Mediana', 'descripcion' => 'Tamaño ideal para una película.', 'precio' => 'S/ 12.00', 'imagen' => 'pop2.png'],
                ['nombre' => 'Canchita Pequeña', 'descripcion' => 'Porción individual para disfrutar.', 'precio' => 'S/ 9.50', 'imagen' => 'pop3.png'],
                ['nombre' => 'Canchita Caramelizada', 'descripcion' => 'Dulce y crocante, irresistible.', 'precio' => 'S/ 15.00', 'imagen' => 'pop4.png'],
                ['nombre' => 'Canchita Salada', 'descripcion' => 'La clásica que nunca falla.', 'precio' => 'S/ 10.00', 'imagen' => 'pop5.png'],
                ['nombre' => 'Canchita Mix', 'descripcion' => 'Mitad dulce, mitad salada.', 'precio' => 'S/ 14.50', 'imagen' => 'pop6.png']
            ];
        @endphp

        @foreach($productos as $producto)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-yellow-400 transition p-4 text-center">
            <img src="{{ asset('images/socio/'.$producto['imagen']) }}" class="rounded-lg w-full h-48 object-cover mb-3">
            <h3 class="font-bold text-lg text-gray-800">{{ $producto['nombre'] }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ $producto['descripcion'] }}</p>
            <p class="font-semibold text-yellow-600 mb-4">{{ $producto['precio'] }}</p>
            <button class="bg-yellow-500 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                Agregar 🛒
            </button>
        </div>
        @endforeach
    </div>
</div>
@endsection
