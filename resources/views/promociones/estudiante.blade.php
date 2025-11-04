@extends('layouts.app')
@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10 text-center">
    <h1 class="text-4xl font-bold text-yellow-400 mb-6">🎓 Descuento Estudiantil</h1>
    <img src="{{ asset('images/promociones/estudiante.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">
    <p class="text-gray-300 text-lg mb-6">Presenta tu carnet universitario o técnico y obtén un 20% de descuento en tu entrada.</p>
    <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
        <li>Válido de lunes a jueves.</li>
        <li>No aplica feriados ni estrenos.</li>
        <li>Debes mostrar carnet físico o digital vigente.</li>
    </ul>
    <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver</a>
</div>
@endsection
