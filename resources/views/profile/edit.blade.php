@extends('layouts.app-cinerama')

@section('content')

    <div class="min-h-screen bg-[#0b0e13] flex justify-center py-10 px-4">
        <div class="w-full max-w-3xl bg-[#0f1218] border border-gray-800 rounded-2xl shadow-2xl p-10 text-white">

            <!-- Título -->
            <h1 class="text-3xl font-bold text-yellow-400 text-center mb-6">
                Perfil del Socio
            </h1>

            <!-- Tarjeta Membership -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-black rounded-2xl p-6 shadow-lg mb-10">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-extrabold">Cinerama Member</h2>
                    <span class="text-sm font-bold">{{ strtoupper(auth()->user()->name) }}</span>
                </div>

                <div class="mt-4 grid grid-cols-3 text-center font-semibold">
                    <div>
                        <p class="text-xs text-black/70">Nivel</p>
                        <p class="text-lg">
                            @php
                                $nivel = "Regular";
                                $puntos = auth()->user()->points ?? 0;

                                if ($puntos >= 500) $nivel = "Oro";
                                elseif ($puntos >= 200) $nivel = "Plata";
                            @endphp

                            {{ $nivel }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-black/70">Puntos</p>
                        <p class="text-lg">{{ $puntos }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-black/70">Compras</p>
                        <p class="text-lg">{{ \App\Models\Ticket::where('user_id', auth()->id())->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Información del Usuario -->
            <div class="space-y-6">
                <div class="bg-[#111] p-5 rounded-xl border border-gray-700">
                    <p class="text-gray-400 text-sm">Nombre completo</p>
                    <p class="text-xl font-semibold mt-1">{{ auth()->user()->name }}</p>
                </div>

                <div class="bg-[#111] p-5 rounded-xl border border-gray-700">
                    <p class="text-gray-400 text-sm">Correo electrónico</p>
                    <p class="text-xl font-semibold mt-1">{{ auth()->user()->email }}</p>
                </div>

                <div class="bg-[#111] p-5 rounded-xl border border-yellow-500 shadow-lg">
                    <p class="text-yellow-400 text-sm font-bold">Beneficios del socio</p>
                    <ul class="mt-2 space-y-1 text-gray-200 text-sm">
                        <li>✔ Entradas anticipadas</li>
                        <li>✔ Promociones exclusivas</li>
                        <li>✔ Acumulación de puntos por compras</li>
                        <li>✔ Acceso a preventas especiales</li>
                        <li>✔ Descuentos en dulcería (solo socios Oro)</li>
                    </ul>
                </div>
            </div>

            <!-- Historial de Compras -->
            <div class="mt-10">
                <h2 class="text-xl font-bold text-yellow-400 mb-3">Historial de Compras</h2>

                @php
                    $tickets = \App\Models\Ticket::where('user_id', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();
                @endphp

                @if ($tickets->isEmpty())
                    <p class="text-gray-400 text-sm">Aún no tienes compras registradas.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($tickets as $t)
                            <div class="bg-[#111] p-4 rounded-xl border border-gray-800">
                                <p class="text-yellow-400 font-semibold">Compra #{{ $t->code }}</p>
                                <p class="text-sm text-gray-300">
                                    {{ $t->created_at->format('d M Y - H:i') }}
                                </p>
                                <p class="mt-1 text-gray-200 text-sm">
                                    Función: {{ $t->showtime->movie->title }}
                                </p>
                                <p class="text-gray-400 text-xs">
                                    Asientos: {{ implode(', ', $t->seats) }}
                                </p>
                                <p class="mt-1 font-bold text-yellow-300">S/ {{ number_format($t->total, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection



