@extends('admin.layout')

@section('header_title', 'Nueva función')
@section('header_subtitle', 'Crear función de película')

@section('content')
    <form method="POST" action="{{ route('admin.showtimes.store') }}" class="space-y-4 max-w-xl">
        @csrf

        <div>
            <label class="block text-sm mb-1">Película</label>
            <select name="movie_id" class="input w-full" required>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm mb-1">Cine</label>
            <select name="cinema_id" class="input w-full" required>
                @foreach($cinemas as $cinema)
                    <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm mb-1">Fecha</label>
                <input type="date" name="date" class="input w-full" required> <!-- 🔥 unificado -->
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Hora</label>
                <input type="time" name="time" class="input w-full" required> <!-- 🔥 unificado -->
            </div>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm mb-1">Formato</label>
                <input type="text" name="format" value="2D" class="input w-full">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Idioma</label>
                <input type="text" name="language" value="DOBLADA" class="input w-full">
            </div>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm mb-1">Sala</label>
                <input type="text" name="room" class="input w-full">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Precio (S/)</label>
                <input type="number" step="0.01" name="price" value="20" class="input w-full">
            </div>
        </div>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
@endsection



