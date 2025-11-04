@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-6xl mx-auto">

        <!-- ENCABEZADO -->
        <div class="flex flex-col md:flex-row gap-8 items-center mb-10">
            <img src="{{ $cine['imagen'] }}" alt="{{ $cine['nombre'] }}" 
                 class="w-full md:w-1/2 rounded-xl shadow-lg object-cover">
            <div>
                <h1 class="text-4xl font-extrabold text-yellow-400 mb-4">{{ $cine['nombre'] }}</h1>
                <p class="text-gray-300"><span class="font-semibold text-yellow-400">Ubicación:</span> {{ $cine['direccion'] }}</p>
                <p class="text-gray-400 mt-2">📍 {{ $cine['ciudad'] }}</p>
                <p class="mt-3 text-gray-400"><span class="font-semibold text-yellow-400">Salas:</span> {{ $cine['salas'] }}</p>
                <p class="mt-3 text-gray-400"><span class="font-semibold text-yellow-400">Formatos:</span> {{ implode(', ', $cine['formatos']) }}</p>

                <a href="{{ route('cines') }}" 
                   class="inline-block mt-5 bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                   ← Volver a Cines
                </a>
            </div>
        </div>

        <!-- MAPA -->
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 mb-10">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">Mapa de ubicación</h2>
            <div class="w-full h-80 bg-gray-800 flex items-center justify-center rounded-lg overflow-hidden">
                <!-- IFRAME dinámico según dirección -->
                <iframe
                    width="100%"
                    height="100%"
                    style="border:0;"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps?q={{ urlencode($cine['direccion'] . ', ' . $cine['ciudad']) }}&output=embed">
                </iframe>
            </div>
        </div>

        <!-- SERVICIOS -->
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">Servicios</h2>
            <ul class="grid sm:grid-cols-2 gap-3 text-gray-300">
                @foreach ($cine['servicios'] as $servicio)
                    <li class="flex items-center gap-2">
                        <span class="text-yellow-400">✔</span> {{ $servicio }}
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection

