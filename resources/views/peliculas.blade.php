@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen py-10">

    <!-- 🏷️ Título -->
    <div class="max-w-6xl mx-auto mb-10 px-4">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-3">🎬 Películas</h1>
        <div class="flex space-x-8 text-sm border-b border-gray-700 pb-2">
            <button class="text-yellow-400 font-semibold border-b-2 border-yellow-400 pb-1">En cartelera</button>
            <button class="hover:text-yellow-400 transition">Preventas</button>
            <button class="hover:text-yellow-400 transition">Próximos estrenos</button>
            <button class="hover:text-yellow-400 transition">The Twilight Saga</button>
        </div>
    </div>

    <!-- 🎞️ Contenedor principal -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4">

        <!-- 🎛️ FILTROS -->
        <aside class="w-full md:w-1/4 bg-gray-900 rounded-xl p-5 shadow-lg border border-gray-700">
            <h3 class="text-xl font-bold text-yellow-400 mb-4">🎯 Filtrar por:</h3>

            <details class="mb-3">
                <summary class="cursor-pointer font-semibold text-white">Ciudad</summary>
                <ul class="ml-3 mt-2 space-y-1 text-gray-400 text-sm">
                    <li>Lima</li>
                    <li>Arequipa</li>
                    <li>Cusco</li>
                    <li>Trujillo</li>
                </ul>
            </details>

            <details class="mb-3">
                <summary class="cursor-pointer font-semibold text-white">Género</summary>
                <ul class="ml-3 mt-2 space-y-1 text-gray-400 text-sm">
                    <li>Acción</li>
                    <li>Animación</li>
                    <li>Terror</li>
                    <li>Comedia</li>
                </ul>
            </details>

            <details class="mb-3">
                <summary class="cursor-pointer font-semibold text-white">Formato</summary>
                <ul class="ml-3 mt-2 space-y-1 text-gray-400 text-sm">
                    <li>2D</li>
                    <li>3D</li>
                    <li>XD</li>
                </ul>
            </details>

            <details>
                <summary class="cursor-pointer font-semibold text-white">Idioma</summary>
                <ul class="ml-3 mt-2 space-y-1 text-gray-400 text-sm">
                    <li>Español</li>
                    <li>Subtitulado</li>
                </ul>
            </details>
        </aside>

        <!-- 🍿 LISTADO DE PELÍCULAS -->
        <section class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($peliculas as $pelicula)
                    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden hover:shadow-yellow-500 transition">
                        <div class="relative">
                            <img src="{{ asset('images/peliculas/' . $pelicula->imagen) }}" 
                                 alt="{{ $pelicula->titulo }}" 
                                 class="w-full h-72 object-cover">
                            <span class="absolute top-2 left-2 bg-pink-600 text-xs px-3 py-1 rounded-full font-bold shadow">
                                Estreno
                            </span>
                        </div>

                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">{{ $pelicula->titulo }}</h3>
                            <p class="text-gray-400 text-sm mb-1">{{ $pelicula->genero }}</p>
                            <p class="text-gray-500 text-xs">{{ $pelicula->duracion }} • {{ $pelicula->clasificacion }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 🔘 Ver más -->
            <div class="text-center mt-10">
                <button class="border border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-black font-semibold px-6 py-2 rounded-full transition">
                    Ver más películas
                </button>
                <p class="text-gray-500 text-xs mt-3">(R) Película con restricción del distribuidor. No válida para promociones o boletos corporativos.</p>
            </div>
        </section>
    </div>
</div>
@endsection
