<?php

namespace App\Algorithms;

class TreeNode
{
    public string $genre;
    public array $movies = [];
    public ?TreeNode $left = null;
    public ?TreeNode $right = null;

    public function __construct(string $genre, string $movie)
    {
        $this->genre = $genre;
        $this->movies[] = $movie;
    }
}

class BinarySearchTree
{
    private ?TreeNode $root = null;

    /**
     * Inserta un nuevo género y película en el árbol.
     */
    public function insert(string $genre, string $movie): void
    {
        $this->root = $this->insertNode($this->root, $genre, $movie);
    }

    /**
     * Inserción recursiva dentro del árbol.
     */
    private function insertNode(?TreeNode $node, string $genre, string $movie): TreeNode
    {
        if ($node === null) {
            return new TreeNode($genre, $movie);
        }

        if ($genre === $node->genre) {
            // Si el género ya existe, agregamos la película
            $node->movies[] = $movie;
        } elseif (strcasecmp($genre, $node->genre) < 0) {
            // Comparación case-insensitive
            $node->left = $this->insertNode($node->left, $genre, $movie);
        } else {
            $node->right = $this->insertNode($node->right, $genre, $movie);
        }

        return $node;
    }

    /**
     * Recorre el árbol en orden (izquierda → raíz → derecha).
     */
    public function inOrderTraversal(?TreeNode $node = null, array &$result = []): array
    {
        if ($node === null) {
            $node = $this->root;
        }

        if ($node === null) {
            return $result; // Árbol vacío
        }

        if ($node->left !== null) {
            $this->inOrderTraversal($node->left, $result);
        }

        $result[] = [
            'genre' => $node->genre,
            'movies' => $node->movies,
        ];

        if ($node->right !== null) {
            $this->inOrderTraversal($node->right, $result);
        }

        return $result;
    }

    /**
     * Busca un género específico dentro del árbol.
     */
    public function search(string $genre): ?TreeNode
    {
        return $this->searchNode($this->root, $genre);
    }

    private function searchNode(?TreeNode $node, string $genre): ?TreeNode
    {
        if ($node === null) return null;

        if ($genre === $node->genre) {
            return $node;
        } elseif (strcasecmp($genre, $node->genre) < 0) {
            return $this->searchNode($node->left, $genre);
        } else {
            return $this->searchNode($node->right, $genre);
        }
    }
}


