<x-app-layout>

    <div class="max-w-6xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-bold text-center text-yellow-400 mb-8">
            Promociones Especiales
        </h1>

        {{-- CARRUSEL --}}
        <div x-data="{ slide: 1 }" class="relative">

            {{-- Slides --}}
            <div class="overflow-hidden rounded-lg shadow-lg">

                {{-- 1 - Cumpleaños --}}
                <div x-show="slide === 1" class="w-full">
                    <a href="{{ route('promociones.cumple') }}">
                        <img src="/images/promos/cumple.png" class="w-full h-96 object-cover" alt="Promo Cumpleaños">
                    </a>
                </div>

                {{-- 2 - Entel --}}
                <div x-show="slide === 2" class="w-full">
                    <a href="{{ route('promociones.entel') }}">
                        <img src="/images/promos/entel.png" class="w-full h-96 object-cover" alt="Promo Entel">
                    </a>
                </div>

                {{-- 3 - Estudiante --}}
                <div x-show="slide === 3" class="w-full">
                    <a href="{{ route('promociones.estudiante') }}">
                        <img src="/images/promos/estudiante.png" class="w-full h-96 object-cover" alt="Promo Estudiante">
                    </a>
                </div>

                {{-- 4 - Familia --}}
                <div x-show="slide === 4" class="w-full">
                    <a href="{{ route('promociones.familia') }}">
                        <img src="/images/promos/familia.png" class="w-full h-96 object-cover" alt="Promo Familia">
                    </a>
                </div>

                {{-- 5 - Pareja --}}
                <div x-show="slide === 5" class="w-full">
                    <a href="{{ route('promociones.pareja') }}">
                        <img src="/images/promos/pareja.png" class="w-full h-96 object-cover" alt="Promo Pareja">
                    </a>
                </div>

                {{-- 6 - Socio --}}
                <div x-show="slide === 6" class="w-full">
                    <a href="{{ route('promociones.socio') }}">
                        <img src="/images/promos/socio.png" class="w-full h-96 object-cover" alt="Promo Socio">
                    </a>
                </div>

                {{-- 7 - VIP --}}
                <div x-show="slide === 7" class="w-full">
                    <a href="{{ route('promociones.vip') }}">
                        <img src="/images/promos/vip.png" class="w-full h-96 object-cover" alt="Promo VIP">
                    </a>
                </div>

            </div>

            {{-- Botones izquierda/derecha --}}
            <button @click="slide = slide === 1 ? 7 : slide - 1"
                    class="absolute top-1/2 left-0 -translate-y-1/2 bg-black/50 text-white px-4 py-2">
                ❮
            </button>

            <button @click="slide = slide === 7 ? 1 : slide + 1"
                    class="absolute top-1/2 right-0 -translate-y-1/2 bg-black/50 text-white px-4 py-2">
                ❯
            </button>

            {{-- Indicadores --}}
            <div class="flex justify-center mt-4 space-x-2">
                <template x-for="i in 7">
                    <button @click="slide = i"
                        class="w-3 h-3 rounded-full"
                        :class="slide === i ? 'bg-yellow-400' : 'bg-gray-500'"></button>
                </template>
            </div>

        </div>

    </div>

</x-app-layout>

