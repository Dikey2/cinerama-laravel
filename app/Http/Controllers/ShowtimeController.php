<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Showtime;

class ShowtimeController extends Controller
{   
    public function byMovie(Movie $movie)
{
    $showtimes = Showtime::with('cinema')
        ->where('movie_id', $movie->id)
        ->where('show_date', '>=', now()->toDateString())
        ->orderBy('show_date')
        ->orderBy('show_time')
        ->get()
        ->groupBy('cinema_id');

    return view('peliculas.funciones', [
        'movie' => $movie,
        'groupedShowtimes' => $showtimes,
    ]);
}

}

