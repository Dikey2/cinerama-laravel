<aside class="w-64 bg-white shadow-xl border-r flex flex-col">

    <div class="p-6 border-b">
        <h1 class="text-xl font-bold">🎬 Cinerama Admin</h1>
        <p class="text-xs text-gray-500">Control total del sitio</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-dashboard-line text-lg"></i> Dashboard
        </a>

        {{-- Películas --}}
        <a href="{{ route('admin.movies.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin/movies*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-movie-2-line text-lg"></i> Películas
        </a>

        {{-- Cines --}}
        <a href="{{ route('admin.cinemas.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin/cinemas*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-building-2-line text-lg"></i> Cines
        </a>

        {{-- Promociones --}}
        <a href="{{ route('admin.promotions.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin/promotions*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-gift-line text-lg"></i> Promociones
        </a>

        {{-- Dulcería --}}
        <a href="{{ route('admin.candies.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin/candies*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-cup-line text-lg"></i> Dulcería
        </a>

        {{-- Configuración --}}
        <a href="{{ route('admin.settings') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin/settings*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-settings-3-line text-lg"></i> Configuración del sitio
        </a>

        {{-- Usuarios (PASO 4 aplicado aquí) --}}
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100
           {{ request()->is('admin/users*') ? 'text-yellow-600 font-semibold' : 'text-gray-700' }}">
            <i class="ri-user-line text-lg"></i> Usuarios
        </a>

        {{-- Cerrar sesión --}}
        <a href="/logout"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-red-100 text-red-600">
            <i class="ri-logout-box-line text-lg"></i> Cerrar sesión
        </a>

    </nav>

</aside>
