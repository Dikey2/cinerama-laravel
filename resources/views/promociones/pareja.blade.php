@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">🍿 Combo Pareja</h1>
        <img src="{{ asset('images/promociones/pareja.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">
        <p class="text-gray-300 mb-6 text-lg">
            Compra dos entradas para cualquier función y recibe un combo gratis con canchita grande y dos gaseosas.
        </p>
        <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
            <li>Promoción válida solo para parejas.</li>
            <li>El combo gratuito se entrega en dulcería.</li>
            <li>Disponible de lunes a jueves.</li>
        </ul>
        <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver</a>
    </div>
</div>
@endsection
