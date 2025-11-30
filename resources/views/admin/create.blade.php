@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen text-white p-10">
    <h1 class="text-3xl font-bold text-yellow-400 mb-6">🎬 Registrar Nueva Película</h1>

    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold">Título</label>
                <input type="text" name="title" class="w-full p-2 rounded bg-gray-800 border border-gray-700" required>
            </div>

            <div>
                <label class="block font-semibold">Género</label>
                <input type="text" name="genre" class="w-full p-2 rounded bg-gray-800 border border-gray-700" required>
            </div>

            <div>
                <label class="block font-semibold">Duración</label>
                <input type="text" name="duration" placeholder="Ej: 1h 45m" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
            </div>

            <div>
                <label class="block font-semibold">Clasificación</label>
                <input type="text" name="classification" placeholder="+14 / ATP" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
            </div>

            <div>
                <label class="block font-semibold">Formato</label>
                <input type="text" name="format" placeholder="2D, 3D, PRIME" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
            </div>

            <div>
                <label class="block font-semibold">Idioma</label>
                <input type="text" name="language" placeholder="Doblada / Subtitulada" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
            </div>

            <div>
                <label class="block font-semibold">Ciudad</label>
                <input type="text" name="city" placeholder="Arequipa / Lima" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
            </div>

            <div>
                <label class="block font-semibold">Fecha de Estreno</label>
                <input type="date" name="release_date" class="w-full p-2 rounded bg-gray-800 border border-gray-700">
            </div>
        </div>

        <div>
            <label class="block font-semibold">Sinopsis</label>
            <textarea name="synopsis" rows="3" class="w-full p-2 rounded bg-gray-800 border border-gray-700"></textarea>
        </div>

        <div>
            <label class="block font-semibold">Tráiler (URL de YouTube)</label>
            <input type="url" name="trailer_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full p-2 rounded bg-gray-800 border border-gray-700">
        </div>

        <div>
            <label class="block font-semibold">Imagen (poster)</label>
            <input type="file" name="poster" accept="image/*" class="block w-full text-gray-400">
            <small class="text-gray-500">📸 Tamaño recomendado: 600x900 px</small>
        </div>

        <div>
            <label class="block font-semibold">Horarios (JSON)</label>
            <textarea name="schedules" rows="3"
                      placeholder='{"Arequipa":{"Cinerama Mall Aventura":["15:00","18:00"]}}'
                      class="w-full p-2 rounded bg-gray-800 border border-gray-700"></textarea>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-yellow-500 text-black px-8 py-3 rounded font-bold hover:bg-yellow-400 transition-all">
                💾 Guardar Película
            </button>
            <a href="{{ route('admin.movies.index') }}" class="ml-4 text-gray-400 hover:text-yellow-400">↩️ Volver al listado</a>
        </div>
    </form>
</div>
@endsection

