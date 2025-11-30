@extends('admin.layout')

@section('header_title', 'Funciones')
@section('header_subtitle', 'Gestión de funciones de cine')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.showtimes.create') }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded">
            + Nueva función
        </a>
    </div>

    <table class="w-full text-sm">
        <thead class="border-b">
        <tr>
            <th class="py-2 text-left">Película</th>
            <th class="py-2 text-left">Cine</th>
            <th class="py-2 text-left">Fecha</th>
            <th class="py-2 text-left">Hora</th>
            <th class="py-2 text-left">Sala</th>
            <th class="py-2 text-left">Form.</th>
            <th class="py-2 text-left">Idioma</th>
            <th class="py-2 text-left">Precio</th>
            <th class="py-2 text-right">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($showtimes as $show)
            <tr class="border-b">
                <td class="py-2">{{ $show->movie->title }}</td>
                <td class="py-2">{{ $show->cinema->name }}</td>

                {{-- 🔥 Campos unificados --}}
                <td class="py-2">
                    {{ \Carbon\Carbon::parse($show->date)->format('d/m/Y') }}
                </td>

                <td class="py-2">
                    {{ \Carbon\Carbon::parse($show->time)->format('H:i') }}
                </td>

                <td class="py-2">{{ $show->room }}</td>
                <td class="py-2">{{ $show->format }}</td>
                <td class="py-2">{{ $show->language }}</td>

                <td class="py-2">S/ {{ number_format($show->price, 2) }}</td>

                <td class="py-2 text-right space-x-2">
                    <a href="{{ route('admin.showtimes.edit', $show) }}" class="text-blue-500">Editar</a>

                    <form action="{{ route('admin.showtimes.destroy', $show) }}"
                          method="POST"
                          class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500"
                                onclick="return confirm('¿Eliminar función?')">
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $showtimes->links() }}
    </div>
@endsection

