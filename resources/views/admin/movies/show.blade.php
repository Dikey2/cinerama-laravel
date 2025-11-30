@extends('layouts.app')

@section('content')
<div class="bg-black min-h-screen text-white p-10">
    <div class="max-w-5xl mx-auto">

        <!-- 🔙 Botón Volver -->
        <a href="{{ route('admin.movies.index') }}" 
           class="inline-block mb-6 bg-gray-800 text-yellow-400 px-4 py-2 rounded hover:bg-gray-700 transition">
           ← Volver al listado
        </a>

        <!-- 🎬 Detalles de la Película -->
        <div class="flex flex-col md:flex-row gap-8 bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700">
            
            <!-- 📸 Poster -->
            <div class="flex-shrink-0 w-full md:w-1/3">
                @if($movie->image)
                    <img src="{{ asset('storage/' . $movie->image) }}" 
                         alt="{{ $movie->title }}" 
                         class="rounded-lg shadow-md w-full object-cover h-[400px] border border-gray-700">
                @else
                    <div class="bg-gray-800 h-[400px] flex items-center justify-center rounded-lg text-gray-500">
                        Sin imagen disponible
                    </div>
                @endif
            </div>

            <!-- 🧾 Información -->
            <div class="flex-1 space-y-4">
                <h1 class="text-4xl font-extrabold text-yellow-400">{{ $movie->title }}</h1>

                <p class="text-gray-300 text-sm italic">
                    {{ $movie->genre }} | 
                    {{ $movie->duration ?? '—' }} | 
                    {{ $movie->classification ?? 'Sin clasificar' }}
                </p>

                <p class="text-gray-400 leading-relaxed mt-4">
                    {{ $movie->synopsis ?? 'Sin sinopsis registrada.' }}
                </p>

                <div class="grid grid-cols-2 gap-4 mt-6 text-sm text-gray-300">
                    <div><strong class="text-yellow-400">🎞 Formato:</strong> {{ $movie->format ?? 'N/A' }}</div>
                    <div><strong class="text-yellow-400">🗣 Idioma:</strong> {{ $movie->language ?? 'N/A' }}</div>
                    <div><strong class="text-yellow-400">📍 Ciudad:</strong> {{ $movie->city ?? 'N/A' }}</div>
                    <div><strong class="text-yellow-400">📅 Estreno:</strong> 
                        {{ $movie->release_date ? $movie->release_date->format('d/m/Y') : 'Sin fecha' }}
                    </div>
                </div>

                <!-- 🎥 Tráiler -->
                @if($movie->trailer_url)
                    <div class="mt-6">
                        <a href="{{ $movie->trailer_url }}" target="_blank"
                           class="bg-yellow-500 text-black font-bold px-5 py-2 rounded-full hover:bg-yellow-400 transition">
                            🎬 Ver Tráiler
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- 🕒 Horarios REALES (pendiente de integrar con showtimes) -->
        <div class="bg-gray-900 mt-10 p-6 rounded-xl border border-gray-700">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">🕒 Horarios</h2>

            <p class="text-gray-400 italic">
                Los horarios se gestionan desde <strong>Showtimes</strong> y se mostrarán en esta sección próximamente.
            </p>
        </div>

    </div>
</div>
@endsection

