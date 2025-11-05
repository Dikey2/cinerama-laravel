@extends('layouts.app')

@section('content')
@php
    $pelicula = request('pelicula');
    $cine = request('cine');
    $ciudad = request('ciudad');
    $hora = request('hora');
@endphp

<div class="bg-gray-100 min-h-screen py-10 px-4" x-data="butacasApp()">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg flex flex-col md:flex-row overflow-hidden">

        <!-- 🧾 Panel lateral -->
        <aside class="bg-white md:w-1/3 border-r border-gray-300 p-6">
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ asset('images/peliculas/chavin.jpg') }}" alt="Póster" class="w-20 h-28 object-cover rounded">
                <div>
                    <h2 class="font-bold text-gray-800 text-lg">{{ $pelicula }}</h2>
                    <p class="text-gray-600 text-sm">2D, REGULAR, DOBLADA</p>
                    <p class="mt-2 font-semibold text-blue-700">🎬 {{ $cine }}</p>
                    <p class="text-sm text-gray-700">📍 {{ $ciudad }}</p>
                    <p class="text-sm text-gray-700">🕒 {{ $hora }}</p>
                    <p class="text-sm text-gray-700">🎞️ Sala 3</p>
                </div>
            </div>
        </aside>

        <!-- 🎟️ Mapa de butacas -->
        <main class="flex-1 bg-gray-50 p-6">
            <h3 class="text-center text-lg font-semibold text-gray-700 mb-4">Pantalla</h3>
            <div class="bg-gray-300 h-2 w-2/3 mx-auto rounded mb-6"></div>

            <!-- Grilla de butacas -->
            <div class="flex flex-col items-center gap-1 mb-6">
                <template x-for="fila in filas" :key="fila">
                    <div class="flex gap-1">
                        <template x-for="columna in columnas" :key="columna">
                            <div 
                                @click="toggleButaca(fila, columna)"
                                :class="{
                                    'bg-blue-600 text-white': esSeleccionada(fila, columna),
                                    'bg-red-500': esOcupada(fila, columna),
                                    'bg-gray-200 hover:bg-gray-300 cursor-pointer': !esOcupada(fila, columna) && !esSeleccionada(fila, columna)
                                }"
                                class="w-6 h-6 rounded flex items-center justify-center text-xs font-bold">
                                <span x-text="fila + columna"></span>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Leyenda -->
            <div class="flex justify-center gap-6 text-sm text-gray-600 mb-6">
                <div><span class="inline-block w-4 h-4 bg-gray-200 border rounded mr-1"></span>Disponible</div>
                <div><span class="inline-block w-4 h-4 bg-red-500 border rounded mr-1"></span>Ocupada</div>
                <div><span class="inline-block w-4 h-4 bg-blue-600 border rounded mr-1"></span>Seleccionada</div>
            </div>

            <!-- Selección -->
            <div class="text-center">
                <p class="text-gray-600 text-sm mb-2">
                    Butacas seleccionadas: 
                    <span class="font-semibold text-blue-600" x-text="butacasSeleccionadas.join(', ') || 'Ninguna'"></span>
                </p>

                <!-- 🔗 Redirección a selección de entradas -->
                <button 
                    class="bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-500 disabled:opacity-50"
                    :disabled="butacasSeleccionadas.length === 0"
                    @click="continuar()">
                    Continuar
                </button>
            </div>
        </main>
    </div>
</div>

<script>
function butacasApp() {
    return {
        filas: ['A','B','C','D','E','F','G','H','I','J','K'],
        columnas: [1,2,3,4,5,6,7,8,9,10,11,12],
        ocupadas: ['E5','E6','F7','G8'],
        butacasSeleccionadas: [],

        toggleButaca(fila, columna) {
            const id = fila + columna;
            if (this.ocupadas.includes(id)) return;
            if (this.butacasSeleccionadas.includes(id)) {
                this.butacasSeleccionadas = this.butacasSeleccionadas.filter(b => b !== id);
            } else {
                this.butacasSeleccionadas.push(id);
            }
        },

        esOcupada(fila, columna) {
            return this.ocupadas.includes(fila + columna);
        },

        esSeleccionada(fila, columna) {
            return this.butacasSeleccionadas.includes(fila + columna);
        },

        continuar() {
            if (this.butacasSeleccionadas.length === 0) return;

            // 🔒 Reservar temporalmente las butacas antes de continuar
            fetch("{{ route('reservas.reservar') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    pelicula: "{{ $pelicula }}",
                    cine: "{{ $cine }}",
                    ciudad: "{{ $ciudad }}",
                    hora: "{{ $hora }}",
                    butacas: this.butacasSeleccionadas,
                }),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    console.log("Butacas reservadas hasta:", data.limite);

                    // 🕐 Redirigir a selección de entradas
                    window.location.href = `/entradas?pelicula={{ urlencode($pelicula) }}&cine={{ urlencode($cine) }}&ciudad={{ urlencode($ciudad) }}&hora={{ urlencode($hora) }}&butacas=${encodeURIComponent(this.butacasSeleccionadas.join(','))}`;
                } else {
                    alert("⚠️ No se pudieron reservar las butacas. Intenta nuevamente.");
                }
            })
            .catch(() => alert("❌ Error al conectar con el servidor."));
        }
    };
}
</script>
@endsection

