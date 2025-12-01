@extends('admin.layout')

@section('header_title', 'Editar usuario')
@section('header_subtitle', 'Modificar datos del usuario')

@section('content')

<div class="bg-white p-6 rounded-xl shadow-md border">

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-semibold">Nombre</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   class="w-full border px-3 py-2 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="font-semibold">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                   class="w-full border px-3 py-2 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="font-semibold">Rol</label>
            <select name="role" class="w-full border px-3 py-2 rounded-lg">
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="user"  {{ $user->role=='user'?'selected':'' }}>Usuario</option>
            </select>
        </div>

        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
            Guardar cambios
        </button>

    </form>

</div>

@endsection
