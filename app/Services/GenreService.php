<?php

namespace App\Services;

use App\Models\Genre;
use App\Traits\ServiceTrait;
use Illuminate\Database\Eloquent\Collection;

class GenreService
{
    use ServiceTrait;

    public function getAllGenre(): Collection
    {
        return $this->getAll(Genre::class);
    }

    public function getGenre(int|string $data, string $column = 'class'): mixed
    {
        return $this->get($data, Genre::class, $column);
    }

    public function createGenre(array $data)
    {
        return $this->create($data, Genre::class);
    }

    public function updateGenre(int $id, object $data)
    {
        return $this->update($id, $data, Genre::class);
    }

    public function deleteGenre(int $id): true
    {
        return $this->delete($id, Genre::class);
    }
}
