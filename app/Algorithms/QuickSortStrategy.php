<?php
namespace App\Algorithms;

class QuickSortStrategy {
    public function sort(array $movies): array {
        $count = count($movies);
        if ($count < 2) return $movies;

        $pivot = $movies[intdiv($count, 2)];
        $left = $right = [];

        foreach ($movies as $index => $movie) {
            if ($index === intdiv($count, 2)) continue;
            if ($movie['release_date'] < $pivot['release_date'])
                $left[] = $movie;
            else
                $right[] = $movie;
        }

        return array_merge(
            $this->sort($left),
            [$pivot],
            $this->sort($right)
        );
    }
}
