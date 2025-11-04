@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">💺 Martes y Miércoles VIP</h1>
        <img src="{{ asset('images/promociones/vip.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">
        <p class="text-gray-300 mb-6 text-lg">
            Disfruta del confort de nuestras salas VIP con un 30% de descuento en tus entradas todos los martes y miércoles.
        </p>
        <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
            <li>Aplica solo para salas VIP Cinerama.</li>
            <li>Promoción válida hasta el 30 de junio de 2026.</li>
            <li>Descuento no acumulable con otras promociones.</li>
        </ul>
        <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver a Promociones</a>
    </div>
</div>
@endsection
