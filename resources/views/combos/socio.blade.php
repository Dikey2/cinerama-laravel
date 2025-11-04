@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-8">💳 Combos Socio Cinerama</h1>
        <p class="text-gray-400 mb-10 text-lg">Exclusivos para nuestros miembros. Disfruta beneficios únicos y precios especiales 🍿</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Combo 1 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo1.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Socio Clásico</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 1 Bebida (32oz)</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 24.90</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Socio Clásico">
                    <input type="hidden" name="price" value="24.90">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo1.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

            <!-- Combo 2 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo2.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Dúo Socio</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 2 Bebidas + M&Ms</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 34.50</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Dúo Socio">
                    <input type="hidden" name="price" value="34.50">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo2.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

            <!-- Combo 3 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo3.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Sweet & Pop</h2>
                <p class="text-gray-300 mb-3">1 Canchita + 1 Bebida + 1 Chocolate Mood</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 28.90</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Sweet & Pop">
                    <input type="hidden" name="price" value="28.90">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo3.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

            <!-- Combo 4 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo4.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Premium Socio</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 2 Bebidas + 2 Chocolates Mood</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 39.90</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Premium Socio">
                    <input type="hidden" name="price" value="39.90">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo4.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

            <!-- Combo 5 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo5.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Familiar</h2>
                <p class="text-gray-300 mb-3">1 Canchita Gigante + 3 Bebidas + 1 Snack Familiar</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 49.90</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Familiar">
                    <input type="hidden" name="price" value="49.90">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo5.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

            <!-- Combo 6 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo6.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Pareja Deluxe</h2>
                <p class="text-gray-300 mb-3">1 Canchita + 2 Bebidas + Nachos con Queso</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 35.90</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Pareja Deluxe">
                    <input type="hidden" name="price" value="35.90">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo6.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

            <!-- Combo 7 -->
            <div class="bg-gray-900 rounded-2xl p-5 shadow-lg hover:shadow-yellow-500 transition">
                <img src="{{ asset('images/socio/combo7.png') }}" class="rounded-xl mb-4 w-full">
                <h2 class="text-2xl text-yellow-400 font-bold">Combo Gold</h2>
                <p class="text-gray-300 mb-3">1 Canchita Dorada + 2 Bebidas + 2 Chocolates Premium</p>
                <p class="text-yellow-400 font-semibold mb-3">S/ 59.90</p>
                <form action="{{ route('carrito.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Combo Gold">
                    <input type="hidden" name="price" value="59.90">
                    <input type="hidden" name="image" value="{{ asset('images/socio/combo7.png') }}">
                    <button class="bg-yellow-500 text-black px-5 py-2 rounded-full hover:bg-yellow-400">Agregar 🛒</button>
                </form>
            </div>

        </div>

        <!-- Volver -->
        <div class="text-center mt-10">
            <a href="{{ route('dulceria.productos') }}" 
                class="bg-gray-900 text-yellow-400 px-6 py-3 rounded-full font-semibold shadow-md hover:bg-yellow-700 hover:text-white transition">
                ← Volver a Dulcería Productos
            </a>
        </div>
    </div>
</div>
@endsection

