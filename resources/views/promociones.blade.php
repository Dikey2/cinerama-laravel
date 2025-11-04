@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-8">Promociones</h1>
        <p class="text-gray-400 mb-10 text-lg">Aprovecha nuestras promociones exclusivas y disfruta de la experiencia Cinerama 🍿</p>

        <!-- CARRUSEL -->
        <div class="relative w-full overflow-hidden rounded-2xl shadow-2xl" id="promoCarousel">
            <div class="flex transition-transform duration-700 ease-in-out" id="carouselInner">

                <!-- Promo 1 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/entel.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">🎟️ Promo 2x1 con Entel</h2>
                        <p class="text-gray-300 mb-5">Disfruta todo el año tus películas favoritas con tu línea Entel. Solo en Cinerama.</p>
                        <a href="{{ route('promo.entel') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Ver Términos</a>
                    </div>
                </div>

                <!-- Promo 2 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/pareja.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">🍿 Combo Pareja</h2>
                        <p class="text-gray-300 mb-5">Compra 2 entradas y recibe un balde de canchita + gaseosa de cortesía.</p>
                        <a href="{{ route('promo.pareja') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Ver Detalles</a>
                    </div>
                </div>

                <!-- Promo 3 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/estudiante.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">🎓 Descuento Estudiantil</h2>
                        <p class="text-gray-300 mb-5">Presenta tu carnet universitario y obtén 20% de descuento de lunes a jueves.</p>
                        <a href="{{ route('promo.estudiante') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Más Información</a>
                    </div>
                </div>

                <!-- Promo 4 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/cumple.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">🎉 Cumpleaños Cinerama</h2>
                        <p class="text-gray-300 mb-5">Celebra tu cumpleaños en Cinerama con entrada gratis y un combo sorpresa.</p>
                        <a href="{{ route('promo.cumple') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Más Información</a>
                    </div>
                </div>

                <!-- Promo 5 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/vip.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">💺 Butaca VIP</h2>
                        <p class="text-gray-300 mb-5">Entradas VIP con 30% de descuento los martes y miércoles en todas las funciones.</p>
                        <a href="{{ route('promo.vip') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Ver Detalles</a>
                    </div>
                </div>

                <!-- Promo 6 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/familia.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">👨‍👩‍👧‍👦 Plan Familiar</h2>
                        <p class="text-gray-300 mb-5">Ven con tu familia y paga solo 3 entradas por 4 personas. ¡Diversión asegurada!</p>
                        <a href="{{ route('promo.familia') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Ver Más</a>
                    </div>
                </div>

                <!-- Promo 7 -->
                <div class="w-full flex-shrink-0 bg-gray-900 p-6 flex flex-col md:flex-row items-center justify-between">
                    <img src="{{ asset('images/promociones/socio.png') }}" class="w-full md:w-1/2 rounded-xl">
                    <div class="md:w-1/2 md:ml-10 text-left">
                        <h2 class="text-3xl font-bold text-yellow-400 mb-3">💳 Socio Cinerama</h2>
                        <p class="text-gray-300 mb-5">Regístrate como socio y accede a preventas exclusivas y beneficios permanentes.</p>
                        <a href="{{ route('promo.socio') }}" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">Ver Más</a>
                    </div>
                </div>

            </div>

            <!-- Botones de navegación -->
            <button id="prevBtn" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-yellow-500 text-black px-3 py-2 rounded-full hover:bg-yellow-400">←</button>
            <button id="nextBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-yellow-500 text-black px-3 py-2 rounded-full hover:bg-yellow-400">→</button>
        </div>
    </div>
</div>

<!-- JS Carrusel -->
<script>
    const carouselInner = document.getElementById('carouselInner');
    const totalSlides = carouselInner.children.length;
    let index = 0;

    document.getElementById('nextBtn').addEventListener('click', () => {
        index = (index + 1) % totalSlides;
        updateCarousel();
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        index = (index - 1 + totalSlides) % totalSlides;
        updateCarousel();
    });

    function updateCarousel() {
        carouselInner.style.transform = `translateX(-${index * 100}%)`;
    }

    // Auto-rotación
    setInterval(() => {
        index = (index + 1) % totalSlides;
        updateCarousel();
    }, 6000);
</script>
@endsection

