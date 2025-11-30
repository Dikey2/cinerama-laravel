@extends('layouts.admin')

@section('title', 'Nueva promoción')
@section('header_title', 'Crear nueva promoción')
@section('header_subtitle', 'Agrega una nueva promoción al sistema')

@section('content')

<form action="{{ route('admin.promociones.store') }}" method="POST" class="max-w-2xl space-y-6">
    @csrf

    <div>
        <label class="font-medium">Título</label>
        <input type="text" name="titulo" class="w-full mt-1 rounded-lg border-gray-300"
               placeholder="Ej: Promo 2x1 estudiantes" required>
    </div>

    <div>
        <label class="font-medium">Descripción</label>
        <textarea name="descripcion" rows="4"
                  class="w-full mt-1 rounded-lg border-gray-300"
                  placeholder="Detalles de la promoción..."></textarea>
    </div>

    <div>
        <label class="font-medium">Estado</label>
        <select name="estado" class="w-full mt-1 rounded-lg border-gray-300" required>
            <option value="activa">Activa</option>
            <option value="inactiva">Inactiva</option>
        </select>
    </div>

    <button class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
        Guardar promoción
    </button>
</form>

@endsection
