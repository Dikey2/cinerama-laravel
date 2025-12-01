@extends('admin.layout')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')
@section('header_subtitle', 'Resumen general de Cinerama')

@section('content')

    {{-- Tarjetas de métricas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-8">

        {{-- Películas --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex flex-col gap-1">
            <span class="text-xs text-slate-400 flex items-center gap-2">🎬 Películas</span>
            <span class="text-2xl font-semibold">{{ $stats['movies'] ?? 0 }}</span>
            <a href="{{ route('admin.movies.index') }}" class="mt-2 text-xs text-yellow-400 hover:text-yellow-300">Ver todas →</a>
        </div>

        {{-- Cines --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex flex-col gap-1">
            <span class="text-xs text-slate-400 flex items-center gap-2">🎦 Cines</span>
            <span class="text-2xl font-semibold">{{ $stats['cinemas'] ?? 0 }}</span>
            <a href="{{ route('admin.cinemas.index') }}" class="mt-2 text-xs text-yellow-400 hover:text-yellow-300">Gestionar cines →</a>
        </div>

        {{-- Promociones --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex flex-col gap-1">
            <span class="text-xs text-slate-400 flex items-center gap-2">🎉 Promociones</span>
            <span class="text-2xl font-semibold">{{ $stats['promos'] ?? 0 }}</span>
            <a href="{{ route('admin.promociones.index') }}" class="mt-2 text-xs text-yellow-400 hover:text-yellow-300">Ver promos →</a>
        </div>

        {{-- Pedidos --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex flex-col gap-1">
            <span class="text-xs text-slate-400 flex items-center gap-2">📦 Pedidos</span>
            <span class="text-2xl font-semibold">{{ $stats['orders'] ?? 0 }}</span>
            <span class="text-[11px] text-slate-500 mt-1">Últimas 24 horas</span>
        </div>

        {{-- Usuarios --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex flex-col gap-1">
            <span class="text-xs text-slate-400 flex items-center gap-2">👤 Usuarios registrados</span>
            <span class="text-2xl font-semibold">{{ $stats['users'] ?? 0 }}</span>
            <span class="text-[11px] text-slate-500 mt-1">Incluye clientes y admins</span>
        </div>

    </div>


    {{-- Últimos pedidos + Acciones rápidas --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Últimos pedidos --}}
        <div class="xl:col-span-2 bg-slate-900/80 border border-slate-800 rounded-2xl p-4">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold">Últimos pedidos</h2>
                <span class="text-xs text-slate-400">Actualizado {{ now()->format('H:i') }}h</span>
            </div>

            @if(isset($lastOrders) && $lastOrders->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="text-slate-400 border-b border-slate-800">
                            <tr>
                                <th class="py-2 pr-4">Código</th>
                                <th class="py-2 pr-4">Cliente</th>
                                <th class="py-2 pr-4">Total</th>
                                <th class="py-2 pr-4">Estado</th>
                                <th class="py-2 pr-4">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @foreach($lastOrders as $order)
                                <tr class="hover:bg-slate-800/40">
                                    <td class="py-2 pr-4 font-mono text-yellow-300">{{ $order->codigo ?? $order->id }}</td>
                                    <td class="py-2 pr-4">{{ $order->cliente_nombre ?? '—' }}</td>
                                    <td class="py-2 pr-4">S/ {{ number_format($order->total ?? 0, 2) }}</td>
                                    <td class="py-2 pr-4">
                                        <span class="px-2 py-0.5 rounded-full text-[11px]
                                            @if(($order->estado ?? '') === 'pagado')
                                                bg-green-500/10 text-green-400 border border-green-500/40
                                            @else
                                                bg-slate-700/40 text-slate-200 border border-slate-600/60
                                            @endif">
                                            {{ ucfirst($order->estado ?? 'pendiente') }}
                                        </span>
                                    </td>
                                    <td class="py-2 pr-4 text-slate-400">{{ optional($order->created_at)->format('d/m H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-xs text-slate-400">Aún no hay pedidos registrados.</p>
            @endif

        </div>


        {{-- Acciones rápidas --}}
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 space-y-4">

            <h2 class="text-sm font-semibold mb-2">Acciones rápidas</h2>

            <a href="{{ route('admin.movies.create') }}"
               class="flex items-center justify-between px-3 py-2 rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-200 text-xs hover:bg-yellow-500/20 transition">
                <span>➕ Crear nueva película</span>
                <span class="font-semibold text-[11px]">CTRL + P</span>
            </a>

            <a href="{{ route('admin.cinemas.create') }}"
               class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-800/80 border border-slate-700 text-slate-200 text-xs hover:bg-slate-700 transition">
                <span>📍 Registrar nuevo cine</span>
                <span class="font-semibold text-[11px]">CTRL + C</span>
            </a>

            <a href="{{ route('admin.promociones.create') }}"
               class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-800/80 border border-slate-700 text-slate-200 text-xs hover:bg-slate-700 transition">
                <span>🎉 Crear promoción</span>
                <span class="font-semibold text-[11px]">CTRL + R</span>
            </a>

            <div class="mt-4 pt-4 border-t border-slate-800 text-[11px] text-slate-500">
                <p>Puedes ir mejorando este panel agregando más tarjetas, estadísticas, filtros por fechas, etc.</p>
            </div>

        </div>

    </div>

@endsection



