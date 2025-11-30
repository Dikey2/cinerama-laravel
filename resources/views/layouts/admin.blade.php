<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Panel Admin | Cinerama</title>

    {{-- Necesario para Tailwind, Alpine y axios --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 font-sans">

<div class="flex min-h-screen">

    {{-- ============================================================
        🟡 SIDEBAR IZQUIERDO (FIJO)
        ============================================================ --}}
    <aside class="w-72 bg-white shadow-xl p-6 hidden md:block fixed left-0 top-0 h-full z-50">

        <h2 class="text-2xl font-bold text-yellow-600 mb-10 flex items-center gap-2">
            🍿 Cinerama Admin
        </h2>

        <nav class="space-y-3 text-lg">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg transition
                      {{ request()->is('admin') ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'hover:bg-gray-200' }}">
                Dashboard
            </a>

            {{-- Películas --}}
            <a href="{{ route('admin.movies.index') }}"
               class="block px-4 py-2 rounded-lg transition
                      {{ request()->is('admin/movies*') ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'hover:bg-gray-200' }}">
                🎬 Películas
            </a>

            {{-- Cines --}}
            <a href="{{ route('admin.cinemas.index') }}"
               class="block px-4 py-2 rounded-lg transition
                      {{ request()->is('admin/cinemas*') ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'hover:bg-gray-200' }}">
                🎦 Cines
            </a>

            {{-- Promociones --}}
            <a href="{{ route('admin.promociones.index') }}"
               class="block px-4 py-2 rounded-lg transition
                      {{ request()->is('admin/promociones*') ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'hover:bg-gray-200' }}">
                🎉 Promociones
            </a>

            {{-- Dulcería --}}
            <a href="{{ route('admin.candies.index') }}"
               class="block px-4 py-2 rounded-lg transition
                      {{ request()->is('admin/candies*') ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'hover:bg-gray-200' }}">
                🍬 Dulcería
            </a>

        </nav>
    </aside>


    {{-- ============================================================
        🔵 CONTENIDO PRINCIPAL
        ============================================================ --}}
    <main class="flex-1 p-10 md:ml-72">

        {{-- CABECERA SUPERIOR --}}
        <header class="mb-10 flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    @yield('header_title')
                </h1>
                <p class="text-gray-500 text-sm mt-1">
                    @yield('header_subtitle')
                </p>
            </div>

            {{-- Usuario + Logout --}}
            @auth
                <div class="flex items-center gap-3">
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 text-sm font-semibold hover:underline">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @endauth

        </header>

        {{-- CONTENIDO INTERNO --}}
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>







