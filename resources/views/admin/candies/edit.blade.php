@extends('admin.layout')

@section('header_title', 'Editar producto')
@section('header_subtitle', 'Modificar los datos del producto')

@section('content')

<form method="POST" action="{{ route('admin.candies.update', $candy) }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" class="input" value="{{ $candy->nombre }}" required>
    </div>

    <div>
        <label>Descripción:</label>
        <textarea name="descripcion" class="input">{{ $candy->descripcion }}</textarea>
    </div>

    <div>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" class="input" value="{{ $candy->precio }}" required>
    </div>

    <div>
        <label>Categoría:</label>
        <select name="categoria" class="input" required>
            <option value="promo" {{ $candy->categoria=='promo'?'selected':'' }}>Promos Dulceras</option>
            <option value="socio" {{ $candy->categoria=='socio'?'selected':'' }}>Combo Socio</option>
            <option value="combos1o2" {{ $candy->categoria=='combos1o2'?'selected':'' }}>Combos 1 o 2</option>
            <option value="canchitas" {{ $candy->categoria=='canchitas'?'selected':'' }}>Canchitas</option>
            <option value="dulces" {{ $candy->categoria=='dulces'?'selected':'' }}>Dulces</option>
            <option value="complementos" {{ $candy->categoria=='complementos'?'selected':'' }}>Complementos</option>
        </select>
    </div>

    <div>
        <label>Imagen actual:</label><br>
        @if($candy->imagen)
            <img src="{{ asset('storage/'.$candy->imagen) }}" class="h-20 rounded">
        @else
            No tiene imagen
        @endif
    </div>

    <div>
        <label>Subir nueva imagen:</label>
        <input type="file" name="imagen" class="input">
    </div>

    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Actualizar</button>
</form>

@endsection

