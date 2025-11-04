@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-yellow-400 mb-6">@yield('title')</h1>
    @if(session('success'))
        <div class="bg-green-900 text-green-200 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @yield('admin-content')
</div>
@endsection
