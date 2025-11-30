@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Administrar Cines</h1>

    <a href="{{ route('admin.cinemas.create') }}"
       class="px-5 py-2 bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600 shadow">
        + Registrar Cine
    </a>
</div>

@if ($items->count() == 0)
    <p class="text-gray-500 text-lg">Aún no hay cines registrados.</p>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

@foreach ($items as $cine)
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <div class="h-36 bg-gray-200"></div>

        <div class="p-5">
            <h2 class="text-xl font-bold">{{ $cine->name }}</h2>
            <p class="text-gray-600">{{ $cine->city }}</p>

            <div class="flex gap-2 mt-4">

                <a href="{{ route('admin.cinemas.edit', $cine) }}"
                   class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                   Editar
                </a>

                <form action="{{ route('admin.cinemas.destroy', $cine) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Eliminar
                    </button>
                </form>

            </div>
        </div>
    </div>
@endforeach

</div>

@endsection
