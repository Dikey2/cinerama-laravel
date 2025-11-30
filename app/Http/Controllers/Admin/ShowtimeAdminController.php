<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Cinema;
use Illuminate\Http\Request;

class ShowtimeAdminController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with(['movie','cinema'])
            ->orderBy('date')   // 🔥 unificado
            ->orderBy('time')   // 🔥 unificado
            ->paginate(20);

        return view('admin.showtimes.index', compact('showtimes'));
    }

    public function create()
    {
        $movies  = Movie::orderBy('title')->get();
        $cinemas = Cinema::orderBy('name')->get();

        return view('admin.showtimes.create', compact('movies','cinemas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'cinema_id'  => 'required|exists:cinemas,id',
            'date'       => 'required|date',       // 🔥 antes show_date
            'time'       => 'required',            // 🔥 antes show_time
            'format'     => 'required|string',
            'language'   => 'required|string',
            'room'       => 'nullable|string',
            'price'      => 'required|numeric|min:0',
        ]);

        Showtime::create($data);

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Función creada correctamente');
    }

    public function edit(Showtime $showtime)
    {
        $movies  = Movie::orderBy('title')->get();
        $cinemas = Cinema::orderBy('name')->get();

        return view('admin.showtimes.edit', compact('showtime','movies','cinemas'));
    }

    public function update(Request $request, Showtime $showtime)
    {
        $data = $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'cinema_id'  => 'required|exists:cinemas,id',
            'date'       => 'required|date',       // 🔥 unificado
            'time'       => 'required',            // 🔥 unificado
            'format'     => 'required|string',
            'language'   => 'required|string',
            'room'       => 'nullable|string',
            'price'      => 'required|numeric|min:0',
        ]);

        $showtime->update($data);

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Función actualizada');
    }

    public function destroy(Showtime $showtime)
    {
        $showtime->delete();

        return redirect()->route('admin.showtimes.index')
            ->with('success', 'Función eliminada');
    }
}

