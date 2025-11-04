@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">🎉 Celebra tu Cumpleaños en Cinerama</h1>
       <img src="{{ asset('images/promociones/cumple.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">


        <p class="text-gray-300 mb-6 text-lg">
            ¡Tu día especial merece una experiencia de película!  
            Ven a Cinerama el día de tu cumpleaños y recibe una entrada gratis para disfrutar cualquier función.
        </p>
        <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
            <li>Válido únicamente el día del cumpleaños presentando DNI o documento de identidad.</li>
            <li>Entrada gratuita válida para funciones 2D estándar.</li>
            <li>No acumulable con otras promociones o beneficios.</li>
        </ul>
        <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver a Promociones</a>
    </div>
</div>
@endsection
