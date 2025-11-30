<?php

namespace App\Algorithms;

class MergeSortStrategy
{
    public function sort(array $movies): array
    {
        $count = count($movies);
        if ($count < 2) return $movies;

        $mid = intdiv($count, 2);
        $left = array_slice($movies, 0, $mid);
        $right = array_slice($movies, $mid);

        return $this->merge(
            $this->sort($left),
            $this->sort($right)
        );
    }

    private function merge(array $a, array $b): array
    {
        $result = [];

        while (count($a) && count($b)) {
            // Usamos 'created_at' como criterio principal (fecha de creación)
            $leftDate = $a[0]['created_at'] ?? '0000-00-00';
            $rightDate = $b[0]['created_at'] ?? '0000-00-00';

            if ($leftDate <= $rightDate)
                $result[] = array_shift($a);
            else
                $result[] = array_shift($b);
        }

        return array_merge($result, $a, $b);
    }
}

