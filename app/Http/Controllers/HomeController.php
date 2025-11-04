<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Algorithms\QuickSortStrategy;
use App\Algorithms\MergeSortStrategy;
use App\Algorithms\BinarySearchTree;

class HomeController extends Controller
{
    /**
     * 🏠 Página principal: Próximos Estrenos (Carrusel estilo Cineplanet)
     */
    public function index(Request $request)
    {
        try {
            // 🎬 Filtrar solo películas marcadas como “estreno”
            $query = Movie::query()->where('status', 'estreno');

            // 🔍 Filtro de búsqueda opcional
            if ($request->has('search')) {
                $term = $request->get('search');
                $query->where(function ($q) use ($term) {
                    $q->where('title', 'like', "%$term%")
                      ->orWhere('genre', 'like', "%$term%");
                });
            }

            // 📋 Obtener resultados (seguro)
            $movies = $query->get();
            if ($movies->isEmpty()) {
                // En caso de que no haya estrenos
                return view('home', [
                    'peliculas' => [],
                    'genresTree' => [],
                    'sortType' => 'Merge',
                    'search' => $request->get('search', ''),
                    'message' => '😔 No hay próximos estrenos disponibles en este momento.'
                ]);
            }

            // Convertir a array
            $moviesArray = $movies->toArray();

            // ⚙️ Ordenamiento (MergeSort o QuickSort)
            $sortType = $request->get('sort', 'merge');
            $sortedMovies = $sortType === 'quick'
                ? (new QuickSortStrategy())->sort($moviesArray)
                : (new MergeSortStrategy())->sort($moviesArray);

            // 🌳 Agrupar por género usando árbol binario
            $tree = new BinarySearchTree();
            foreach ($sortedMovies as $movie) {
                $tree->insert($movie['genre'], $movie);
            }

            $genresTree = $tree->inOrderTraversal();

            // ✅ Renderizar vista principal
            return view('home', [
                'peliculas' => $sortedMovies,
                'genresTree' => $genresTree,
                'sortType' => ucfirst($sortType),
                'search' => $request->get('search', ''),
            ]);
        } catch (\Exception $e) {
            // ⚠️ En caso de error inesperado
            return back()->with('error', 'Error al cargar los próximos estrenos: ' . $e->getMessage());
        }
    }
}

