@extends('admin.layout')
@section('title','Películas')

@section('admin-content')
<a href="{{ route('admin.movies.create') }}" class="bg-yellow-500 text-black px-4 py-2 rounded">+ Nueva</a>

<table class="w-full mt-4 text-sm">
    <thead class="text-left text-gray-400">
        <tr><th>Título</th><th>Género</th><th>Estreno</th><th></th></tr>
    </thead>
    <tbody>
        @foreach($movies as $m)
        <tr class="border-b border-gray-800">
            <td class="py-2">{{ $m->title }}</td>
            <td>{{ $m->genre }}</td>
            <td>{{ \Carbon\Carbon::parse($m->release_date)->format('d/m/Y') }}</td>
            <td class="text-right">
                <a class="text-yellow-400" href="{{ route('admin.movies.edit',$m) }}">Editar</a>
                <form action="{{ route('admin.movies.destroy',$m) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                    @csrf @method('DELETE')
                    <button class="text-red-400 ml-3">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
