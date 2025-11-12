@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen">

    <!-- 🏙️ Banner -->
    <div class="relative w-full">
        <img src="{{ asset('images/promociones/portada.png') }}" class="w-full h-96 object-cover opacity-70">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <h1 class="text-4xl font-extrabold text-yellow-400 mb-3">🍿 Dulcería Cinerama</h1>
            <p class="text-gray-300 text-lg">Escoge tu cine favorito y disfruta de nuestros productos</p>
        </div>
    </div>

    <!-- 🎦 Selector de cine -->
    <div id="selectorCine" class="max-w-4xl mx-auto text-center py-10">
        <h2 class="text-2xl font-bold text-yellow-400 mb-6">
            Escoge un Cinerama para comprar productos de nuestra dulcería
        </h2>

        <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-8">
            <select id="citySelect" class="bg-gray-800 text-white px-5 py-3 rounded-lg w-64 focus:ring-2 focus:ring-yellow-400">
                <option value="">Selecciona una ciudad</option>
                <option value="arequipa">Arequipa</option>
                <option value="lima">Lima</option>
            </select>

            <select id="cinemaSelect" class="bg-gray-800 text-white px-5 py-3 rounded-lg w-64 focus:ring-2 focus:ring-yellow-400" disabled>
                <option value="">Selecciona un cine</option>
            </select>
        </div>

        <button id="continueBtn" class="bg-yellow-500 text-black px-8 py-3 rounded-full font-semibold hover:bg-yellow-400 transition" disabled>
            Continuar →
        </button>
    </div>

    <!-- 🍫 Sección de productos -->
    <div id="dulceriaProductos" class="hidden bg-gray-100 text-black min-h-screen">

        <div class="text-center my-6">
            <button id="volverBtn"
                class="px-8 py-3 text-yellow-400 border-2 border-yellow-400 rounded-full 
                       font-semibold hover:bg-yellow-400 hover:text-black transition duration-300 
                       shadow-[0_0_10px_rgba(255,215,0,0.6)] hover:shadow-[0_0_20px_rgba(255,215,0,0.9)]">
                ← Cambiar de cine
            </button>
        </div>

        <!-- Categorías -->
        <div class="flex flex-wrap justify-center gap-4 py-6 bg-gray-200 shadow-inner">
            <button onclick="mostrarSeccion('promos')" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition">🎁 Promos Dulceras</button>
            <button onclick="mostrarSeccion('socio')" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition">💳 Combos Socio</button>
            <button onclick="mostrarSeccion('unoDos')" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition">🎬 Combos 1 o 2</button>
            <button onclick="mostrarSeccion('canchitas')" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition">🍿 Canchitas</button>
            <button onclick="mostrarSeccion('dulces')" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition">🍫 Dulces</button>
            <button onclick="mostrarSeccion('complementos')" class="categoria-btn bg-white text-black px-5 py-2 rounded-lg shadow hover:bg-yellow-400 transition">🥤 Complementos</button>
        </div>

        <div id="contenido" class="max-w-6xl mx-auto p-6 text-center">
            <p class="text-gray-600">Selecciona una categoría para ver los productos disponibles.</p>
        </div>
    </div>
</div>

<!-- 🧺 CARRITO LATERAL MEJORADO -->
<div id="sideCart"
    class="fixed top-0 left-0 h-full w-96 bg-gray-900 text-white shadow-2xl transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
    
    <!-- Header -->
    <div class="flex justify-between items-center p-4 border-b border-gray-700">
        <h2 class="text-xl font-bold text-yellow-400">🛒 Tu Carrito</h2>
        <button id="closeCart" class="text-gray-400 hover:text-white text-2xl">&times;</button>
    </div>

    <!-- Contenido -->
    <div id="cartContent" class="p-4 space-y-3">
        <p class="text-gray-400">Tu carrito está vacío 😅</p>
    </div>

    <!-- Footer -->
    <div class="p-4 border-t border-gray-700 bg-gray-800">
        <div class="flex justify-between text-lg mb-3">
            <span>Total:</span>
            <span id="cartTotal" class="font-bold text-yellow-400">S/ 0.00</span>
        </div>
        <button id="checkoutBtn"
            class="w-full py-3 rounded-full bg-yellow-500 text-black font-semibold hover:bg-yellow-400 transition disabled:opacity-50"
            disabled>
            Confirmar pedido 🧾
        </button>
    </div>
