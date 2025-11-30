@extends('admin.layout')

@section('header_title', 'Nuevo producto')
@section('header_subtitle', 'Agregar producto a la dulcería')

@section('content')

<form method="POST" action="{{ route('admin.candies.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" class="input" required>
    </div>

    <div>
        <label>Descripción:</label>
        <textarea name="descripcion" class="input"></textarea>
    </div>

    <div>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" class="input" required>
    </div>

    <div>
        <label>Categoría:</label>
        <select name="categoria" class="input" required>
            <option value="promo">Promos Dulceras</option>
            <option value="socio">Combo Socio</option>
            <option value="combos1o2">Combos 1 o 2</option>
            <option value="canchitas">Canchitas</option>
            <option value="dulces">Dulces</option>
            <option value="complementos">Complementos</option>
        </select>
    </div>

    <div>
        <label>Imagen:</label>
        <input type="file" name="imagen" class="input">
    </div>

    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Guardar</button>
</form>

@endsection

