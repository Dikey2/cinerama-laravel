@extends('admin.layout')

@section('header_title', 'Editar función')
@section('header_subtitle', 'Modificar datos de la función seleccionada')

@section('content')
    <form method="POST" action="{{ route('admin.showtimes.update', $showtime) }}" class="space-y-4 max-w-xl">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1">Película</label>
            <select name="movie_id" class="input w-full" required>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}" 
                        {{ $showtime->movie_id == $movie->id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm mb-1">Cine</label>
            <select name="cinema_id" class="input w-full" required>
                @foreach($cinemas as $cinema)
                    <option value="{{ $cinema->id }}" 
                        {{ $showtime->cinema_id == $cinema->id ? 'selected' : '' }}>
                        {{ $cinema->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm mb-1">Fecha</label>
                <input type="date" name="date" 
                       value="{{ $showtime->date }}" 
                       class="input w-full"
                       required>
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Hora</label>
                <input type="time" name="time"
                       value="{{ $showtime->time }}"
                       class="input w-full"
                       required>
            </div>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm mb-1">Formato</label>
                <input type="text" name="format" 
                       value="{{ $showtime->format }}" 
                       class="input w-full">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Idioma</label>
                <input type="text" name="language" 
                       value="{{ $showtime->language }}" 
                       class="input w-full">
            </div>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm mb-1">Sala</label>
                <input type="text" name="room" 
                       value="{{ $showtime->room }}" 
                       class="input w-full">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Precio (S/)</label>
                <input type="number" step="0.01" name="price" 
                       value="{{ $showtime->price }}" 
                       class="input w-full">
            </div>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar función
        </button>
    </form>
@endsection
