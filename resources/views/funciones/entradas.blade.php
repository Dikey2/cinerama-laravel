@extends('layouts.app-cinerama')

@section('content')


<div class="min-h-screen bg-[#0b0b0b] text-white flex justify-center pt-4 px-4">

    <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-4 gap-8">

        <!-- ▬▬▬ PANEL LATERAL ▬▬▬ -->
        <aside class="md:col-span-1 bg-[#111] rounded-xl p-6 shadow-xl border border-[#222]">

            <img 
                src="{{ asset($showtime->movie->image) }}"
                onerror="this.src='{{ asset('images/peliculas/default.jpg') }}'"
                class="w-full rounded-lg shadow mb-4"
            />

            <h2 class="text-xl font-bold mb-2">{{ $showtime->movie->title }}</h2>
            <p class="text-sm text-gray-300">🎥 {{ $showtime->format }} — {{ $showtime->language }}</p>

            <p class="text-sm mt-2">🏢 {{ $showtime->cinema->name }}</p>
            <p class="text-sm mt-1">🪑 Sala {{ $showtime->room }}</p>
            <p class="text-sm mt-1">📅 {{ \Carbon\Carbon::parse($showtime->date)->format('d M Y') }}</p>
            <p class="text-sm">🕒 {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>

        </aside>

        <!-- ▬▬▬ MAPA DE ASIENTOS ▬▬▬ -->
        <div class="md:col-span-3">
            <!-- todo el formulario se mantiene igual -->




        <!-- ▬▬▬ SECCIÓN DE ENTRADAS ▬▬▬ -->
        <main class="md:col-span-2">

            <h2 class="text-3xl font-bold mb-3">Selecciona tus entradas</h2>
            <p class="text-gray-400 mb-8">
                Debes elegir exactamente 
                <span class="text-yellow-400 font-semibold">{{ $totalButacas }}</span> entradas.
            </p>

            <!-- x-data ahora recibe EL VALOR CORRECTO -->
            <div x-data="entradasApp({{ $totalButacas }}, {{ Auth::check() ? 'true' : 'false' }})" class="space-y-10">

                <!-- ▬▬▬ ENTRADAS GENERALES ▬▬▬ -->
                <div class="bg-[#121826] p-6 rounded-2xl border border-[#1f2937] shadow-xl">
                    <h3 class="text-2xl font-semibold mb-4">Entradas Generales</h3>

                    <template x-for="entrada in generales" :key="entrada.nombre">
                        <div class="flex justify-between items-center py-4 border-b border-gray-700">

                            <div>
                                <p class="font-semibold text-white" x-text="entrada.nombre"></p>
                                <p class="text-gray-400 text-sm" x-text="entrada.descripcion"></p>
                            </div>

                            <div class="flex items-center gap-3">
                                <p class="font-bold text-yellow-400 text-xl" x-text="'S/ ' + entrada.precio"></p>

                                <input type="number" min="0" :max="max"
                                    x-model.number="entrada.cantidad"
                                    @input="validar()"
                                    class="w-16 text-center rounded-lg bg-[#f9f9f9] text-black font-bold text-lg
                                           border-2 border-gray-400 focus:border-yellow-400 outline-none transition">
                            </div>
                        </div>
                    </template>

                </div>



                <!-- ▬▬▬ BENEFICIOS PARA USUARIOS LOGUEADOS ▬▬▬ -->
                @if(Auth::check())
                <div class="bg-[#121820] p-6 rounded-2xl border border-blue-900 shadow-xl">
                    <h3 class="text-2xl font-semibold text-blue-400 mb-4">Beneficios Exclusivos (Socio)</h3>

                    <template x-for="beneficio in beneficios" :key="beneficio.nombre">
                        <div class="flex justify-between items-center py-4 border-b border-gray-700">

                            <div>
                                <p class="font-semibold text-blue-300" x-text="beneficio.nombre"></p>
                                <p class="text-gray-400 text-sm" x-text="beneficio.descripcion"></p>
                            </div>

                            <div class="flex items-center gap-3">
                                <p class="font-bold text-blue-400 text-xl" x-text="'S/ ' + beneficio.precio"></p>

                                <input type="number" min="0" :max="max"
                                    x-model.number="beneficio.cantidad"
                                    @input="validar()"
                                    class="w-16 text-center rounded-lg bg-[#f9f9f9] text-black font-bold text-lg
                                           border-2 border-blue-400 focus:border-blue-300 outline-none transition">
                            </div>
                        </div>
                    </template>
                </div>
                @endif



                <!-- ▬▬▬ TOTAL ▬▬▬ -->
                <div class="flex justify-between items-center bg-[#111] rounded-xl p-5 border border-[#222] shadow-lg">
                    <p class="text-lg font-semibold">Total:</p>
                    <p class="text-3xl font-bold text-yellow-400">S/ <span x-text="total()"></span></p>
                </div>



                <!-- ▬▬▬ BOTÓN ▬▬▬ -->
                <button 
    type="button"
    @click="continuar()"
    class="mt-6 bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded-lg font-bold text-lg shadow">
    Continuar
</button>



            </div>

        </main>
    </div>
</div>



<!-- ▬▬▬ SCRIPT ▬▬▬ -->
<script>
function entradasApp(maxEntradas, usuarioLogueado) {
    return {

        max: maxEntradas,

        generales: [
            { nombre: "General 2D", descripcion: "Incluye servicio online.", precio: 15, cantidad: 0 },
            { nombre: "Niños 2D", descripcion: "De 2 a 11 años.", precio: 12, cantidad: 0 },
            { nombre: "Adulto Mayor 2D", descripcion: "Mayores de 60 años.", precio: 10, cantidad: 0 },
        ],

        beneficios: usuarioLogueado ? [
            { nombre: "Socio 2D", descripcion: "Beneficio exclusivo.", precio: 11, cantidad: 0 },
            { nombre: "Socio Niños", descripcion: "Menores socios.", precio: 9, cantidad: 0 },
            { nombre: "Socio Adulto Mayor", descripcion: "Precio especial socio.", precio: 8, cantidad: 0 },
        ] : [],

        seleccionadas() {
            return [...this.generales, ...this.beneficios]
                .reduce((s, e) => s + e.cantidad, 0);
        },

        total() {
            return [...this.generales, ...this.beneficios]
                .reduce((s, e) => s + (e.precio * e.cantidad), 0);
        },

        validar() {
            if (this.seleccionadas() > this.max) {

                let excedente = this.seleccionadas() - this.max;

                [...this.beneficios, ...this.generales]
                    .reverse()
                    .forEach(e => {
                        if (excedente > 0 && e.cantidad > 0) {
                            let quitar = Math.min(e.cantidad, excedente);
                            e.cantidad -= quitar;
                            excedente -= quitar;
                        }
                    });
            }
        },

        continuar() {

            let entradas = [...this.generales, ...this.beneficios]
                .filter(e => e.cantidad > 0);

            let payload = {
                cine_id: {{ $showtime->cinema->id }},
                showtime_id: {{ $showtime->id }},
                seats: @json($seats),
                entradas: entradas
            };

            fetch("/guardar-entradas", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "X-Requested-With": "XMLHttpRequest"   // 🔥 FIX: evita que Laravel redirija
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(() => {
                window.location.href = "{{ route('dulceria', $showtime->cinema->id) }}";
            });
        }
    }
}
</script>


@endsection








