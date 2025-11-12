@extends('layouts.app')

@section('content')
<div class="bg-black text-white">

    <!-- 🎞️ CARRUSEL PRINCIPAL -->
    <div class="relative w-full overflow-hidden">
        <div id="carousel" class="flex transition-transform duration-700">
            <!-- 🎥 Slide 1 -->
            <div class="min-w-full relative">
                <img src="{{ asset('images/proximos/chavin.jpg') }}" class="w-full h-[600px] object-cover opacity-70">
                <div class="absolute inset-0 flex flex-col justify-center items-start px-16">
                    <h1 class="text-5xl font-extrabold text-yellow-400 mb-4">Chavín de Huántar</h1>
                    <p class="max-w-xl text-gray-200 mb-6">
                        En una operación sin precedentes, comandos de élite se infiltran en una embajada sitiada para liberar rehenes.
                    </p>
                    <a href="https://youtu.be/eRQyHKtHLcg" 
                       target="_blank"
                       class="bg-yellow-400 text-black font-bold px-6 py-3 rounded-full hover:bg-yellow-300 transition">
                        🎬 Ver tráiler
                    </a>
                </div>
            </div>

            <!-- 🎥 Slide 2 -->
            <div class="min-w-full relative">
                <img src="{{ asset('images/proximos/avatar3.jpg') }}" class="w-full h-[600px] object-cover opacity-70">
                <div class="absolute inset-0 flex flex-col justify-center items-start px-16">
                    <h1 class="text-5xl font-extrabold text-yellow-400 mb-4">Avatar 3</h1>
                    <p class="max-w-xl text-gray-200 mb-6">
                        La saga continúa con un nuevo capítulo visualmente impresionante que explora nuevos mundos de Pandora.
                    </p>
                    <a href="https://youtu.be/g71Ha1HCWt8" 
                       target="_blank"
                       class="bg-yellow-400 text-black font-bold px-6 py-3 rounded-full hover:bg-yellow-300 transition">
                        🎬 Ver tráiler
                    </a>
                </div>
            </div>

            <!-- 🎥 Slide 3 -->
            <div class="min-w-full relative">
                <img src="{{ asset('images/proximos/thebride.jpg') }}" class="w-full h-[600px] object-cover opacity-70">
                <div class="absolute inset-0 flex flex-col justify-center items-start px-16">
                    <h1 class="text-5xl font-extrabold text-yellow-400 mb-4">The Bride</h1>
                    <p class="max-w-xl text-gray-200 mb-6">
                         En el Chicago de los años treinta, el innovador científico Dr. Euphronious resucita a una joven asesinada para que sea la compañera del monstruo de Frankenstein . Lo que sucede a continuación supera con creces lo que cualquiera de ellos jamás hubiera imaginado.
                    </p>
                    <a href="https://www.youtube.com/watch?v=LJraZRHhFwQ" 
                       target="_blank"
                       class="bg-yellow-400 text-black font-bold px-6 py-3 rounded-full hover:bg-yellow-300 transition">
                        🎬 Ver tráiler
                    </a>
                </div>
            </div>
        </div>

        <!-- 🔘 Controles -->
        <button id="prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-yellow-400 text-black p-3 rounded-full hover:bg-yellow-300 transition">
            ‹
        </button>
        <button id="next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-yellow-400 text-black p-3 rounded-full hover:bg-yellow-300 transition">
            ›
        </button>
    </div>

    <!-- 🔸 TÍTULO DE SECCIÓN -->
    <div class="text-center mt-16 mb-8">
        <h2 class="text-3xl font-bold text-yellow-400">🎥 Próximos Estrenos</h2>
        <p class="text-gray-400 mt-2">¡No te pierdas las películas que están por llegar a Cinerama!</p>
    </div>

    <!-- 🧩 LISTA DE PELÍCULAS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-10 pb-16">
        @foreach ([
            ['titulo' => 'Chavín de Huántar', 'imagen' => 'chavin.jpg', 'fecha' => 'Noviembre 2025', 'trailer' => 'https://youtu.be/eRQyHKtHLcg'],
            ['titulo' => 'Avatar 3', 'imagen' => 'avatar3.jpg', 'fecha' => 'Diciembre 2025', 'trailer' => 'https://youtu.be/g71Ha1HCWt8'],
            ['titulo' => 'The Bride', 'imagen' => 'thebride.jpg', 'fecha' => 'Diciembre 2025', 'trailer' => 'https://www.youtube.com/watch?v=LJraZRHhFwQ'],
            ['titulo' => 'Predator: Badlands', 'imagen' => 'Predator.jpg', 'fecha' => 'Enero 2026', 'trailer' => 'https://youtu.be/XFDuDrlyd-o']
        ] as $pelicula)
        <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden hover:scale-105 transition">
            <img src="{{ asset('images/proximos/' . $pelicula['imagen']) }}" class="w-full h-64 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-xl font-bold text-yellow-400 mb-2">{{ $pelicula['titulo'] }}</h3>
                <p class="text-gray-400 text-sm mb-3">Estreno: {{ $pelicula['fecha'] }}</p>
                <a href="{{ $pelicula['trailer'] }}" 
                   target="_blank" 
                   class="bg-yellow-400 text-black px-4 py-2 rounded-full font-semibold hover:bg-yellow-300 transition">
                    🎬 Ver tráiler
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- 🧠 Script del Carrusel -->
<script>
    const carousel = document.getElementById('carousel');
    const slides = carousel.children.length;
    let index = 0;

    document.getElementById('next').addEventListener('click', () => {
        index = (index + 1) % slides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    });

    document.getElementById('prev').addEventListener('click', () => {
        index = (index - 1 + slides) % slides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    });

    // Cambio automático cada 6s
    setInterval(() => {
        index = (index + 1) % slides;
        carousel.style.transform = `translateX(-${index * 100}%)`;
    }, 6000);
</script>
@endsection

