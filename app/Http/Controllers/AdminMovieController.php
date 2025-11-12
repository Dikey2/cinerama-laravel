<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    // 📄 Mostrar lista de películas
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'required|string',
            'duration' => 'nullable|string',
            'classification' => 'nullable|string',
            'format' => 'nullable|string',
            'language' => 'nullable|string',
            'city' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'release_date' => 'nullable|date',
            'trailer_url' => 'nullable|url',
            'poster' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'schedules' => 'nullable|string',
        ]);

        // 📸 Guardar imagen
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('images/peliculas', 'public');
            $validated['poster'] = basename($path);
            $validated['image'] = basename($path); // 🔁 sincronizar ambos campos
        }

        // 🕒 Guardar los horarios como JSON
        if ($request->filled('schedules')) {
            $validated['schedules'] = json_encode($request->schedules);
        }

        Movie::create($validated);

        return redirect()->route('admin.movies.index')->with('success', '🎬 Película registrada con éxito');
    }

    // ✏️ Formulario de edición
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    // 🔄 Actualizar película
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'genre' => 'required|string',
            'duration' => 'nullable|string',
            'classification' => 'nullable|string',
            'format' => 'nullable|string',
            'language' => 'nullable|string',
            'city' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'release_date' => 'nullable|date',
            'trailer_url' => 'nullable|url',
            'poster' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'schedules' => 'nullable|string',
        ]);

        // 📸 Actualizar imagen si se sube una nueva
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('images/peliculas', 'public');
            $validated['poster'] = basename($path);
            $validated['image'] = basename($path);
        }

        // 🕒 Guardar los horarios como JSON
        if ($request->filled('schedules')) {
            $validated['schedules'] = json_encode($request->schedules);
        }

        $movie->update($validated);

        return redirect()->route('admin.movies.index')->with('success', '✅ Película actualizada correctamente');
    }

    // 🗑️ Eliminar
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', '❌ Película eliminada correctamente');
    }
}


