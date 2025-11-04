@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">🎟️ Promo 2x1 con Entel</h1>
        <img src="{{ asset('images/promociones/entel.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">
        <p class="text-gray-300 mb-6 text-lg">
            Si eres cliente Entel, disfruta del beneficio 2x1 en entradas todo el año en Cinerama.  
            Solo debes presentar tu línea Entel activa al momento de comprar tus boletos en boletería o en nuestra web.
        </p>
        <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
            <li>Válido todos los días hasta el 31 de diciembre de 2025.</li>
            <li>Aplica solo para funciones 2D y 3D estándar.</li>
            <li>No acumulable con otras promociones.</li>
        </ul>
        <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver a Promociones</a>
    </div>
</div>
@endsection
