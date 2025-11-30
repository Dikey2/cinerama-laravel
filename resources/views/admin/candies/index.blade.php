@extends('admin.layout')

@section('header_title', 'Dulcería')
@section('header_subtitle', 'Administra los productos de la dulcería')

@section('content')

<a href="{{ route('admin.candies.create') }}"
   class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600">
    ➕ Nuevo producto
</a>

<div class="mt-6 bg-white shadow rounded-lg p-4">
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="p-2 text-left">Nombre</th>
                <th class="p-2 text-left">Precio</th>
                <th class="p-2 text-left">Categoría</th>
                <th class="p-2 text-left">Imagen</th>
                <th class="p-2 text-left">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($items as $item)
                <tr class="border-b">
                    <td class="p-2">{{ $item->nombre }}</td>
                    <td class="p-2">S/ {{ number_format($item->precio, 2) }}</td>
                    <td class="p-2 capitalize">{{ $item->categoria }}</td>
                    <td class="p-2">
                        @if($item->imagen)
                            <img src="{{ asset('storage/'.$item->imagen) }}" class="h-12 rounded">
                        @else
                            —
                        @endif
                    </td>

                    <td class="p-2 flex gap-3">
                        <a href="{{ route('admin.candies.edit', $item) }}"
                           class="text-blue-600 hover:underline">Editar</a>

                        <form method="POST" action="{{ route('admin.candies.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" 
                                    onclick="return confirm('¿Eliminar este producto?')">
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        No hay productos en dulcería aún.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

