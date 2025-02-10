<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'is_published' => true,
                'poster_file' => 'storage/images/posters/matrix.jpg'
            ],
            [
                'title' => 'The Matrix',
                'is_published' => true,
                'poster_file' => 'storage/images/posters/inception.jpg'
            ],
            [
                'title' => 'Interstellar',
                'is_published' => false,
            ],
        ];

        foreach ($movies as $movie) {
            Movie::query()
                ->create($movie);
        }
    }
}

