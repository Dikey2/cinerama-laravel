@extends('admin.layout')

@section('title', 'Usuarios registrados')
@section('header_title', 'Usuarios')
@section('header_subtitle', 'Listado de usuarios registrados')

@section('content')

<div class="bg-white shadow-sm rounded-lg p-6">

    <h2 class="text-lg font-semibold mb-4">Usuarios registrados ({{ $users->count() }})</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Rol</th>
                    <th class="px-4 py-2 border">Fecha de registro</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $user->id }}</td>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 rounded text-white text-xs
                                {{ $user->role === 'admin' ? 'bg-yellow-600' : 'bg-blue-600' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border">
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 rounded text-xs bg-green-500 text-white">Activo</span>
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <button class="text-blue-600 hover:underline">Editar</button>
                            <button class="text-red-600 hover:underline ml-3">Borrar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-2 border text-center" colspan="7">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

</div>

@endsection