</div>

<!-- 🔘 BOTÓN FLOTANTE -->
<button id="toggleCart"
    class="fixed bottom-6 left-6 bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-5 py-3 rounded-full shadow-lg z-50">
    🛒 Ver carrito
</button>

<script>
    // ===============================
    // 🎦 Selección de cine
    // ===============================
    const citySelect = document.getElementById('citySelect');
    const cinemaSelect = document.getElementById('cinemaSelect');
    const continueBtn = document.getElementById('continueBtn');
    const selectorCine = document.getElementById('selectorCine');
    const dulceriaProductos = document.getElementById('dulceriaProductos');
    const volverBtn = document.getElementById('volverBtn');

    const cinemas = {
        arequipa: ['Mall Aventura', 'Arequipa Mall Plaza', 'Arequipa Paseo Central'],
        lima: ['Mall del Sur'],
    };

    citySelect.addEventListener('change', () => {
        const city = citySelect.value;
        cinemaSelect.innerHTML = '<option value="">Selecciona un cine</option>';
        if (city && cinemas[city]) {
            cinemas[city].forEach(cinema => {
                const option = document.createElement('option');
                option.value = cinema;
                option.textContent = cinema;
                cinemaSelect.appendChild(option);
            });
            cinemaSelect.disabled = false;
        } else {
            cinemaSelect.disabled = true;
        }
        continueBtn.disabled = true;
    });

    cinemaSelect.addEventListener('change', () => {
        continueBtn.disabled = !cinemaSelect.value;
    });

    continueBtn.addEventListener('click', () => {
        if (cinemaSelect.value) {
            selectorCine.classList.add('hidden');
            dulceriaProductos.classList.remove('hidden');
        }
    });

    volverBtn.addEventListener('click', () => {
        selectorCine.classList.remove('hidden');
        dulceriaProductos.classList.add('hidden');
    });

    // ===============================
    // 🍿 PRODUCTOS DINÁMICOS
    // ===============================
    function comboCard(nombre, descripcion, precio, imagen) {
        return `
            <div class='bg-white rounded-xl shadow-lg hover:shadow-yellow-400 transition p-4 text-center'>
                <img src='/images/socio/${imagen}' class='rounded-lg w-full h-48 object-cover mb-3'>
                <h3 class='font-bold text-lg text-gray-800'>${nombre}</h3>
                <p class='text-gray-600 text-sm mb-2'>${descripcion}</p>
                <p class='font-semibold text-yellow-600 mb-4'>${precio}</p>
                <button onclick="addToCart('${nombre}', ${parseFloat(precio.replace('S/', '').trim())})"
                        class='bg-yellow-500 text-black px-6 py-2 rounded-full font-semibold hover:bg-yellow-400 transition'>
                    Agregar 🛒
                </button>
            </div>
        `;
    }

        const secciones = {
        promos: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🎁 Promos Dulceras</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Promo 1 - Cinerama Lovers', '1 Canchita Gigante + 2 Bebidas + Chocolatina', 'S/ 42.00', 'promo1.png')}
                ${comboCard('Promo 2 - Sweet Movie Night', '2 Canchitas Medianas + 2 Bebidas + M&Ms', 'S/ 46.90', 'promo2.png')}
                ${comboCard('Promo 3 - Pareja Deluxe', '1 Canchita Grande + 2 Bebidas + 1 KitKat', 'S/ 37.50', 'promo3.png')}
                ${comboCard('Promo 4 - Family Pack', '2 Canchitas + 3 Bebidas + 2 Chocolates', 'S/ 59.90', 'promo4.png')}
                ${comboCard('Promo 5 - Mega Movie Night', '1 Canchita Gigante + 3 Bebidas + 2 Snacks', 'S/ 64.90', 'promo5.png')}
                ${comboCard('Promo 6 - Friends Combo', '3 Canchitas Medianas + 3 Bebidas + 3 Chocolatinas', 'S/ 79.00', 'promo6.jpeg')}
            </div>
        `,
        socio: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>💳 Combos Socio</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Combo Socio Clásico', '1 Canchita Gigante + 1 Bebida (32oz)', 'S/ 24.90', 'combo1.png')}
                ${comboCard('Combo Dúo Socio', '1 Canchita + 2 Bebidas + M&Ms', 'S/ 34.50', 'combo2.png')}
                ${comboCard('Combo Sweet & Pop', '1 Canchita + 1 Bebida + Chocolate ', 'S/ 28.90', 'combo3.png')}
                ${comboCard('Combo CineFan', '2 Canchitas + 2 Bebidas', 'S/ 31.90', 'combo4.png')}
                ${comboCard('Combo MoviePlus', '1 Canchita Gigante + 1 Bebida + Hotdog', 'S/ 33.90', 'combo5.png')}
                ${comboCard('Combo Deluxe Socio', '2 Canchitas + 2 Bebidas + Nachos', 'S/ 39.90', 'combo6.png')}
            </div>
        `,
        unoDos: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🎬 Combos 1 o 2</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Combo 1 Clásico', '1 Canchita Mediana + 1 Bebida', 'S/ 19.90', 'combo12_1.png')}
                ${comboCard('Combo 1 Dulce', '1 Canchita Dulce + 1 Bebida', 'S/ 20.90', 'combo12_2.png')}
                ${comboCard('Combo 2 Pareja', '1 Canchita Grande + 2 Bebidas', 'S/ 27.50', 'combo12_3.png')}
                ${comboCard('Combo 2 Premium', '1 Canchita + 2 Bebidas + M&Ms', 'S/ 31.90', 'combo12_4.png')}
                ${comboCard('Combo CineDate', '1 Canchita + 2 Bebidas + 1 KitKat', 'S/ 33.90', 'combo12_5.png')}
                ${comboCard('Combo Sweet Duo', '1 Canchita + 2 Bebidas + Chocolate Mood', 'S/ 34.90', 'combo12_6.png')}
            </div>
        `,
        canchitas: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🍿 Canchitas</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Canchita Clásica', 'Tamaño mediano, salada y crocante', 'S/ 9.90', 'canchita1.png')}
                ${comboCard('Canchita Gigante', 'Tamaño grande para compartir', 'S/ 12.90', 'canchita2.png')}
                ${comboCard('Canchita Dulce', 'Con caramelo, sabor especial', 'S/ 13.90', 'canchita3.png')}
                ${comboCard('Canchita Mix', 'Mitad dulce y mitad salada', 'S/ 14.90', 'canchita4.png')}
                ${comboCard('Canchita Cheese', 'Con queso cheddar derretido', 'S/ 15.90', 'canchita5.png')}
                ${comboCard('Canchita Butter', 'Con mantequilla natural', 'S/ 11.90', 'canchita6.png')}
            </div>
        `,
        dulces: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🍫 Dulces</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Chocolate Mood', 'Chocolate relleno cremoso', 'S/ 7.90', 'dulce1.png')}
                ${comboCard('M&Ms Clásicos', 'Bolsa individual de 80g', 'S/ 8.50', 'dulce2.png')}
                ${comboCard('Snickers', 'Barra energética de 50g', 'S/ 6.50', 'dulce3.png')}
                ${comboCard('KitKat', 'Barra de 4 dedos crujientes', 'S/ 7.00', 'dulce4.png')}
                ${comboCard('Twix', 'Caramelo y galleta recubiertos de chocolate', 'S/ 6.90', 'dulce5.png')}
                ${comboCard('Menta Crunch', 'Chocolate con sabor a menta', 'S/ 8.20', 'dulce6.png')}
            </div>
        `,
        complementos: `
            <h2 class='text-2xl font-bold text-yellow-500 mb-6'>🥤 Complementos</h2>
            <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
                ${comboCard('Bebida Grande', '32oz de gaseosa a elección', 'S/ 7.50', 'comp1.png')}
                ${comboCard('Hotdog Clásico', 'Pan suave con salchicha y aderezos', 'S/ 9.90', 'comp2.png')}
                ${comboCard('Nachos con Queso', 'Nachos calientes con salsa de queso', 'S/ 10.90', 'comp3.png')}
                ${comboCard('Helado Mini', 'Helado de vainilla o chocolate', 'S/ 8.50', 'comp4.png')}
                ${comboCard('Café Cinerama', 'Taza de café americano o capuchino', 'S/ 6.90', 'comp5.png')}
                ${comboCard('Agua Mineral', 'Botella de 500ml', 'S/ 4.50', 'comp6.png')}
            </div>
        `
    };


    function mostrarSeccion(nombre) {
        const contenido = document.getElementById('contenido');
        contenido.innerHTML = secciones[nombre] || '<p class="text-gray-400">Próximamente...</p>';
    }

    // ===============================
    // 🧺 CARRITO LATERAL MEJORADO
    // ===============================
    const cartPanel = document.getElementById('sideCart');
    const toggleCart = document.getElementById('toggleCart');
    const closeCart = document.getElementById('closeCart');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const cartContent = document.getElementById('cartContent');
    const cartTotal = document.getElementById('cartTotal');

    toggleCart.addEventListener('click', () => cartPanel.classList.toggle('-translate-x-full'));
    closeCart.addEventListener('click', () => cartPanel.classList.add('-translate-x-full'));

    function renderCart() {
        fetch("{{ route('carrito.index') }}", { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const rows = doc.querySelectorAll('tbody tr');
                const totalText = doc.querySelector('.font-bold.text-yellow-600')?.textContent ?? 'S/ 0.00';
                const emptyMsg = doc.querySelector('p.text-gray-600');
                
                cartContent.innerHTML = '';

                if (rows.length > 0) {
                    rows.forEach(row => {
                        const name = row.querySelector('span.font-semibold')?.textContent;
                        const price = row.querySelector('td:nth-child(2)')?.textContent.replace('S/', '').trim();
                        const qty = row.querySelector('input[name="qty"]')?.value;
                        const key = row.querySelector('input[name="key"]')?.value;
                        const subtotal = (price * qty).toFixed(2);

                        cartContent.innerHTML += `
                            <div class="flex items-center justify-between bg-gray-800 rounded-lg p-3 shadow-md">
                                <div class="flex-1">
                                    <p class="font-semibold text-white">${name}</p>
                                    <p class="text-sm text-gray-400">S/ ${price}</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <button onclick="updateQty('${key}', ${qty - 1})" class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600">-</button>
                                        <span class="text-yellow-400 font-bold">${qty}</span>
                                        <button onclick="updateQty('${key}', ${parseInt(qty) + 1})" class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600">+</button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-yellow-400 font-semibold">S/ ${subtotal}</p>
                                    <button onclick="removeItem('${key}')" class="text-red-400 hover:text-red-600 mt-2 block">🗑️</button>
                                </div>
                            </div>
                        `;
                    });

                    cartTotal.textContent = totalText;
                    checkoutBtn.disabled = false;
                } else if (emptyMsg) {
                    cartContent.innerHTML = `<p class="text-gray-400">${emptyMsg.textContent}</p>`;
                    cartTotal.textContent = 'S/ 0.00';
                    checkoutBtn.disabled = true;
                }
            });
    }

    function addToCart(nombre, precio) {
        fetch("{{ route('carrito.add') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ name: nombre, price: precio }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                renderCart();
                cartPanel.classList.remove('-translate-x-full');
            } else alert("⚠️ No se pudo agregar al carrito.");
        })
        .catch(() => alert("❌ Error al conectar con el servidor."));
    }

    function updateQty(key, qty) {
        if (qty < 1) return;
        fetch("{{ route('carrito.update') }}", {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ key, qty }),
        }).then(() => renderCart());
    }

    function removeItem(key) {
        fetch("{{ route('carrito.remove') }}", {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ key }),
        }).then(() => renderCart());
    }

    checkoutBtn.addEventListener('click', () => {
        window.location.href = "{{ route('carrito.index') }}";
    });

    document.addEventListener('DOMContentLoaded', renderCart);
    
        // ===============================
    // 🎟️ AGREGAR ENTRADAS AUTOMÁTICAMENTE AL CARRITO
    // ===============================
    document.addEventListener('DOMContentLoaded', () => {
        // Verificamos si hay entradas en la URL
        const params = new URLSearchParams(window.location.search);
        const entradasData = params.get('entradas');

        if (entradasData) {
            try {
                const entradas = JSON.parse(decodeURIComponent(entradasData));

                entradas.forEach(e => {
                    fetch("{{ route('carrito.add') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            name: e.nombre,
                            price: e.precio,
                            qty: e.cantidad
                        }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) renderCart();
                    })
                    .catch(() => console.warn("⚠️ No se pudo agregar una entrada al carrito."));
                });
            } catch (err) {
                console.error("Error al procesar las entradas:", err);
            }
        }
    });

</script>
@endsection







