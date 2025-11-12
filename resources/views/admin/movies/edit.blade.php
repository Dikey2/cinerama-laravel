@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen text-white p-10">
    <h1 class="text-3xl font-bold text-yellow-400 mb-6">✏️ Editar Película</h1>

    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Título</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700" required>
        </div>

        <div>
            <label class="block font-semibold">Género</label>
            <input type="text" name="genre" value="{{ old('genre', $movie->genre) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700" required>
        </div>

        <div>
            <label class="block font-semibold">Duración</label>
            <input type="text" name="duration" value="{{ old('duration', $movie->duration) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Clasificación</label>
            <input type="text" name="classification" value="{{ old('classification', $movie->classification) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Formato</label>
            <input type="text" name="format" value="{{ old('format', $movie->format) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Idioma</label>
            <input type="text" name="language" value="{{ old('language', $movie->language) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Ciudad</label>
            <input type="text" name="city" value="{{ old('city', $movie->city) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Fecha de Estreno</label>
            <input type="date" name="release_date" value="{{ old('release_date', $movie->release_date) }}"
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Tráiler (URL de YouTube)</label>
            <input type="url" name="trailer_url" value="{{ old('trailer_url', $movie->trailer_url) }}"
                   placeholder="https://www.youtube.com/watch?v=..."
                   class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Sinopsis</label>
            <textarea name="synopsis" rows="4"
                      class="w-full p-2 rounded bg-gray-800 border border-gray-700">{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Imagen actual</label>
            @if($movie->image)
                <img src="{{ asset('storage/images/peliculas/' . $movie->image) }}" class="h-40 rounded-lg mb-3 border border-gray-700">
            @else
                <p class="text-gray-500">Sin imagen cargada.</p>
            @endif
            <input type="file" name="poster" accept="image/*" class="block w-full text-gray-400">
        </div>

        <div>
            <label class="block font-semibold">Horarios (JSON)</label>
            <textarea name="schedules" rows="3"
                      class="w-full p-2 rounded bg-gray-800 border border-gray-700">
{{ old('schedules', is_array($movie->schedules) ? json_encode($movie->schedules, JSON_PRETTY_PRINT) : $movie->schedules) }}
            </textarea>
            <p class="text-sm text-gray-500 mt-1">
                Ejemplo: {"Arequipa":{"Cinerama":["15:00","17:30"]}}
            </p>
        </div>

        <div class="flex gap-4">
            <button class="bg-yellow-500 text-black px-6 py-2 rounded font-bold hover:bg-yellow-400">
                💾 Actualizar
            </button>
            <a href="{{ route('admin.movies.index') }}"
               class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-600">
               ← Volver
            </a>
        </div>
    </form>
</div>
@endsection

