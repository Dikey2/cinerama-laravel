@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen">

    <!-- 🎥 CARRUSEL DE PRÓXIMOS ESTRENOS -->
    <div class="relative w-full overflow-hidden">

        <!-- 🔁 Contenedor del carrusel -->
        <div id="carousel" class="whitespace-nowrap transition-transform duration-700 ease-in-out">
            @foreach($peliculas as $index => $movie)
                <div class="inline-block w-full relative">
                    <img src="{{ asset('images/peliculas/' . $movie['image']) }}" 
                         alt="{{ $movie['title'] }}" 
                         class="w-full h-[550px] object-cover opacity-70">

                    <!-- 🟡 Información superpuesta -->
                    <div class="absolute inset-0 flex flex-col justify-center items-start px-16">
                        <span class="bg-pink-600 text-white px-3 py-1 rounded-full text-sm mb-4">🎬 Estreno</span>
                        <h1 class="text-5xl font-extrabold text-yellow-400 mb-3 drop-shadow-lg">
                            {{ $movie['title'] }}
                        </h1>
                        <p class="text-gray-200 max-w-xl text-lg leading-relaxed mb-6">
                            {{ $movie['description'] ?? 'Disfruta de esta emocionante historia en tu cine favorito.' }}
                        </p>
                        <a href="#" 
                           class="bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-3 rounded-full font-bold shadow-md transition">
                           🎟️ Comprar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ⬅️➡️ Controles -->
        <button id="prev" 
                class="absolute left-5 top-1/2 transform -translate-y-1/2 bg-yellow-500 text-black p-3 rounded-full shadow hover:bg-yellow-400">
            ‹
        </button>
        <button id="next" 
                class="absolute right-5 top-1/2 transform -translate-y-1/2 bg-yellow-500 text-black p-3 rounded-full shadow hover:bg-yellow-400">
            ›
        </button>
    </div>

    <!-- 🎞️ Sección de Próximos Estrenos (rejilla) -->
    <div class="max-w-6xl mx-auto mt-12 px-6">
        <h2 class="text-3xl font-bold text-yellow-400 mb-8">📅 Próximos Estrenos ({{ $sortType }}Sort)</h2>

        <!-- Buscador y Orden -->
        <div class="flex justify-between items-center mb-6">
            <form action="{{ route('home') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ $search }}" 
                       placeholder="Buscar película o género..."
                       class="bg-gray-900 text-white px-5 py-2 rounded-lg w-72 focus:ring-2 focus:ring-yellow-400">
                <button class="bg-yellow-500 hover:bg-yellow-400 text-black px-4 py-2 rounded-lg">
                    🔍 Buscar
                </button>
            </form>

            <div>
                <a href="{{ route('home', ['sort' => 'merge']) }}" 
                   class="bg-gray-800 text-yellow-400 px-4 py-2 rounded hover:bg-yellow-700">Ordenar (MergeSort)</a>
                <a href="{{ route('home', ['sort' => 'quick']) }}" 
                   class="bg-gray-800 text-yellow-400 px-4 py-2 rounded hover:bg-yellow-700 ml-2">Ordenar (QuickSort)</a>
            </div>
        </div>

        <!-- Cartelera -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($peliculas as $movie)
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:shadow-yellow-500 transition">
                    <div class="relative">
                        <img src="{{ asset('images/peliculas/' . $movie['image']) }}" 
                             alt="{{ $movie['title'] }}"
                             class="w-full h-72 object-cover">
                        <span class="absolute top-2 left-2 bg-pink-600 text-xs px-3 py-1 rounded-full font-bold shadow">
                            Estreno
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1">{{ $movie['title'] }}</h3>
                        <p class="text-gray-400 text-sm mb-1">{{ $movie['genre'] }}</p>
                        <p class="text-gray-500 text-xs">{{ $movie['duration'] ?? '—' }} • {{ $movie['rating'] ?? '—' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center w-full col-span-full">
                    No hay próximos estrenos por el momento 🎥
                </p>
            @endforelse
        </div>
    </div>
</div>

<!-- 🌀 Script de carrusel -->
<script>
    const carousel = document.getElementById('carousel');
    const totalSlides = {{ count($peliculas) }};
    let index = 0;

    document.getElementById('next').addEventListener('click', () => {
        index = (index + 1) % totalSlides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    });

    document.getElementById('prev').addEventListener('click', () => {
        index = (index - 1 + totalSlides) % totalSlides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    });

    // 🔄 Movimiento automático cada 6 segundos
    setInterval(() => {
        index = (index + 1) % totalSlides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 6000);
</script>
@endsection






