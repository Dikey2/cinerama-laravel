@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">👨‍👩‍👧‍👦 Pack Familiar 4x3</h1>
        <img src="{{ asset('images/promociones/familia.png') }}" class="rounded-xl mx-auto mb-8 w-full md:w-2/3">
        <p class="text-gray-300 mb-6 text-lg">
            Ven con tu familia o amigos y paga solo 3 entradas por cada grupo de 4 personas.  
            ¡El cine se disfruta más en familia!
        </p>
        <ul class="text-left text-gray-400 mb-8 list-disc pl-6">
            <li>Válido en todas las funciones 2D.</li>
            <li>Aplica únicamente para compras presenciales.</li>
            <li>Promoción válida los fines de semana.</li>
        </ul>
        <a href="{{ route('promociones') }}" class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">← Volver a Promociones</a>
    </div>
</div>
@endsection
