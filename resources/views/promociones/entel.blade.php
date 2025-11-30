@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10 flex justify-center">
    <div class="max-w-4xl text-center">

        <h1 class="text-4xl font-bold text-yellow-400 mb-6">
            🎟️ Promo 2x1 con Entel
        </h1>

        {{-- Imagen ajustada para NO recortarse (OPCIÓN 2) --}}
        <div class="w-full md:w-2/3 mx-auto bg-black rounded-xl overflow-hidden">
            <img 
                src="{{ asset('images/promociones/entel.png') }}" 
                class="w-full h-full object-contain bg-black rounded-xl"
            >
        </div>

        <p class="text-gray-300 mb-6 text-lg mt-8">
            Si eres cliente Entel, disfruta del beneficio 2x1 en entradas todo el año en Cinerama.  
            Solo debes presentar tu línea Entel activa al momento de comprar tus boletos en boletería o en nuestra web.
        </p>

        <ul class="text-left text-gray-400 mb-8 list-disc pl-6 mx-auto max-w-xl">
            <li>Válido todos los días hasta el 31 de diciembre de 2025.</li>
            <li>Aplica solo para funciones 2D y 3D estándar.</li>
            <li>No acumulable con otras promociones.</li>
        </ul>

        <a href="{{ route('promociones') }}" 
           class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">
            ← Volver a Promociones
        </a>

    </div>
</div>
@endsection

