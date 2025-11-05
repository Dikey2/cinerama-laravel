@extends('layouts.app')

@section('content')
<div 
    class="bg-black text-white min-h-screen py-10" 
    x-data="peliculasApp()">

    <!-- 🏷️ Título -->
    <div class="max-w-6xl mx-auto mb-10 px-4">
        <h1 class="text-4xl font-extrabold text-yellow-400 mb-3">🎬 Películas</h1>
        <div class="flex space-x-8 text-sm border-b border-gray-700 pb-2">
            <button @click="tab = 'cartelera'" 
                    :class="tab === 'cartelera' ? 'text-yellow-400 font-semibold border-b-2 border-yellow-400 pb-1' : 'hover:text-yellow-400 transition'">
                En cartelera
            </button>
        </div>
    </div>

    <!-- 🎞️ Contenedor principal -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 px-4">

        <!-- 🎛️ FILTROS -->
        <aside 
            class="w-full md:w-1/4 bg-gray-900 rounded-xl p-5 shadow-lg border border-gray-700"
            x-data="{ openCity: true, openGenre: true }">

            <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center gap-2">
                🎯 Filtrar por:
            </h3>

            <!-- 🏙️ Ciudad -->
            <div class="mb-3">
                <button @click="openCity = !openCity"
                        class="w-full flex justify-between items-center font-semibold text-white hover:text-yellow-400 transition">
                    Ciudad 
                    <span x-text="openCity ? '▼' : '▶'" class="text-sm"></span>
                </button>
                <ul x-show="openCity" x-transition class="ml-3 mt-2 space-y-1 text-gray-400 text-sm">
                    <li><button @click="filtro.ciudad = 'Lima'" :class="filtro.ciudad === 'Lima' ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'">Lima</button></li>
                    <li><button @click="filtro.ciudad = 'Arequipa'" :class="filtro.ciudad === 'Arequipa' ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'">Arequipa</button></li>
                    <li><button @click="filtro.ciudad = ''" :class="filtro.ciudad === '' ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'">Todas</button></li>
                </ul>
            </div>

            <!-- 🎬 Género -->
            <div class="mb-3">
                <button @click="openGenre = !openGenre"
                        class="w-full flex justify-between items-center font-semibold text-white hover:text-yellow-400 transition">
                    Género 
                    <span x-text="openGenre ? '▼' : '▶'" class="text-sm"></span>
                </button>
                <ul x-show="openGenre" x-transition class="ml-3 mt-2 space-y-1 text-gray-400 text-sm">
                    <template x-for="gen in ['Acción', 'Animación', 'Terror', 'Comedia']" :key="gen">
                        <li><button @click="filtro.genero = gen" :class="filtro.genero === gen ? 'text-yellow-400 font-bold' : 'hover:text-yellow-400'" x-text="gen"></button></li>
                    </template>
                    <li><button @click="filtro.genero = ''" class="hover:text-yellow-400">Todos</button></li>
                </ul>
            </div>
        </aside>

        <!-- 🍿 LISTADO -->
        <section class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="pelicula in peliculasFiltradas" :key="pelicula.titulo">
                    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden hover:shadow-yellow-500 transition">
                        <img :src="'{{ asset('images/peliculas') }}/' + pelicula.imagen" 
                             :alt="pelicula.titulo" 
                             class="w-full h-72 object-cover">
                        <div class="p-4 text-center">
                            <h3 class="font-bold text-lg mb-1 text-yellow-400" x-text="pelicula.titulo"></h3>
                            <p class="text-gray-400 text-sm mb-1" x-text="pelicula.genero + ' (' + pelicula.ciudad + ')'"></p>
                            <p class="text-gray-500 text-xs" x-text="pelicula.duracion + ' • ' + pelicula.clasificacion"></p>
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

    <!-- 🎥 MODAL -->
    <div 
        x-show="modalAbierto" 
        class="fixed inset-0 bg-black/70 flex items-center justify-center z-50" 
        x-transition>
        <div class="bg-gray-900 rounded-2xl p-6 max-w-4xl w-full mx-4 relative">
            
            <!-- Cerrar -->
            <button @click="modalAbierto = false" class="absolute top-3 right-4 text-gray-400 hover:text-yellow-400 text-2xl">&times;</button>

            <div class="flex flex-col md:flex-row gap-6">
                <!-- Imagen -->
                <img :src="'{{ asset('images/peliculas') }}/' + peliculaSeleccionada.imagen" 
                     alt="" class="w-full md:w-1/3 h-80 object-cover rounded-lg">

                <!-- Info -->
                <div class="flex-1">
                    <h2 class="text-3xl font-bold text-yellow-400 mb-2" x-text="peliculaSeleccionada.titulo"></h2>
                    <p class="text-gray-300 text-sm mb-4" x-text="peliculaSeleccionada.sinopsis"></p>

                    <div class="text-gray-400 text-sm mb-3">
                        <strong class="text-yellow-400">Idioma:</strong> <span x-text="peliculaSeleccionada.idioma"></span><br>
                        <strong class="text-yellow-400">Disponible:</strong> <span x-text="peliculaSeleccionada.formato"></span>
                    </div>

                    <!-- Horarios -->
                    <div>
                        <h3 class="text-yellow-400 font-semibold mb-2">🕒 Horarios disponibles</h3>

                        <template x-for="(cines, ciudad) in peliculaSeleccionada.horarios" :key="ciudad">
                            <div class="mb-4">
                                <p class="font-bold text-lg text-yellow-300" x-text="ciudad"></p>
                                <template x-for="(horas, cine) in cines" :key="cine">
                                    <div class="ml-4 mt-2">
                                        <p class="font-semibold text-gray-300" x-text="cine"></p>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            <template x-for="hora in horas" :key="hora">
                                                <!-- 🔗 Redirección a butacas -->
                                                <span 
                                                    @click="window.location.href = `/butacas?pelicula=${encodeURIComponent(peliculaSeleccionada.titulo)}&cine=${encodeURIComponent(cine)}&ciudad=${encodeURIComponent(ciudad)}&hora=${hora}`"
                                                    class="border border-yellow-400 text-yellow-400 rounded-full px-3 py-1 text-sm hover:bg-yellow-400 hover:text-black cursor-pointer transition"
                                                    x-text="hora">
                                                </span>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function peliculasApp() {
    return {
        tab: 'cartelera',
        modalAbierto: false,
        peliculaSeleccionada: {},
        filtro: { ciudad: '', genero: '' },
        peliculas: [
            {
                titulo: 'Chavín de Huántar',
                imagen: 'chavin.jpg',
                genero: 'Acción',
                duracion: '1h 35m',
                clasificacion: '+14',
                formato: '2D, PRIME, XTREME',
                idioma: 'Doblada',
                ciudad: 'Arequipa',
                sinopsis: 'Comandos de élite se infiltran en una embajada sitiada por terroristas para liberar rehenes en una misión de alto riesgo.',
                horarios: {
                    'Arequipa': {
                        'Cinerama Mall Aventura': ['15:00', '17:30', '20:00', '22:30'],
                        'Cinerama Paseo central': ['16:00', '18:30', '21:00']
                    },
                    'Lima': {
                        'Mall del sur': ['14:00', '16:40', '19:20', '22:00']
                    }
                }
            },
            {
                titulo: 'El Cadáver de la Novia',
                imagen: 'cadaver.jpg',
                genero: 'Animación',
                duracion: '1h 18m',
                clasificacion: '+13',
                formato: '2D',
                idioma: 'Español',
                ciudad: 'Arequipa',
                sinopsis: 'Un joven accidentalmente se casa con una novia cadáver y es arrastrado al mundo de los muertos.',
                horarios: {
                    'Arequipa': {
                        'Cinerama Paseo Central': ['13:00', '15:00', '17:00']
                    }
                }
            },
            {
                titulo: 'El Resplandor',
                imagen: 'resplandor.jpg',
                genero: 'Terror',
                duracion: '2h 24m',
                clasificacion: '+14',
                formato: 'XD',
                idioma: 'Subtitulado',
                ciudad: 'Lima',
                sinopsis: 'Un escritor pierde la cordura mientras cuida un hotel aislado durante el invierno junto a su familia.',
                horarios: {
                    'Lima': {
                        'Cinerama Larcomar': ['18:00', '21:00']
                    }
                }
            }
        ],
        get peliculasFiltradas() {
            return this.peliculas.filter(p => 
                (!this.filtro.genero || p.genero.includes(this.filtro.genero)) &&
                (!this.filtro.ciudad || p.ciudad === this.filtro.ciudad)
            );
        },
        abrirModal(pelicula) {
            this.peliculaSeleccionada = pelicula;
            this.modalAbierto = true;
        }
    };
}
</script>
@endsection









