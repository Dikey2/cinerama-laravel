<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — Cinerama</title>

    {{-- Cargar Breeze: Tailwind + Alpine + axios --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b0e13] min-h-screen flex items-center justify-center">

    <!-- TARJETA COMPACTA -->
    <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-2xl">

        <h1 class="text-2xl font-bold text-center text-gray-900 mb-2">
            Iniciar sesión
        </h1>

        <p class="text-gray-500 text-center mb-6 text-xs leading-relaxed">
            Ingresa para disfrutar de tus beneficios, acumular puntos<br>y completar tu compra.
        </p>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Correo electrónico
                </label>
                <input type="email" name="email" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-400 focus:ring-yellow-400 text-sm" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Contraseña
                </label>
                <input type="password" name="password" class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:border-yellow-400 focus:ring-yellow-400 text-sm" required>
            </div>

            <div class="text-right -mt-2">
                <a href="{{ route('password.request') }}" class="text-yellow-500 text-xs hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 rounded-lg transition text-sm">
                Ingresar
            </button>
        </form>

        <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="px-3 text-gray-500 text-xs">o</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>

        <<a href="{{ session('reserva.showtime')
        ? route('asientos.entradas', session('reserva.showtime'))
        : route('peliculas') }}"

            class="block w-full text-center bg-white hover:bg-gray-50 text-gray-700 font-semibold py-2 rounded-lg border border-gray-300 transition text-sm">
            Seguir como invitado
        </a>

        <p class="text-center text-gray-600 text-xs mt-5">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-yellow-500 font-semibold hover:underline">
                Crear cuenta
            </a>
        </p>

    </div>

</body>
</html>











