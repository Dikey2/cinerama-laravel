@extends('admin.layout')

@section('title', 'Promociones')
@section('header_title', 'Gestión de promociones')
@section('header_subtitle', 'Administra las promociones de Cinerama')

@section('content')

<div class="flex justify-between mb-6">
    <h2 class="text-xl font-semibold">Listado de Promociones</h2>
    <a href="{{ route('admin.promociones.create') }}"
       class="px-4 py-2 bg-yellow-500 text-white rounded-lg">
        Nueva promoción
    </a>
</div>

<table class="w-full border border-gray-300 rounded-lg">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 border">Título</th>
            <th class="p-3 border">Validez</th>
            <th class="p-3 border">Estado</th>
            <th class="p-3 border">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $promo)
            <tr>
                <td class="p-3 border">{{ $promo->title }}</td>
                <td class="p-3 border">{{ $promo->valid_until }}</td>
                <td class="p-3 border">
                    @if($promo->active)
                        <span class="text-green-600">Activa</span>
                    @else
                        <span class="text-red-600">Inactiva</span>
                    @endif
                </td>
                <td class="p-3 border flex gap-2">
                    <a href="{{ route('admin.promociones.edit', $promo->id) }}"
                       class="px-3 py-1 bg-blue-500 text-white rounded">
                       Editar
                    </a>

                    <form action="{{ route('admin.promociones.destroy', $promo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-red-500 text-white rounded"
                                onclick="return confirm('¿Seguro?')">
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
