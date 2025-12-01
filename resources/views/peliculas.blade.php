@extends('layouts.app')

@section('content')
<div 
    class="bg-black text-white min-h-screen py-10" 
    x-data="peliculasApp({{ json_encode($peliculas) }})">

    <!-- 🏷️ Título -->
    <div class="max-w-6xl mx-auto mb-10 px-4">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-3"> Películas</h1>
        <div class="flex space-x-8 text-sm border-b border-gray-700 pb-2">
            <button @click="tab = 'cartelera'" 
                :class="tab === 'cartelera' 
                    ? 'text-yellow-400 font-semibold border-b-2 border-yellow-400 pb-1' 
                    : 'hover:text-yellow-400 transition'">
                En cartelera
            </button>
        </div>
    </div>

    <!-- 🎞️ Contenido -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4">

        <!-- 🎛️ Filtros -->
        <aside 
            class="w-full md:w-1/4 bg-gray-900 rounded-xl p-5 shadow-lg border border-gray-700"
            x-data="{ openCity: true, openGenre: true }">

            <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center gap-2">
                 Filtrar por:
            </h3>

            <!-- Ciudad -->
            <div class="mb-3">
                <button @click="openCity = !openCity"
                    class="w-full flex justify-between items-center font-semibold text-white hover:text-yellow-400 transition">
                    Ciudad 
                    <span x-text="openCity ? '▼' : '▶'"></span>
                </button>
                <ul x-show="openCity" x-transition class="ml-3 mt-2 text-gray-400 text-sm space-y-1">
                    <li><button @click="filtro.ciudad = 'Lima'" :class="filtro.ciudad === 'Lima' ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'">Lima</button></li>
                    <li><button @click="filtro.ciudad = 'Arequipa'" :class="filtro.ciudad === 'Arequipa' ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'">Arequipa</button></li>
                    <li><button @click="filtro.ciudad = ''" :class="filtro.ciudad === '' ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'">Todas</button></li>
                </ul>
            </div>

            <!-- Género -->
            <div class="mb-3">
                <button @click="openGenre = !openGenre"
                    class="w-full flex justify-between items-center font-semibold text-white hover:text-yellow-400 transition">
                    Género 
                    <span x-text="openGenre ? '▼' : '▶'"></span>
                </button>

                <ul x-show="openGenre" x-transition class="ml-3 mt-2 text-gray-400 text-sm space-y-1">
                    <template x-for="gen in generosUnicos" :key="gen">
                        <li>
                            <button 
                                @click="filtro.genero = gen"
                                :class="filtro.genero === gen ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'"
                                x-text="gen">
                            </button>
                        </li>
                    </template>
                    <li><button @click="filtro.genero = ''" class="hover:text-yellow-400">Todos</button></li>
                </ul>
            </div>
        </aside>

        <!-- 🍿 Listado -->
        <section class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <template x-for="pelicula in peliculasFiltradas" :key="pelicula.id">

                    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden hover:shadow-yellow-500 transition">

                        <!-- Imagen -->
                        <img 
    :src="pelicula.image 
        ? '/' + pelicula.image 
        : '{{ asset('images/peliculas/default.jpg') }}'"
    :alt="pelicula.title"
    class="w-full h-72 object-cover">


                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1 text-yellow-400" x-text="pelicula.title"></h3>
                            <p class="text-gray-400 text-sm mb-1" x-text="pelicula.genre + ' (' + pelicula.city + ')'"></p>
                            <p class="text-gray-500 text-xs" x-text="pelicula.duration + ' • ' + pelicula.classification"></p>

                            <button 
                                @click="abrirModal(pelicula)" 
                                class="mt-3 bg-yellow-400 text-black font-semibold py-1 px-4 rounded-full hover:bg-yellow-300 transition">
                                Comprar
                            </button>
                        </div>
                    </div>

                </template>
            </div>
        </section>
    </div>

    <!-- 🎥 Modal -->
