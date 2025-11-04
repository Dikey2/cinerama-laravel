@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen py-10">

    <div class="max-w-6xl mx-auto px-6">

        <!-- 🧑 Perfil -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 border-b border-yellow-400 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-yellow-400">👋 Bienvenido, {{ $user->name }}</h1>
                <p class="text-gray-400 mt-2">Panel de control de tu cuenta Cinerama</p>
            </div>

            <a href="{{ route('profile.edit') }}" 
               class="bg-yellow-500 text-black px-5 py-2 rounded-full font-semibold hover:bg-yellow-400 transition mt-4 md:mt-0">
                ⚙️ Editar perfil
            </a>
        </div>

        <!-- 🎟️ Últimos pedidos -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">🧾 Últimos pedidos</h2>

            @if($pedidos->count() > 0)
                <div class="bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-800">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-yellow-400 border-b border-gray-700">
                                <th class="pb-2">Código</th>
                                <th class="pb-2">Fecha</th>
                                <th class="pb-2">Total</th>
                                <th class="pb-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr class="border-b border-gray-800 hover:bg-gray-800 transition">
                                    <td class="py-2">{{ $pedido->codigo }}</td>
                                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-yellow-400 font-semibold">S/ {{ number_format($pedido->total, 2) }}</td>
                                    <td>
                                        <span class="px-3 py-1 rounded-full text-sm 
                                            {{ $pedido->estado === 'Entregado' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-black' }}">
                                            {{ $pedido->estado }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400">No tienes pedidos recientes.</p>
            @endif
        </section>

        <!-- 🎫 Membresía -->
        <section class="mb-10">
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">💳 Tu membresía Cinerama</h2>
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 shadow-lg flex flex-col md:flex-row items-center justify-between">
                <div>
                    <p class="text-lg font-semibold">Tipo de socio: <span class="text-yellow-400">Gold</span></p>
                    <p class="text-gray-400">Beneficios: descuentos, dulcería exclusiva y preventas.</p>
                </div>
                <button class="bg-yellow-500 text-black px-6 py-2 rounded-full mt-4 md:mt-0 hover:bg-yellow-400 transition">
                    Ver beneficios 🎁
                </button>
            </div>
        </section>

        <!-- 📽️ Preferencias -->
        <section>
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">🏙️ Tus preferencias de cine</h2>
            <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 shadow-lg">
                <p class="text-gray-400">Ciudad preferida: <span class="text-yellow-400">Arequipa</span></p>
                <p class="text-gray-400">Cine habitual: <span class="text-yellow-400">Cinerama Mall Aventura</span></p>
            </div>
        </section>

    </div>
</div>
@endsection


