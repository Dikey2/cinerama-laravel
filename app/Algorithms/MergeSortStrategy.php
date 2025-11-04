<?php
namespace App\Algorithms;

class MergeSortStrategy {
    public function sort(array $movies): array {
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

    private function merge(array $a, array $b): array {
        $result = [];
        while (count($a) && count($b)) {
            if ($a[0]['release_date'] <= $b[0]['release_date'])
                $result[] = array_shift($a);
            else
                $result[] = array_shift($b);
        }
        return array_merge($result, $a, $b);
    }
}
