<nav class="bg-black border-b border-yellow-500 text-white">
    <div class="max-w-7xl mx-auto px-6 py-0 flex justify-between items-center">

        {{-- LOGO --}}
        <div class="flex items-center space-x-3">
            <a href="/">
                <img src="{{ asset('images/logo-cinerama.png') }}" class="h-12" alt="Cinerama">
            </a>
        </div>

        {{-- MENÚ --}}
        <div class="hidden md:flex space-x-8 text-sm font-medium">
            <a href="{{ route('proximos-estrenos') }}" class="hover:text-yellow-400">Próximos Estrenos</a>
            <a href="{{ route('peliculas') }}" class="hover:text-yellow-400">Películas</a>
            <a href="{{ route('cines') }}" class="hover:text-yellow-400">Cines</a>
            <a href="{{ route('promociones') }}" class="hover:text-yellow-400">Promociones</a>
            <a href="{{ route('dulceria') }}" class="hover:text-yellow-400">Dulcería</a>
            <a href="{{ route('corporativo') }}" class="hover:text-yellow-400">Corporativo</a>
        </div>

        {{-- PERFIL / LOGIN --}}
        <div class="flex items-center space-x-6">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.movies.index') }}"
                        class="text-yellow-400 hover:text-yellow-300 font-semibold transition">
                        Administración
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}" class="hover:text-yellow-300">
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-gray-400 hover:text-red-400">
                        Salir
                    </button>
                </form>

            @else
                <a href="{{ route('login') }}"
                    class="text-yellow-400 hover:text-yellow-300">
                    Iniciar sesión
                </a>
            @endauth

        </div>

    </div>
</nav>


