<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieAdminController extends Controller
{
    // 📄 Listado de películas
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    // 🆕 Formulario de creación
    public function create()
    {
        return view('admin.movies.create');
    }

    // 💾 Guardar nueva película
    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'genre'           => 'required|string',
            'duration'        => 'nullable|string',
            'classification'  => 'nullable|string',
            'format'          => 'nullable|string',
            'language'        => 'nullable|string',
            'city'            => 'nullable|string',
            'synopsis'        => 'nullable|string',
            'release_date'    => 'nullable|date',
            'trailer_url'     => 'nullable|url',
            'poster'          => 'nullable|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        // 📸 Guardar imagen correctamente
        if ($request->hasFile('poster')) {
            $extension = $request->poster->getClientOriginalExtension();
            $nombre = Str::random(40) . '.' . $extension;

            $request->poster->storeAs('public/images/peliculas', $nombre);

            $validated['image'] = "images/peliculas/" . $nombre;
        }

        Movie::create($validated);

        return redirect()->route('admin.movies.index')
            ->with('success', '🎬 Película registrada con éxito');
    }

    // ✏️ Formulario de edición
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    // ♻️ Actualizar película
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'genre'           => 'required|string',
            'duration'        => 'nullable|string',
            'classification'  => 'nullable|string',
            'format'          => 'nullable|string',
            'language'        => 'nullable|string',
            'city'            => 'nullable|string',
            'synopsis'        => 'nullable|string',
            'release_date'    => 'nullable|date',
            'trailer_url'     => 'nullable|url',
            'poster'          => 'nullable|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        // 📸 Si suben una nueva imagen reemplazar
        if ($request->hasFile('poster')) {
            $extension = $request->poster->getClientOriginalExtension();
            $nombre = Str::random(40) . '.' . $extension;

            $request->poster->storeAs('public/images/peliculas', $nombre);

            $validated['image'] = "images/peliculas/" . $nombre;
        }

        $movie->update($validated);

        return redirect()->route('admin.movies.index')
            ->with('success', '✅ Película actualizada correctamente');
    }

    // 🗑️ Eliminar película
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies.index')
            ->with('success', '❌ Película eliminada correctamente');
    }
}








