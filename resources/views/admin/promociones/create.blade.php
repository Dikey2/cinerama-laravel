@extends('admin.layout')

@section('title', 'Nueva Promoción')

@section('header_title', 'Crear nueva promoción')
@section('header_subtitle', 'Registra una nueva promoción para Cinerama')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.promociones.store') }}">
        @csrf

        {{-- Título --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Título</label>
            <input type="text" name="titulo"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        {{-- Descripción --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" rows="4"
                      class="w-full border rounded px-3 py-2"></textarea>
        </div>

        {{-- Estado --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1">Estado</label>
            <select name="estado"
                    class="w-full border rounded px-3 py-2" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.promociones.index') }}"
               class="px-4 py-2 bg-gray-300 rounded">Cancelar</a>

            <button class="px-4 py-2 bg-yellow-500 text-white rounded">
                Guardar promoción
            </button>
        </div>

    </form>

</div>

@endsection
