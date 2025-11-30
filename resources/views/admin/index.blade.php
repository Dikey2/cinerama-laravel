@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen text-white p-10">

    {{-- 🔥 Título principal + Botón --}}
    <h1 class="text-3xl font-bold text-yellow-400 mb-6">🎞️ Lista de Películas</h1>

    <a href="{{ route('admin.movies.create') }}"
       class="bg-yellow-500 text-black px-4 py-2 rounded font-semibold hover:bg-yellow-400 mb-6 inline-block transition">
       ➕ Nueva Película
    </a>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-600 text-white px-4 py-2 rounded mb-6 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- ============================= --}}
    {{--    TABLA COMPLETA MODERNA    --}}
    {{-- ============================= --}}
    @if ($movies->count() > 0)
        <div class="overflow-x-auto mb-10">
            <table class="w-full border border-gray-700 text-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-yellow-400 uppercase text-xs">
                    <tr>
                        <th class="p-3 border">#</th>
                        <th class="p-3 border">Poster</th>
                        <th class="p-3 border">Título</th>
                        <th class="p-3 border">Género</th>
                        <th class="p-3 border">Duración</th>
                        <th class="p-3 border">Ciudad</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr class="text-center border-b border-gray-700 hover:bg-gray-900 transition">
                            <td class="p-3">{{ $movie->id }}</td>
                            
                            <td class="p-3">
                                @if($movie->poster)
                                    <img src="{{ asset('storage/images/peliculas/' . basename($movie->poster)) }}"
                                         alt="Poster {{ $movie->title }}"
                                         class="w-16 h-24 object-cover rounded mx-auto shadow-md">
                                @else
                                    <span class="text-gray-500 italic">Sin imagen</span>
                                @endif
                            </td>

                            <td class="p-3 font-semibold text-yellow-300">{{ $movie->title }}</td>
                            <td class="p-3">{{ $movie->genre }}</td>
                            <td class="p-3">{{ $movie->duration ?? '-' }}</td>
                            <td class="p-3">{{ $movie->city ?? '-' }}</td>

                            <td class="p-3 space-x-3">
                                <a href="{{ route('admin.movies.edit', $movie) }}"
                                   class="text-blue-400 hover:text-blue-300 font-semibold">
                                   ✏️ Editar
                                </a>

                                @if($movie->trailer_url)
                                    <a href="{{ $movie->trailer_url }}" target="_blank"
                                       class="text-yellow-400 hover:text-yellow-300 font-semibold">
                                       🎬 Ver Tráiler
                                    </a>
                                @endif

                                <form action="{{ route('admin.movies.destroy', $movie) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta película? ⚠️');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-400 font-semibold">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        {{-- Si no hay películas --}}
        <div class="bg-gray-900 text-center py-10 rounded-lg border border-gray-700">
            <p class="text-gray-400 text-lg">🎬 No hay películas registradas aún.</p>

            <a href="{{ route('admin.movies.create') }}"
               class="mt-4 inline-block bg-yellow-500 text-black px-4 py-2 rounded font-semibold hover:bg-yellow-400 transition">
               ➕ Agregar la primera película
            </a>
        </div>
    @endif

</div>
@endsection




