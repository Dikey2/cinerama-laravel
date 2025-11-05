@extends('layouts.app')

@section('content')
@php
    $pelicula = request('pelicula');
    $cine = request('cine');
    $ciudad = request('ciudad');
    $hora = request('hora');
    $butacas = explode(',', request('butacas'));
    $totalButacas = count($butacas);
@endphp

<div class="bg-gray-100 min-h-screen py-10 px-4" 
     x-data="entradasApp({{ $totalButacas }})">

    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg flex flex-col md:flex-row overflow-hidden">

        <!-- 🧾 Panel lateral -->
        <aside class="bg-white md:w-1/3 border-r border-gray-300 p-6">
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ asset('images/peliculas/chavin.jpg') }}" alt="Póster" class="w-20 h-28 object-cover rounded">
                <div>
                    <h2 class="font-bold text-gray-800 text-lg">{{ $pelicula }}</h2>
                    <p class="text-gray-600 text-sm">2D, REGULAR, DOBLADA</p>
                    <p class="mt-2 font-semibold text-blue-700">{{ $cine }}</p>
                    <p class="text-sm text-gray-700">📍 {{ $ciudad }}</p>
                    <p class="text-sm text-gray-700">🕒 {{ $hora }}</p>
                    <p class="text-sm text-gray-700">🎞️ Sala 3</p>
                    <p class="text-sm text-gray-700 mt-1">
                        🎫 Butacas: <span class="font-semibold">{{ implode(', ', $butacas) }}</span>
                    </p>
                </div>
            </div>
        </aside>

        <!-- 🎟️ Zona de selección de entradas -->
        <main class="flex-1 bg-gray-50 p-6" x-data>
            <h2 class="text-center text-xl font-semibold text-gray-800 mb-4">Selecciona tus entradas</h2>
            <p class="text-center text-gray-600 text-sm mb-8">
                Puedes elegir hasta <strong x-text="maxEntradas"></strong> entradas.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Entradas generales -->
                <div class="bg-white shadow-md border rounded-lg p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Entradas generales</h3>
                    <template x-for="entrada in entradasGenerales" :key="entrada.nombre">
                        <div class="flex justify-between items-center border-b py-2 text-sm">
                            <div>
                                <p class="font-semibold" x-text="entrada.nombre"></p>
                                <p class="text-xs text-gray-500" x-text="entrada.descripcion"></p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-blue-700" x-text="`S/ ${entrada.precio.toFixed(2)}`"></p>
                                <input type="number" min="0" :max="maxEntradas" 
                                       class="w-12 mt-1 border rounded text-center"
                                       x-model.number="entrada.cantidad"
                                       @input="validarCantidad()">
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Tus beneficios -->
                <div class="bg-white shadow-md border rounded-lg p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Tus beneficios</h3>
                    <template x-for="beneficio in beneficios" :key="beneficio.nombre">
                        <div class="flex justify-between items-center border-b py-2 text-sm">
                            <div>
                                <p class="font-semibold" x-text="beneficio.nombre"></p>
                                <p class="text-xs text-gray-500" x-text="beneficio.descripcion"></p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-blue-700" x-text="`S/ ${beneficio.precio.toFixed(2)}`"></p>
                                <input type="number" min="0" :max="maxEntradas"
                                       class="w-12 mt-1 border rounded text-center"
                                       x-model.number="beneficio.cantidad"
                                       @input="validarCantidad()">
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Cuadro de código promocional -->
            <div class="flex items-center justify-between bg-gray-100 border rounded-lg p-3 mt-8">
                <span class="text-gray-600 text-sm">Canjea tus códigos:</span>
                <div class="flex gap-2">
                    <input type="text" placeholder="Ingresa tu código" class="border rounded px-3 py-1 text-sm w-48">
                    <button class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-500">Canjear</button>
                </div>
            </div>

            <!-- 💰 Total y continuar -->
            <div class="flex flex-col md:flex-row justify-between items-center mt-8">
                <p class="text-gray-800 text-lg font-semibold">
                    Total: S/<span x-text="total().toFixed(2)"></span>
                </p>
                <button 
                    class="bg-blue-600 text-white py-2 px-8 rounded-full hover:bg-blue-500 mt-3 md:mt-0 disabled:opacity-50"
                    :disabled="entradasSeleccionadas() !== maxEntradas"
                    @click="continuarCompra()">
                    Continuar
                </button>
            </div>
        </main>
    </div>
</div>

<script>
function entradasApp(max) {
    return {
        maxEntradas: max,
        entradasGenerales: [
            { nombre: 'General 2D OL', descripcion: 'Incluye servicio online.', precio: 13.00, cantidad: 0 },
            { nombre: 'Mayores 60 años 2D OL', descripcion: 'Precio más bajo', precio: 12.00, cantidad: 0 },
            { nombre: 'Niños 2D OL', descripcion: 'Para niños de 2 a 11 años.', precio: 12.00, cantidad: 0 },
            { nombre: 'Boleto Conadis 2D OL', descripcion: 'Solo para personas con discapacidad', precio: 8.00, cantidad: 0 },
        ],
        beneficios: [
            { nombre: 'Entrada Socio OL', descripcion: 'Canjeable con puntos acumulados.', precio: 6.00, cantidad: 0 },
            { nombre: 'Promo Amex 2025', descripcion: 'Exclusivo con tarjeta Amex', precio: 6.50, cantidad: 0 },
            { nombre: 'Precio de Martes OL', descripcion: 'Compra en precio especial', precio: 9.00, cantidad: 0 },
            { nombre: 'Socio Lunes-Jueves', descripcion: 'Exclusivo socio', precio: 7.00, cantidad: 0 },
        ],

        entradasSeleccionadas() {
            return [...this.entradasGenerales, ...this.beneficios]
                .reduce((sum, item) => sum + (item.cantidad || 0), 0);
        },

        total() {
            return [...this.entradasGenerales, ...this.beneficios]
                .reduce((sum, item) => sum + item.precio * item.cantidad, 0);
        },

        validarCantidad() {
            let total = this.entradasSeleccionadas();
            if (total > this.maxEntradas) {
                alert(`Solo puedes seleccionar ${this.maxEntradas} entradas en total.`);
                const exceso = total - this.maxEntradas;
                for (let lista of [this.entradasGenerales, this.beneficios]) {
                    for (let item of lista) {
                        if (item.cantidad > 0 && total > this.maxEntradas) {
                            item.cantidad -= exceso;
                            total = this.entradasSeleccionadas();
                        }
                    }
                }
            }
        },

        continuarCompra() {
            if (this.entradasSeleccionadas() !== this.maxEntradas) {
                alert('Debes seleccionar exactamente ' + this.maxEntradas + ' entradas.');
                return;
            }

            const seleccionadas = [...this.entradasGenerales, ...this.beneficios]
                .filter(e => e.cantidad > 0)
                .map(e => ({
                    nombre: e.nombre,
                    cantidad: e.cantidad,
                    precio: e.precio,
                    subtotal: e.precio * e.cantidad
                }));

            const data = encodeURIComponent(JSON.stringify(seleccionadas));

            window.location.href = `/dulceria?pelicula={{ urlencode($pelicula) }}&cine={{ urlencode($cine) }}&ciudad={{ urlencode($ciudad) }}&hora={{ urlencode($hora) }}&butacas={{ urlencode(implode(',', $butacas)) }}&entradas=${data}`;
        }
    };
}
</script>
@endsection


