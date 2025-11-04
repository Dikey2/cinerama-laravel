<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Algorithms\QuickSortStrategy;
use App\Algorithms\MergeSortStrategy;
use App\Algorithms\BinarySearchTree;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        // 🔎 Filtro de búsqueda por título o género
        if ($request->has('search')) {
            $term = $request->get('search');
            $query->where('title', 'like', "%$term%")
                  ->orWhere('genre', 'like', "%$term%");
        }

        $movies = $query->get()->toArray();

        // ⚙️ Ordenamiento dinámico
        $sortType = $request->get('sort', 'merge');
        $sortedMovies = [];

        if ($sortType === 'quick') {
            $sortedMovies = (new QuickSortStrategy())->sort($movies);
        } else {
            $sortedMovies = (new MergeSortStrategy())->sort($movies);
        }

        // 🌳 BST agrupado por género
        $tree = new BinarySearchTree();
        foreach ($sortedMovies as $movie) {
            $tree->insert($movie['genre'], $movie);
        }

        $genresTree = $tree->inOrderTraversal();

        // ✅ Llamamos a la nueva vista de películas (no home)
        return view('peliculas', [
            'peliculas' => $sortedMovies,
            'genresTree' => $genresTree,
            'sortType' => ucfirst($sortType),
            'search' => $request->get('search', ''),
        ]);
    }
}


