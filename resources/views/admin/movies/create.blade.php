@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen text-white py-10">
    <div class="max-w-4xl mx-auto">
        
        <h1 class="text-4xl font-bold text-yellow-400 mb-8 flex items-center gap-2">
            🎬 Crear Nueva Película
        </h1>

        <form action="{{ route('admin.movies.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf

            <!-- Título -->
            <div>
                <label class="block font-semibold mb-1">Título</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}"
                       required
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="Kung Fu Panda 4">
            </div>

            <!-- Género -->
            <div>
                <label class="block font-semibold mb-1">Género</label>
                <input type="text" 
                       name="genre" 
                       value="{{ old('genre') }}"
                       required
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="Animación">
            </div>

            <!-- Duración -->
            <div>
                <label class="block font-semibold mb-1">Duración (minutos)</label>
                <input type="number" 
                       name="duration" 
                       value="{{ old('duration') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="120">
            </div>

            <!-- Clasificación -->
            <div>
                <label class="block font-semibold mb-1">Clasificación</label>
                <input type="text" 
                       name="classification" 
                       value="{{ old('classification') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="PG">
            </div>

            <!-- Formato -->
            <div>
                <label class="block font-semibold mb-1">Formato</label>
                <input type="text" 
                       name="format" 
                       value="{{ old('format') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="3D / 2D / IMAX">
            </div>

            <!-- Idioma -->
            <div>
                <label class="block font-semibold mb-1">Idioma</label>
                <input type="text" 
                       name="language" 
                       value="{{ old('language') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="Español">
            </div>

            <!-- Ciudad -->
            <div>
                <label class="block font-semibold mb-1">Ciudad</label>
                <input type="text" 
                       name="city" 
                       value="{{ old('city') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="Arequipa / Lima">
            </div>

            <!-- Fecha de Estreno -->
            <div>
                <label class="block font-semibold mb-1">Fecha de Estreno</label>
                <input type="date" 
                       name="release_date" 
                       value="{{ old('release_date') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2">
            </div>

            <!-- Trailer URL -->
            <div>
                <label class="block font-semibold mb-1">Tráiler (URL de YouTube)</label>
                <input type="text" 
                       name="trailer_url" 
                       value="{{ old('trailer_url') }}"
                       class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                       placeholder="https://youtube.com/trailer">
            </div>

            <!-- Sinopsis -->
            <div>
                <label class="block font-semibold mb-1">Sinopsis</label>
                <textarea name="synopsis" 
                          class="w-full bg-[#1a1f29] text-white rounded-lg px-4 py-2"
                          rows="4"
                          placeholder="Una aventura llena de humor y acción.">{{ old('synopsis') }}</textarea>
            </div>

            <!-- Imagen principal -->
            <div>
                <label class="block font-semibold mb-1">Imagen principal</label>
                <input type="file" 
                       name="poster" 
                       class="text-white">
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 mt-6">

                <a href="{{ route('admin.movies.index') }}" 
                   class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-white">
                    Cancelar
                </a>

                <button type="submit" 
                        class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold px-6 py-2 rounded-lg shadow-md transition">
                    Guardar Película
                </button>

            </div>

        </form>

    </div>
</div>
@endsection