<div 
    x-show="modalAbierto" 
    class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4" 
    x-transition>
        
    <div class="bg-gray-900 rounded-xl p-5 max-w-3xl w-full mx-4 relative shadow-lg border border-gray-800">

        <!-- ❌ botón cerrar -->
        <button @click="modalAbierto = false" 
            class="absolute top-2 right-3 text-gray-400 hover:text-yellow-400 text-xl">&times;
        </button>

        <div class="flex flex-col md:flex-row gap-4">

            <!-- Imagen -->
            <img 
    :src="peliculaSeleccionada.image 
        ? '/' + peliculaSeleccionada.image 
        : '{{ asset('images/peliculas/default.jpg') }}'"
    class="w-full md:w-1/3 h-64 object-cover rounded-lg shadow-md">


            <!-- Info -->
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-yellow-400 mb-1" x-text="peliculaSeleccionada.title"></h2>

                <p class="text-gray-300 text-xs mb-3 leading-relaxed"
                   x-text="peliculaSeleccionada.description || 'Sin descripción disponible.'"></p>

                <!-- Horarios -->
                <h3 class="text-yellow-400 font-semibold mb-1 text-sm">🕒 Horarios</h3>

                <template x-if="peliculaSeleccionada.showtimes.length === 0">
                    <p class="text-gray-400 text-xs">No hay horarios disponibles.</p>
                </template>

                <template x-if="peliculaSeleccionada.showtimes.length > 0">
                    <div class="space-y-4">

                        <!-- AGRUPADO POR CINE -->
                        <template x-for="(funciones, cine) in agruparPorCine(peliculaSeleccionada.showtimes)" :key="cine">

                            <div class="pb-2 border-b border-gray-700">

                                <p class="text-yellow-300 font-semibold text-base" x-text="cine"></p>

                                <!-- AGRUPADO POR FORMATO + IDIOMA -->
                                <template x-for="(grupo, etiqueta) in agruparPorFormatoIdioma(funciones)" :key="etiqueta">

                                    <div class="mt-1">
                                        <p class="text-gray-300 font-semibold text-xs uppercase tracking-wide mb-1"
                                           x-text="etiqueta"></p>

                                        <div class="flex flex-wrap gap-2">

                                            <!-- BOTÓN COMPACTO -->
                                            <template x-for="funcion in grupo" :key="funcion.id">
                                                <a 
                                                    :href="'/funcion/' + funcion.id + '/asientos'"
                                                    class="px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500
                                                           text-black rounded-md font-bold text-xs shadow">
                                                    <span x-text="funcion.time"></span>
                                                </a>
                                            </template>

                                        </div>
                                    </div>

                                </template>

                            </div>

                        </template>

                    </div>
                </template>
            </div>
        </div>
    </div>
</div>


</div>
<script>
function peliculasApp(peliculas) {
    return {
        tab: 'cartelera',
        modalAbierto: false,
        peliculaSeleccionada: {},

        filtro: {
            ciudad: '',
            genero: '',
        },

        peliculas,

        // 🔥 FILTRAR PELÍCULAS
        get peliculasFiltradas() {
            return this.peliculas.filter(p => 
                (this.filtro.ciudad === '' || p.city.includes(this.filtro.ciudad)) &&
                (this.filtro.genero === '' || p.genre === this.filtro.genero)
            );
        },

        // 🔥 GENERAR LISTA DE GÉNEROS ÚNICOS
        get generosUnicos() {
            return [...new Set(this.peliculas.map(p => p.genre))];
        },

        // 🔥 ABRIR MODAL
        abrirModal(peli) {
            this.peliculaSeleccionada = peli;
            this.modalAbierto = true;
        },

        // 🔥 AGRUPAR SHOWTIMES POR CINE (ARREGLADO)
        agruparPorCine(showtimes) {
            const group = {};
        
            showtimes.forEach(s => {
                const key = s.cinema ?? "Sin cine";
                if (!group[key]) group[key] = [];
                group[key].push(s);
            });
        
            return group;
        },

        // 🔥 AGRUPAR POR FORMATO + IDIOMA
        agruparPorFormatoIdioma(funciones) {
            const group = {};

            funciones.forEach(f => {
                const key = `${f.format} - ${f.language}`;
                if (!group[key]) group[key] = [];
                group[key].push(f);
            });

            return group;
        },
    }
}
</script>



@endsection




















