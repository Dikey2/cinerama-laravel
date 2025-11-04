@php($movie = $movie ?? null)

<div>
    <label class="block text-sm text-gray-300">Título</label>
    <input name="title" value="{{ old('title', $movie->title ?? '') }}" class="w-full bg-gray-900 border border-gray-700 rounded p-2">
    @error('title')<div class="text-red-400 text-xs">{{ $message }}</div>@enderror
</div>
<div>
    <label class="block text-sm text-gray-300">Género</label>
    <input name="genre" value="{{ old('genre', $movie->genre ?? '') }}" class="w-full bg-gray-900 border border-gray-700 rounded p-2">
    @error('genre')<div class="text-red-400 text-xs">{{ $message }}</div>@enderror
</div>
<div>
    <label class="block text-sm text-gray-300">Fecha de Estreno</label>
    <input type="date" name="release_date" value="{{ old('release_date', isset($movie)?$movie->release_date->format('Y-m-d'):'') }}" class="bg-gray-900 border border-gray-700 rounded p-2">
    @error('release_date')<div class="text-red-400 text-xs">{{ $message }}</div>@enderror
</div>
<div>
    <label class="block text-sm text-gray-300">Poster (URL)</label>
    <input name="poster" value="{{ old('poster', $movie->poster ?? '') }}" class="w-full bg-gray-900 border border-gray-700 rounded p-2">
</div>
<div>
    <label class="block text-sm text-gray-300">Descripción</label>
    <textarea name="description" rows="3" class="w-full bg-gray-900 border border-gray-700 rounded p-2">{{ old('description', $movie->description ?? '') }}</textarea>
</div>
