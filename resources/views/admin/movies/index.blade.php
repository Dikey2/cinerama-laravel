@extends('admin.layout')

@section('title', 'Películas')
@section('header_title', 'Gestión de películas')
@section('header_subtitle', 'Administra el catálogo completo de Cinerama')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-sm md:text-base font-semibold">Listado de películas</h2>
        <a href="{{ route('admin.movies.create') }}"
           class="inline-flex items-center px-3 py-1.5 rounded-lg bg-yellow-500 text-slate-950 text-xs font-semibold hover:bg-yellow-400">
            ➕ Nueva película
        </a>
    </div>

    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden">
        <div class="p-3 border-b border-slate-800 flex items-center justify-between text-xs">
            <span class="text-slate-400">Catálogo actual</span>
            <span class="text-slate-500">{{ $movies->count() ?? 0 }} películas</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-900/90 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="py-2 px-3">Título</th>
                        <th class="py-2 px-3">Género</th>
                        <th class="py-2 px-3">Duración</th>
                        <th class="py-2 px-3">Clasificación</th>
                        <th class="py-2 px-3">Estado</th>
                        <th class="py-2 px-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($movies as $movie)
                        <tr class="hover:bg-slate-800/40">
                            <td class="py-2 px-3">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-100">{{ $movie->title }}</span>
                                    <span class="text-[11px] text-slate-400">
                                        Estreno: {{ optional($movie->release_date)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-2 px-3 text-slate-200">{{ $movie->genre }}</td>
                            <td class="py-2 px-3 text-slate-200">{{ $movie->duration }} min</td>
                            <td class="py-2 px-3 text-slate-200">{{ $movie->classification }}</td>
                            <td class="py-2 px-3">
                                <span class="px-2 py-0.5 rounded-full text-[11px] bg-green-500/10 text-green-400 border border-green-500/40">
                                    Activa
                                </span>
                            </td>
                            <td class="py-2 px-3 text-right">
                                <div class="inline-flex gap-1">
                                    <a href="{{ route('admin.movies.edit', $movie) }}"
                                       class="px-2 py-1 rounded-md bg-slate-800 text-slate-100 hover:bg-slate-700">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.movies.destroy', $movie) }}"
                                          onsubmit="return confirm('¿Eliminar esta película?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 rounded-md bg-red-500/80 text-slate-100 hover:bg-red-500">
                                            Borrar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-3 text-center text-slate-400">
                                No hay películas registradas todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

