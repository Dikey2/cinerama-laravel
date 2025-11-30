<aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg p-5">
    
    <h2 class="text-xl font-bold mb-6 text-yellow-500">
        🍿 Cinerama
    </h2>

    <nav class="space-y-3">
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
            Dashboard
        </a>

        <a href="{{ route('admin.movies.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
            Películas
        </a>

        <a href="{{ route('admin.cinemas.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
            Cines
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">
            Promociones
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">
            Dulcería
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">
            Configuración
        </a>
    </nav>

</aside>
