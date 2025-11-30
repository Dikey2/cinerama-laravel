@extends('admin.layout')

@section('title', 'Configuración del Sitio')

@section('content')

<h2 class="text-xl font-bold mb-6">⚙️ Ajustes generales</h2>

<form class="space-y-6 bg-white p-6 rounded-xl shadow">

    <div>
        <label class="font-semibold">Logo principal</label>
        <input type="file" class="mt-1 block w-full">
    </div>

    <div>
        <label class="font-semibold">Color principal</label>
        <input type="color" class="mt-1 block w-20 h-10 rounded">
    </div>

    <div>
        <label class="font-semibold">Texto del banner</label>
        <textarea class="w-full border rounded p-2"></textarea>
    </div>

    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Guardar cambios
    </button>

</form>

@endsection
