@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10 flex justify-center">
    <div class="max-w-4xl text-center">

        <h1 class="text-4xl font-bold text-yellow-400 mb-6">
            👨‍👩‍👧‍👦 Pack Familiar 4x3
        </h1>

        {{-- Imagen ajustada para NO recortarse (OPCIÓN 2) --}}
        <div class="w-full md:w-2/3 mx-auto bg-black rounded-xl overflow-hidden">
            <img 
                src="{{ asset('images/promociones/familia.png') }}" 
                class="w-full h-full object-contain bg-black rounded-xl"
            >
        </div>

        <p class="text-gray-300 mb-6 text-lg mt-8">
            Ven con tu familia o amigos y paga solo 3 entradas por cada grupo de 4 personas.  
            ¡El cine se disfruta más en familia!
        </p>

        <ul class="text-left text-gray-400 mb-8 list-disc pl-6 mx-auto max-w-xl">
            <li>Válido en todas las funciones 2D.</li>
            <li>Aplica únicamente para compras presenciales.</li>
            <li>Promoción válida los fines de semana.</li>
        </ul>

        <a href="{{ route('promociones') }}" 
           class="bg-yellow-500 text-black px-6 py-2 rounded-full hover:bg-yellow-400 transition">
            ← Volver a Promociones
        </a>

    </div>
</div>
@endsection

