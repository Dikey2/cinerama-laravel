@extends('admin.layout')


@section('content')

<h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-2">
    🎬 Registrar nuevo cine
</h1>

<div class="bg-white shadow-md rounded-lg p-8 max-w-3xl">

    <form action="{{ route('admin.cinemas.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Nombre --}}
        <div>
            <label class="font-semibold text-gray-700">Nombre del cine</label>
            <input type="text" name="name"
                class="w-full mt-2 p-3 rounded-lg bg-white border border-gray-300 text-gray-900"
                required>
        </div>

        {{-- Dirección --}}
        <div>
            <label class="font-semibold text-gray-700">Dirección</label>
            <input type="text" name="address"
                class="w-full mt-2 p-3 rounded-lg bg-white border border-gray-300 text-gray-900"
                required>
        </div>

        {{-- Ciudad --}}
        <div>
            <label class="font-semibold text-gray-700">Ciudad</label>
            <input type="text" name="city"
                class="w-full mt-2 p-3 rounded-lg bg-white border border-gray-300 text-gray-900"
                required>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('admin.cinemas.index') }}"
               class="px-5 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold">
               Cancelar
            </a>

            <button type="submit"
                class="px-6 py-2 bg-yellow-500 hover:bg-yellow-400 text-black rounded-lg font-semibold">
                Guardar cine
            </button>
        </div>

    </form>

</div>

@endsection

