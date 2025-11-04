@extends('admin.layout')
@section('title','Nueva Película')

@section('admin-content')
<form method="POST" action="{{ route('admin.movies.store') }}" class="space-y-4">
    @csrf
    @include('admin.movies.form')
    <button class="bg-yellow-500 text-black px-4 py-2 rounded">Guardar</button>
</form>
@endsection
