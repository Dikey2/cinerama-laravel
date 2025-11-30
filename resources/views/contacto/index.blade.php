@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4">

        <h1 class="text-4xl font-bold text-yellow-400 mb-8 text-center">📨 Contáctanos</h1>

        <form action="{{ route('contacto.send') }}" method="POST" class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf

    <input type="text" name="empresa" placeholder="Nombre de la empresa"
        class="p-3 bg-gray-800 text-white rounded" required>

    <input type="email" name="correo" placeholder="Correo electrónico"
        class="p-3 bg-gray-800 text-white rounded" required>

    <input type="text" name="telefono" placeholder="Teléfono de contacto"
        class="p-3 bg-gray-800 text-white rounded" required>

    <input type="text" name="ciudad" placeholder="Ciudad"
        class="p-3 bg-gray-800 text-white rounded" required>

    <textarea name="mensaje" placeholder="Cuéntanos tu necesidad o tipo de evento..."
        class="p-3 bg-gray-800 text-white rounded col-span-2 h-32 resize-none" required></textarea>

    <div class="col-span-2 text-center">
        <button type="submit"
            class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-8 py-3 rounded transition duration-200">
            Enviar solicitud 📩
        </button>
    </div>

    @if (session('success'))
        <div class="col-span-2 text-center text-green-400 font-semibold mt-4">
            {{ session('success') }}
        </div>
    @endif
</form>


    </div>
</div>
@endsection

