@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-8">
    <h2 class="text-3xl font-bold text-yellow-500 text-center mb-8">🍫 Dulces</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
            $dulces = [
                ['nombre' => 'M&Ms', 'descripcion' => 'Dulces coloridos de chocolate.', 'precio' => 8.00, 'imagen' => 'sweet1.png'],
                ['nombre' => 'KitKat', 'descripcion' => 'Chocolate crujiente con wafer.', 'precio' => 7.50, 'imagen' => 'sweet2.png'],
                ['nombre' => 'Snickers', 'descripcion' => 'Chocolate relleno de maní y caramelo.', 'precio' => 8.50, 'imagen' => 'sweet3.png'],
                ['nombre' => 'Twix', 'descripcion' => 'Barra de galleta con caramelo.', 'precio' => 9.00, 'imagen' => 'sweet4.png'],
                ['nombre' => 'Mood Chocolate', 'descripcion' => 'Chocolate artesanal premium.', 'precio' => 10.00, 'imagen' => 'sweet5.png'],
                ['nombre' => 'Gomitas Cinerama', 'descripcion' => 'Perfectas para disfrutar con tus amigos.', 'precio' => 6.50, 'imagen' => 'sweet6.png']
            ];
        @endphp

        @foreach($dulces as $item)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-yellow-400 transition p-4 text-center">
            <img src="{{ asset('images/socio/'.$item['imagen']) }}" 
                 class="rounded-lg w-full h-48 object-cover mb-3" 
                 alt="{{ $item['nombre'] }}">
            
            <h3 class="font-bold text-lg text-gray-800">{{ $item['nombre'] }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ $item['descripcion'] }}</p>
            <p class="font-semibold text-yellow-600 mb-4">S/ {{ number_format($item['precio'], 2) }}</p>
            
            <button onclick="agregarAlCarrito('{{ $item['nombre'] }}', {{ $item['precio'] }}, '{{ asset('images/socio/'.$item['imagen']) }}')" 
                    class="bg-yellow-500 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition">
                Agregar 🛒
            </button>
        </div>
        @endforeach
    </div>
</div>

<script>
async function agregarAlCarrito(nombre, precio, imagen) {
    try {
        const response = await fetch("{{ url('carrito/agregar') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                name: nombre,
                price: precio,
                image: imagen,
                qty: 1
            })
        });

        const data = await response.json();

        if (data.ok) {
            alert("✅ Producto agregado al carrito correctamente");
        } else {
            alert("⚠️ Ocurrió un problema al agregar el producto");
        }
    } catch (error) {
        console.error("Error al agregar al carrito:", error);
        alert("❌ No se pudo agregar al carrito. Inténtalo de nuevo.");
    }
}
</script>
@endsection

