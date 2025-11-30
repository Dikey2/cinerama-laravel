<header class="bg-white shadow flex justify-between items-center px-6 py-3">

    <h2 class="text-lg font-semibold">@yield('title')</h2>

    <div class="flex items-center gap-4">

        <i class="ri-notification-3-line text-2xl text-gray-500 hover:text-gray-700 cursor-pointer"></i>

        <div class="flex items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" 
                 class="w-9 h-9 rounded-full">
            <span>{{ auth()->user()->name }}</span>
        </div>

    </div>
</header>
