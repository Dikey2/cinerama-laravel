@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">

    <!-- 🟨 Encabezado -->
    <div class="bg-yellow-500 text-black py-6 text-center shadow-lg">
        <h1 class="text-3xl font-extrabold">🍿 Dulcería Cinerama</h1>
        <p class="text-lg">Arequipa Mall Plaza</p>
        <a href="{{ route('dulceria') }}" class="text-sm underline hover:text-yellow-800">← Cambiar de cine</a>
    </div>

    <!-- 🧭 Categorías -->
    <div id="categorias" class="flex flex-wrap justify-center gap-4 py-6 bg-gray-200 shadow-inner">
        <button data-seccion="promos" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition font-semibold">🎁 Promos Dulceras</button>
        <button data-seccion="socio" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition font-semibold">💳 Combos Socio</button>
        <button data-seccion="unoDos" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition font-semibold">🎬 Combos 1 o 2</button>
        <button data-seccion="canchitas" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition font-semibold">🍿 Canchitas</button>
        <button data-seccion="dulces" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition font-semibold">🍫 Dulces</button>
        <button data-seccion="complementos" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition font-semibold">🥤 Complementos</button>
    </div>

    <!-- 📦 Contenido dinámico -->
    <div id="contenido" class="max-w-6xl mx-auto p-6 text-center">
        <h2 class="text-xl text-gray-500">Selecciona una categoría para ver los productos disponibles 🍫.</h2>
    </div>

</div>

<script>

    // 🧩 Generador de tarjetas
    function comboCard(nombre, descripcion, precio, imagen) {
        return `
            <div class='bg-white rounded-xl shadow-lg hover:shadow-yellow-400 transition p-4 text-center'>
                <img src='/images/socio/${imagen}' class='rounded-lg w-full h-48 object-cover mb-3'>
                <h3 class='font-bold text-lg text-gray-800'>${nombre}</h3>
                <p class='text-gray-600 text-sm mb-2'>${descripcion}</p>
                <p class='font-semibold text-yellow-600 mb-4'>S/ ${precio}</p>

                <button 
                    class='btn-add bg-yellow-500 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition'
                    data-name='${nombre}'
                    data-price='${precio}'
                    data-image='/images/socio/${imagen}'
                >Agregar 🛒</button>
            </div>
        `;
    }   

    // 🧠 Secciones dinámicas
    const secciones = {
        promos: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🎁 Promos Dulceras</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Promo 1 - Cinerama Lovers', '1 Canchita Gigante + 2 Bebidas + Chocolatina', '42.00', 'promo1.png')}
                ${comboCard('Promo 2 - Sweet Movie Night', '2 Canchitas Medianas + 2 Bebidas + M&Ms', '46.90', 'promo2.png')}
                ${comboCard('Promo 3 - Pareja Deluxe', '1 Canchita Grande + 2 Bebidas + 1 KitKat', '37.50', 'promo3.png')}
                ${comboCard('Promo 4 - Amigos al Cine', '2 Canchitas + 3 Bebidas + 2 Dulces', '59.90', 'promo4.png')}
                ${comboCard('Promo 5 - Family Pack', '1 Canchita Familiar + 4 Bebidas + 2 Nachos', '72.00', 'promo5.png')}
                ${comboCard('Promo 6 - Mega Snack', '1 Canchita + 1 Nacho + 1 Bebida + Chocolate Mood', '33.90', 'promo6.png')}
                ${comboCard('Promo 7 - Student Time', '1 Canchita + 1 Bebida + 1 Snack', '27.00', 'promo7.png')}
            </div>
        `,
        socio: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>💳 Combos Socio</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Combo Socio Clásico', '1 Canchita Gigante + 1 Bebida (32oz)', '24.90', 'combo1.png')}
                ${comboCard('Combo Dúo Socio', '1 Canchita + 2 Bebidas + M&Ms', '34.50', 'combo2.png')}
                ${comboCard('Combo Sweet & Pop', '1 Canchita + 1 Bebida + Chocolate Mood', '28.90', 'combo3.png')}
                ${comboCard('Combo Familiar', '1 Canchita + 3 Bebidas + Snack Familiar', '49.90', 'combo4.png')}
                ${comboCard('Combo Pareja Deluxe', '1 Canchita + 2 Bebidas + Nachos con Queso', '35.90', 'combo5.png')}
                ${comboCard('Combo Gold', '1 Canchita Dorada + 2 Chocolates Premium', '59.90', 'combo6.png')}
            </div>
        `,
        unoDos: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🎬 Combos 1 o 2</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Combo 1 Clásico', '1 Canchita + 1 Bebida', '25.00', 'combo1.png')}
                ${comboCard('Combo 1 + KitKat', '1 Canchita + 1 Bebida + KitKat', '30.50', 'combo2.png')}
                ${comboCard('Combo 2 Familiar', '1 Canchita + 2 Bebidas', '39.90', 'combo3.png')}
                ${comboCard('Combo 2 + M&Ms', '1 Canchita + 2 Bebidas + M&Ms', '42.00', 'combo4.png')}
                ${comboCard('Combo Duo', '1 Canchita + 2 Bebidas Grandes', '44.00', 'combo5.png')}
                ${comboCard('Combo Pareja', '1 Canchita + 2 Bebidas + Nachos', '45.00', 'combo6.png')}
            </div>
        `
    };

     // 🔄 Mostrar secciones
    document.querySelectorAll('.categoria-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const sec = btn.dataset.seccion;
            mostrarSeccion(sec);

            document.querySelectorAll('.categoria-btn').forEach(b => b.classList.remove('bg-yellow-400'));
            btn.classList.add('bg-yellow-400');
        });
    });

    function mostrarSeccion(nombre) {
        document.getElementById('contenido').innerHTML = secciones[nombre];
        attachAddHandlers();
    }

     // ===============================
    // 🟧 CARRITO LATERAL REAL FUNCIONAL
    // ===============================

    function attachAddHandlers(){
        document.querySelectorAll('.btn-add').forEach(btn=>{

            btn.addEventListener('click', async ()=>{

                const body = {
                    name:  btn.dataset.name,
                    price: btn.dataset.price,
                    image: btn.dataset.image,
                    qty: 1
                };

                const res = await fetch(`{{ route('carrito.add') }}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(body)
                });

                const data = await res.json();
                if(data.success){
                    window.location.href = data.redirect;
                }
            });
        });
    }

    // Al cargar página → mostrar promos
    mostrarSeccion('promos');
    // =====================================
// 🎟 AGREGAR ENTRADAS AUTOMÁTICAMENTE
// =====================================

document.addEventListener('DOMContentLoaded', () => {

    const params = new URLSearchParams(window.location.search);
    const entradasData = params.get('entradas');

    if (!entradasData) return;

    try {
        const entradas = JSON.parse(decodeURIComponent(entradasData));

        entradas.forEach(e => {

            fetch("{{ route('carrito.add') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    name: `Entrada ${e.nombre}`,
                    price: e.precio,
                    qty: e.cantidad,
                    image: "/images/ticket.png"
                })
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    console.log("Entrada agregada:", e.nombre);
                }
            });

        });

    } catch (err) {
        console.error("Error al cargar entradas:", err);
    }

});


</script>
@endsection