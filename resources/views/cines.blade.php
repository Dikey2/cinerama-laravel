@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen px-6 py-10">
    <div class="max-w-7xl mx-auto">
        <!-- TÍTULO -->
        <h1 class="text-4xl font-extrabold mb-8 text-yellow-400">Cines</h1>

        <!-- FILTROS -->
        <form method="GET" action="{{ route('cines') }}" class="flex flex-wrap gap-6 items-center mb-10 text-gray-300">
            <div>
                <label class="font-semibold mr-2">Por Ciudad:</label>
                <select name="ciudad" onchange="this.form.submit()" 
                    class="bg-gray-900 border border-gray-700 rounded px-4 py-2 hover:border-yellow-400 transition">
                    <option value="Todas" {{ $ciudadSeleccionada == 'Todas' ? 'selected' : '' }}>Todas</option>
                    <option value="Arequipa" {{ $ciudadSeleccionada == 'Arequipa' ? 'selected' : '' }}>Arequipa</option>
                    <option value="Lima" {{ $ciudadSeleccionada == 'Lima' ? 'selected' : '' }}>Lima</option>
                </select>
            </div>

            <div>
                <label class="font-semibold mr-2">Por Formato:</label>
                <select name="formato" onchange="this.form.submit()" 
                    class="bg-gray-900 border border-gray-700 rounded px-4 py-2 hover:border-yellow-400 transition">
                    <option value="Todos" {{ $formatoSeleccionado == 'Todos' ? 'selected' : '' }}>Todos</option>
                    <option value="2D" {{ $formatoSeleccionado == '2D' ? 'selected' : '' }}>2D</option>
                    <option value="3D" {{ $formatoSeleccionado == '3D' ? 'selected' : '' }}>3D</option>
                    <option value="REGULAR" {{ $formatoSeleccionado == 'REGULAR' ? 'selected' : '' }}>REGULAR</option>
                </select>
            </div>

            <!-- BOTONES LISTA / MAPA -->
            <div class="ml-auto flex space-x-2 text-sm">
                <button id="btnLista" type="button" class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold shadow-md hover:bg-yellow-400 transition">
                    Lista
                </button>
                <button id="btnMapa" type="button" class="bg-gray-800 border border-gray-700 px-5 py-2 rounded-full text-gray-400 hover:text-yellow-400 transition">
                    Mapa
                </button>
            </div>
        </form>

        <!-- SECCIÓN LISTA -->
        <div id="listaCines" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($cines as $cine)
                <a href="{{ route('cines.show', ['nombre' => str_replace(' ', '-', $cine['nombre'])]) }}" 
                   class="block bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-lg hover:scale-105 transform transition duration-300">
                    <img src="{{ $cine['imagen'] }}" alt="{{ $cine['nombre'] }}" 
                         class="w-full h-52 object-cover hover:opacity-90 transition duration-300">
                    <div class="p-5">
                        <h2 class="text-xl font-bold text-yellow-400">{{ $cine['nombre'] }}</h2>
                        <p class="text-gray-400 mt-1">{{ $cine['direccion'] }}</p>
                        <p class="text-gray-500 mt-2 text-sm">{{ implode(', ', $cine['formatos']) }}</p>
                        <p class="text-gray-500 text-xs mt-1">📍 {{ $cine['ciudad'] }}</p>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-400 col-span-3">No se encontraron cines con esos filtros.</p>
            @endforelse
        </div>

        <!-- SECCIÓN MAPA -->
        <div id="mapa" class="hidden mt-10">
            <div id="map" style="height: 500px; border-radius: 12px;"></div>
        </div>

        <!-- INFO -->
        <div class="mt-10 text-gray-400">
            <h3 class="font-bold text-yellow-400 mb-2">Información importante</h3>
            <p>Recuerda que el horario mostrado corresponde al inicio de la publicidad. 
               El cine abre 20 minutos antes de la primera función programada.</p>
        </div>
    </div>
</div>

<!-- GOOGLE MAPS SCRIPT -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoxFc9XGawLkP0Log8Mq8Vxvg5oz5IbZQ&callback=inicializarMapa">
</script>

<script>
let map;

// Ejemplo de cines con coordenadas
const cines = [
    {
        nombre: "Mall Aventura",
        lat: -16.429530,
        lng: -71.523860,
        ciudad: "Arequipa"
    },
    {
        nombre: "Arequipa Mall Plaza",
        lat: -16.398850,
        lng: -71.537450,
        ciudad: "Arequipa"
    },
    {
        nombre: "Arequipa Paseo Central",
        lat: -16.403960,
        lng: -71.530700,
        ciudad: "Arequipa"
    },
    {
        nombre: "Mall del Sur",
        lat: -12.165900,
        lng: -76.977700,
        ciudad: "Lima"
    }
];

function inicializarMapa() {
    const centro = { lat: -13.516, lng: -71.978 }; // Punto medio Perú

    map = new google.maps.Map(document.getElementById('map'), {
        center: centro,
        zoom: 6,
        styles: [
            { elementType: 'geometry', stylers: [{ color: '#1d1d1d' }] },
            { elementType: 'labels.text.stroke', stylers: [{ color: '#1d1d1d' }] },
            { elementType: 'labels.text.fill', stylers: [{ color: '#f1f1f1' }] },
            { featureType: 'water', stylers: [{ color: '#000000' }] },
            { featureType: 'road', stylers: [{ color: '#292929' }] }
        ]
    });

    // Marcadores de los cines
    cines.forEach(cine => {
        const marker = new google.maps.Marker({
            position: { lat: cine.lat, lng: cine.lng },
            map: map,
            title: cine.nombre,
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/yellow-dot.png"
            }
        });

        // Ventana de información al hacer clic
        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="color:black;">
                    <h3 style="font-weight:bold;">${cine.nombre}</h3>
                    <p>📍 ${cine.ciudad}</p>
                    <a href="https://www.google.com/maps?q=${cine.lat},${cine.lng}" target="_blank">Ver en Google Maps</a>
                </div>
            `
        });

        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });
    });
}

// Alternar entre lista y mapa
document.getElementById('btnLista').addEventListener('click', () => {
    document.getElementById('listaCines').classList.remove('hidden');
    document.getElementById('mapa').classList.add('hidden');
    document.getElementById('btnLista').classList.add('bg-yellow-500', 'text-black');
    document.getElementById('btnMapa').classList.remove('bg-yellow-500', 'text-black');
});

document.getElementById('btnMapa').addEventListener('click', () => {
    document.getElementById('listaCines').classList.add('hidden');
    document.getElementById('mapa').classList.remove('hidden');
    document.getElementById('btnMapa').classList.add('bg-yellow-500', 'text-black');
    document.getElementById('btnLista').classList.remove('bg-yellow-500', 'text-black');
    inicializarMapa();
});
</script>
@endsection



