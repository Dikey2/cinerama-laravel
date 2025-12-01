<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') - Cinerama</title>

    {{-- CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background: #f9fafb;
        }
        .admin-sidebar {
            width: 260px;
            background: white;
            border-right: 1px solid #e5e7eb;
            padding: 20px 15px;
            flex-shrink: 0;
        }
        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .admin-header {
            height: 60px;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 25px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-content {
            padding: 30px 40px;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="admin-wrapper">

    {{-- ⭐ SIDEBAR --}}
    <aside class="admin-sidebar">
        <div class="text-xl font-bold mb-6">
            <img src="{{ asset('images/logo-cinerama.png') }}" class="h-20 mb-2" alt="">
            <span>Cinerama</span>
            <div class="text-xs text-gray-500 -mt-1">Panel de administración</div>
        </div>

        <nav class="space-y-3 text-sm">

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                🏠 Dashboard
            </a>

            <a href="{{ route('admin.movies.index') }}"
               class="{{ request()->is('admin/movies*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                🎬 Películas
            </a>

            <a href="{{ route('admin.cinemas.create') }}"
            class="{{ request()->is('admin/cinemas/create') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                🎦 Cines
            </a>


            <a href="{{ route('admin.promociones.index') }}"
               class="{{ request()->is('admin/promociones*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                🎉 Promociones
            </a>

            <a href="{{ route('admin.candies.index') }}"
               class="{{ request()->is('admin/candies*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                🍬 Dulcería
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="{{ request()->is('admin/users*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                👤 Usuarios
            </a>

            <a href="{{ route('admin.config') }}"
               class="{{ request()->routeIs('admin.config') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }} flex items-center gap-2">
                ⚙️ Configuración
            </a>

        </nav> {{-- ← ESTA LÍNEA FALTABA --}}
    </aside>

    {{-- ⭐ ÁREA PRINCIPAL --}}
    <div class="admin-main">

        {{-- HEADER --}}
        <header class="admin-header">
            <div class="flex flex-col">
                <span class="text-lg font-semibold">@yield('header_title')</span>
                <small class="text-gray-500">@yield('header_subtitle')</small>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-gray-600">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 font-medium hover:underline">
                        Salir
                    </button>
                </form>
            </div>
        </header>

        {{-- CONTENIDO --}}
        <main class="admin-content">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>



