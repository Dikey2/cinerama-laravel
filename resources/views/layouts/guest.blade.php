<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-[#080a0f] text-gray-100">

    <!-- CONTENEDOR CENTRADO -->
    <div class="min-h-screen flex items-center justify-center px-4">

        <!-- 💛 CAJA ULTRA COMPACTA -->
        <div class="w-full max-w-xs bg-[#0d1117] border border-gray-800 
                    rounded-2xl shadow-xl p-5">

            {{ $slot }}

        </div>

    </div>

</body>
</html>
    



