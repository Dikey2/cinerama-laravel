@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen">

    <!-- ✨ Hero principal -->
    <section class="relative w-full h-[80vh] bg-cover bg-center" 
             style="background-image: url('{{ asset('images/corporativo/fondo_corporativo.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center text-center px-6">
            <h1 class="text-5xl font-extrabold text-yellow-400 mb-4 drop-shadow-lg">🎬 Cinerama Corporativo</h1>
            <p class="text-lg text-gray-300 max-w-3xl">
                Vive la experiencia Cinerama de forma exclusiva para tu empresa, eventos o grupos privados.
                Ofrecemos paquetes personalizados, salas premium y atención dedicada para tus colaboradores o clientes.
            </p>
            <a href="#contacto" 
               class="mt-8 bg-gradient-to-r from-yellow-500 to-yellow-400 text-black font-semibold px-10 py-3 rounded-full shadow-lg hover:scale-105 hover:shadow-yellow-400 transition">
                Solicitar información →
            </a>
        </div>
    </section>

    <!-- 🏢 Beneficios corporativos -->
    <section class="py-20 bg-gradient-to-b from-black to-gray-900 text-center">
        <h2 class="text-3xl font-bold text-yellow-400 mb-10">Beneficios Corporativos</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-yellow-500/30 transition">
                <img src="{{ asset('images/corporativo/eventos.png') }}" class="mx-auto w-24 mb-4">
                <h3 class="font-semibold text-xl text-yellow-400 mb-2">Eventos Privados</h3>
                <p class="text-gray-400 text-sm">
                    Reserva una sala completa para presentaciones, lanzamientos o funciones exclusivas de tu empresa.
                </p>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-yellow-500/30 transition">
                <img src="{{ asset('images/corporativo/beneficios.png') }}" class="mx-auto w-24 mb-4">
                <h3 class="font-semibold text-xl text-yellow-400 mb-2">Descuentos y Convenios</h3>
                <p class="text-gray-400 text-sm">
                    Otorga beneficios exclusivos a tus empleados con convenios especiales y precios preferenciales.
                </p>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-yellow-500/30 transition">
                <img src="{{ asset('images/corporativo/salas.png') }}" class="mx-auto w-24 mb-4">
                <h3 class="font-semibold text-xl text-yellow-400 mb-2">Salas Premium</h3>
                <p class="text-gray-400 text-sm">
                    Disfruta de salas VIP con sonido envolvente y asientos reclinables para una experiencia inigualable.
                </p>
            </div>
        </div>
    </section>

    <!-- 📩 Formulario de contacto -->
    <section id="contacto" class="py-20 bg-black text-center">
        <h2 class="text-3xl font-bold text-yellow-400 mb-8">Contáctanos</h2>
        <p class="text-gray-400 mb-10">Déjanos tus datos y un asesor se pondrá en contacto contigo.</p>

        <form class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 px-6">
            <input type="text" placeholder="Nombre de la empresa" class="p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-yellow-400">
            <input type="email" placeholder="Correo electrónico" class="p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-yellow-400">
            <input type="tel" placeholder="Teléfono de contacto" class="p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-yellow-400">
            <input type="text" placeholder="Ciudad" class="p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-yellow-400">
            <textarea placeholder="Cuéntanos tu necesidad o tipo de evento..." rows="4" class="col-span-2 p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:ring-2 focus:ring-yellow-400"></textarea>
            <button type="submit" class="col-span-2 bg-gradient-to-r from-yellow-500 to-yellow-400 text-black font-bold py-3 rounded-full hover:scale-105 shadow-lg transition">
                Enviar solicitud ✉️
            </button>
        </form>
    </section>

</div>
@endsection

