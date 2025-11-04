@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-8">🎬 Combos 1 o 2 Personas</h1>
        <p class="text-gray-400 mb-10 text-lg">Perfectos para compartir una función en pareja o disfrutar solo una buena película 🍿</p>

        <!-- Grid de combos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Combo 1 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/combos/uno2-1.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Cine Solo</h2>
                <p class="text-gray-300 mb-3">1 Canchita Mediana + 1 Bebida (32oz)</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 22.90</p>
                <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
            </div>

            <!-- Combo 2 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/combos/uno2-2.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Dúo Pop</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 2 Bebidas (32oz)</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 28.50</p>
                <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
            </div>

            <!-- Combo 3 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/combos/uno2-3.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Love</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 2 Bebidas + 1 Chocolate Mood</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 32.90</p>
                <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
            </div>

            <!-- Combo 4 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/combos/uno2-4.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Dúo Deluxe</h2>
                <p class="text-gray-300 mb-3">1 Canchita Grande + 2 Bebidas + 1 Snack Compartible</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 36.90</p>
                <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
            </div>

            <!-- Combo 5 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/combos/uno2-5.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Sweet Duo</h2>
                <p class="text-gray-300 mb-3">1 Canchita + 2 Bebidas + 1 Bolsa de M&M’s</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 34.50</p>
                <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
            </div>

            <!-- Combo 6 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/combos/uno2-6.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Cine Plus</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 1 Bebida + 1 Chocolate Kit Kat</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 27.90</p>
                <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
            </div>
        </div>

        <!-- Botón volver -->
        <div class="text-center mt-12">
            <a href="{{ route('dulceria.productos') }}" 
               class="bg-gray-800 text-yellow-400 px-6 py-3 rounded-full font-semibold hover:bg-yellow-700 hover:text-white transition">
               ← Volver a Dulcería Productos
            </a>
        </div>
    </div>
</div>
@endsection
