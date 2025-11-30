@extends('layouts.app')

@section('content')

<style>
    input::placeholder, textarea::placeholder {
        color: #444 !important;
    }
</style>

<div class="bg-black min-h-screen text-white p-10">
    
    <h1 class="text-3xl font-bold text-yellow-400 mb-6 flex items-center gap-2">
        ✏️ Editar Película
    </h1>

    <form action="{{ route('admin.movies.update', $movie->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Título --}}
        <div>
            <label class="block font-semibold">Título</label>
            <input type="text" name="title" 
                value="{{ old('title', $movie->title) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700" required>
        </div>

        {{-- Género --}}
        <div>
            <label class="block font-semibold">Género</label>
            <input type="text" name="genre" 
                value="{{ old('genre', $movie->genre) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700" required>
        </div>

        {{-- Duración --}}
        <div>
            <label class="block font-semibold">Duración (minutos)</label>
            <input type="number" name="duration" 
                value="{{ old('duration', $movie->duration) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Clasificación --}}
        <div>
            <label class="block font-semibold">Clasificación</label>
            <input type="text" name="classification" 
                value="{{ old('classification', $movie->classification) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Formato --}}
        <div>
            <label class="block font-semibold">Formato</label>
            <input type="text" name="format" 
                value="{{ old('format', $movie->format) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Idioma --}}
        <div>
            <label class="block font-semibold">Idioma</label>
            <input type="text" name="language" 
                value="{{ old('language', $movie->language) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Ciudad --}}
        <div>
            <label class="block font-semibold">Ciudad</label>
            <input type="text" name="city" 
                value="{{ old('city', $movie->city) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Fecha --}}
        <div>
            <label class="block font-semibold">Fecha de Estreno</label>
            <input type="date" name="release_date"
                value="{{ old('release_date', $movie->release_date ? $movie->release_date->format('Y-m-d') : '') }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Trailer --}}
        <div>
            <label class="block font-semibold">Tráiler (URL de YouTube)</label>
            <input type="url" name="trailer_url" 
                value="{{ old('trailer_url', $movie->trailer_url) }}"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">
        </div>

        {{-- Sinopsis --}}
        <div>
            <label class="block font-semibold">Sinopsis</label>
            <textarea name="synopsis" rows="4"
                style="color:#000 !important; caret-color:#000 !important;"
                class="w-full p-3 rounded bg-white border border-gray-700">{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>

        {{-- Imagen --}}
        <div>
            <label class="block font-semibold mb-2">Imagen actual</label>

            @if($movie->poster)
                <div class="w-40 h-60 overflow-hidden rounded-lg border border-gray-700 bg-gray-900 mb-3">
                    <img 
                        src="{{ asset('storage/images/peliculas/' . $movie->poster) }}"
                        class="w-full h-full object-cover"
                        alt="Poster de {{ $movie->title }}">
                </div>
            @else
                <p class="text-gray-500 mb-2">Sin imagen cargada.</p>
            @endif

            <label class="block font-semibold">Cambiar imagen</label>
            <input type="file" name="poster" class="text-white" accept="image/*">
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-4 pt-6">
            <a href="{{ route('admin.movies.index') }}"
                class="bg-gray-700 hover:bg-gray-600 px-5 py-2 rounded-lg">
                Cancelar
            </a>

            <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-300 text-black font-semibold px-5 py-2 rounded-lg">
                Guardar Cambios
            </button>
        </div>

    </form>

</div>

@endsection









