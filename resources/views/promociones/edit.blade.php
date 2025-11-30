@extends('layouts.admin')

@section('title', 'Editar promoción')
@section('header_title', 'Editar promoción')
@section('header_subtitle', 'Modifica los datos de la promoción seleccionada')

@section('content')

<form action="{{ route('admin.promociones.update', $promocione) }}"
      method="POST" class="max-w-2xl space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label class="font-medium">Título</label>
        <input type="text" name="titulo" value="{{ $promocione->titulo }}"
               class="w-full mt-1 rounded-lg border-gray-300" required>
    </div>

    <div>
        <label class="font-medium">Descripción</label>
        <textarea name="descripcion" rows="4"
                  class="w-full mt-1 rounded-lg border-gray-300">{{ $promocione->descripcion }}</textarea>
    </div>

    <div>
        <label class="font-medium">Estado</label>
        <select name="estado" class="w-full mt-1 rounded-lg border-gray-300" required>
            <option value="activa" {{ $promocione->estado === 'activa' ? 'selected' : '' }}>Activa</option>
            <option value="inactiva" {{ $promocione->estado === 'inactiva' ? 'selected' : '' }}>Inactiva</option>
        </select>
    </div>

    <button class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
        Actualizar promoción
    </button>
</form>

@endsection
