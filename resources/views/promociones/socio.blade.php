@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">💳 Beneficios Cinerama Club</h1>
        <img src="{{ asset('images/promociones/socio.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">
        <p class="text-gray-300 mb-6 text-lg">
            Únete al programa Cinerama socio y disfruta beneficios exclusivos durante todo el año:  
            descuentos, puntos por cada compra y funciones especiales.
        </p>
        <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
            <li>Tus entradas de lunes y martes a precio de martes.</li>
            <li>Recibe éntradas gratis el día de tu cumpleaños.</li>
            <li>Por cada 5 puntos llévate una entrada a precio especial.</li>
        </ul>
        <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver a Promociones</a>
    </div>
</div>
@endsection
