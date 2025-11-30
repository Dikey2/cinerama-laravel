<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta — Cinerama</title>

    {{-- Breeze + Tailwind + Alpine --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b0e13] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-2xl">

        <h1 class="text-2xl font-bold text-center text-gray-900 mb-2">
            Crear cuenta
        </h1>

        <p class="text-gray-500 text-center mb-6 text-xs leading-relaxed">
            Regístrate para acumular puntos, recibir beneficios<br>y disfrutar la experiencia Cinerama.
        </p>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Nombre completo
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    required
                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 
                           rounded-lg focus:border-yellow-400 focus:ring-yellow-400 text-sm"
                >
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Correo electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 
                           rounded-lg focus:border-yellow-400 focus:ring-yellow-400 text-sm"
                >
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Contraseña
                </label>
                <input 
                    type="password" 
                    name="password"
                    required
                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 
                           rounded-lg focus:border-yellow-400 focus:ring-yellow-400 text-sm"
                >
            </div>

            {{-- Confirm --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Confirmar contraseña
                </label>
                <input 
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full px-3 py-2 bg-gray-100 border border-gray-300 
                           rounded-lg focus:border-yellow-400 focus:ring-yellow-400 text-sm"
                >
            </div>

            {{-- Botón --}}
            <button 
                type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold 
                       py-2 rounded-lg transition text-sm">
                Crear cuenta
            </button>

        </form>

        {{-- Separador --}}
        <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="px-3 text-gray-500 text-xs">o</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>

        {{-- Link login --}}
        <p class="text-center text-gray-600 text-xs">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" 
               class="text-yellow-500 font-semibold hover:underline">
                Iniciar sesión
            </a>
        </p>

    </div>

</body>
</html>



