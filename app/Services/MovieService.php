<?php

namespace App\Services;

use App\Models\Movie;
use App\Traits\ServiceTrait;
use Illuminate\Database\Eloquent\Collection;

class MovieService
{
    use ServiceTrait;

    public function getAllMovie(): Collection
    {
        return $this->getAll(Movie::class);
    }

    public function getMovie(int|string $data, string $column = 'class'): mixed
    {
        return $this->get($data, Movie::class, $column);
    }

    public function createMovie(array $data)
    {
        return $this->create($data, Movie::class);
    }

    public function updateMovie(int $id, object $data)
    {
        return $this->update($id, $data, Movie::class);
    }

    public function deleteMovie(int $id): true
    {
        return $this->delete($id, Movie::class);
    }
}
