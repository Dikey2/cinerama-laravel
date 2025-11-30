<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Algorithms\QuickSortStrategy;
use App\Algorithms\MergeSortStrategy;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // Cargar películas con horarios y cines relacionados
        $moviesOriginal = Movie::with(['showtimes.cinema'])->get();

        // 🔍 Filtro por búsqueda
        if ($request->filled('search')) {
            $term = strtolower($request->search);

            $moviesOriginal = $moviesOriginal->filter(function ($m) use ($term) {
                return str_contains(strtolower($m->title), $term)
                    || str_contains(strtolower($m->genre), $term);
            });
        }

        // ✔ Convertir películas al formato usado por Alpine.js
        $moviesArray = $moviesOriginal->map(function ($movie) {
            return [
                'id'            => $movie->id,
                'title'         => $movie->title,
                'genre'         => $movie->genre,
                'city'          => $movie->city,
                'duration'      => $movie->duration,
                'classification'=> $movie->classification,
                'image'         => $movie->image ?? null,
                'release_date'  => $movie->release_date,
                'description'   => $movie->description,

                'showtimes' => $movie->showtimes->map(function ($s) {
                    return [
                        'id'        => $s->id,
                        'cinema'    => $s->cinema ? $s->cinema->name : "Sin cine",
                        'cinema_id' => $s->cinema_id,
                        'time'      => substr($s->time, 0, 5),
                        'format'    => $s->format,
                        'language'  => $s->language,
                    ];
                })->toArray(),
            ];
        })->toArray();


        // 📌 Ordenamiento
        $sortType = $request->get('sort', 'merge');
        $sortedMovies = $sortType === 'quick'
            ? (new QuickSortStrategy())->sort($moviesArray)
            : (new MergeSortStrategy())->sort($moviesArray);


        // -----------------------------------------
        // 🔥 Reinyectar horarios reales + cines (solo una vez)
        // -----------------------------------------
        $sortedMovies = array_map(function ($m) use ($moviesOriginal) {

            $movieReal = $moviesOriginal->firstWhere('id', $m['id']);

            $m['showtimes'] = $movieReal->showtimes->load('cinema')->map(function ($s) {
            return [
                'id'        => $s->id,
                'cinema'    => $s->cinema->name ?? "Sin cine",
                'cinema_id' => $s->cinema_id,
                'time'      => substr($s->time, 0, 5),
                'format'    => $s->format,
                'language'  => $s->language,
            ];
        })->toArray();


            return $m;
        }, $sortedMovies);

        // 🔥 Convertir a arrays 100% puros para Alpine.js
        $sortedMovies = array_map(fn($m) => json_decode(json_encode($m), true), $sortedMovies);


        return view('peliculas', [
            'peliculas'         => $sortedMovies,
            'moviesOriginal'    => $moviesOriginal,
            'groupedShowtimes'  => $moviesOriginal->mapWithKeys(fn($m) => [
                $m->id => $m->showtimes->groupBy('cinema_id')
            ]),
            'sortType'          => ucfirst($sortType),
            'search'            => $request->get('search', ''),
        ]);
    }


    public function proximos()
    {
        $movies = Movie::with(['showtimes.cinema'])
            ->orderBy('release_date', 'asc')
            ->get();

        return view('proximos', compact('movies'));
    }
}





