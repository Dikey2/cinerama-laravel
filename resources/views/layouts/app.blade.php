<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cinerama 🎞️</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-black text-white font-sans">

    <!-- 🟨 HEADER / NAVBAR -->
    <header class="bg-black text-white shadow-lg border-b border-yellow-500">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

            <!-- 🎥 LOGO -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-cinerama.png') }}" 
                     alt="Cinerama Logo" 
                     class="h-20">
                <span class="font-extrabold text-yellow-400 text-2xl tracking-wide"></span>
            </div>

            <!-- 🧭 MENÚ PRINCIPAL -->
<nav class="hidden md:flex space-x-8 text-sm font-medium">
    <a href="{{ route('proximos') }}"
       class="{{ request()->routeIs('proximos') ? 'text-yellow-400' : 'hover:text-yellow-400 transition' }}">
       Próximos Estrenos
    </a>

    <a href="{{ route('peliculas') }}" 
       class="{{ request()->routeIs('peliculas') ? 'text-yellow-400' : 'hover:text-yellow-400 transition' }}">
       Películas
    </a>
    
    <a href="{{ route('cines') }}" 
       class="{{ request()->routeIs('cines') ? 'text-yellow-400' : 'hover:text-yellow-400 transition' }}">
       Cines
    </a>
    
    <a href="{{ route('promociones') }}" 
       class="{{ request()->routeIs('promociones') ? 'text-yellow-400' : 'hover:text-yellow-400 transition' }}">
       Promociones
    </a>

    <a href="{{ route('dulceria') }}" 
       class="{{ request()->routeIs('dulceria') ? 'text-yellow-400' : 'hover:text-yellow-400 transition' }}">
       Dulcería
    </a>

    <a href="{{ route('corporativo') }}" 
       class="{{ request()->routeIs('corporativo') ? 'text-yellow-400' : 'hover:text-yellow-400 transition' }}">
       Corporativo
    </a>
</nav>


            <!-- 🔍 BUSCADOR + LOGIN -->
            <div class="flex items-center space-x-5">
                <!-- BÚSQUEDA -->
                <form action="#" class="hidden sm:flex items-center bg-gray-800 rounded-full px-3 py-1">
                    <input type="text" placeholder="Buscar..." 
                           class="bg-transparent outline-none text-sm text-white placeholder-gray-400 w-28 md:w-40">
                    <button type="submit" class="text-yellow-400 ml-1">🔍</button>
                </form>

                <!-- AUTENTICACIÓN -->
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.movies.index') }}" 
                           class="text-yellow-400 hover:underline">Admin</a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="text-yellow-400 hover:text-yellow-300">Perfil</a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-400 transition">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-yellow-400 hover:text-yellow-300">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- 🎬 CONTENIDO PRINCIPAL -->
    <main>
        @yield('content')
    </main>

    <!-- ⚫ FOOTER -->
    <footer class="bg-black border-t border-yellow-600 text-gray-400 text-center py-6 mt-10 text-sm">
        © {{ date('Y') }} Cinerama — Todos los derechos reservados 🍿
    </footer>

</body>
</html>




