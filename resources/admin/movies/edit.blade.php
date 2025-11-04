@extends('admin.layout')
@section('title','Editar Película')

@section('admin-content')
<form method="POST" action="{{ route('admin.movies.update',$movie) }}" class="space-y-4">
    @csrf @method('PUT')
    @include('admin.movies.form', ['movie'=>$movie])
    <button class="bg-yellow-500 text-black px-4 py-2 rounded">Actualizar</button>
</form>
@endsection
