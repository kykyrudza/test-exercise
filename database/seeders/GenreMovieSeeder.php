<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;

class GenreMovieSeeder extends Seeder
{
    public function run(): void
    {
        $genres = Genre::all();
        $movies = Movie::all();

        foreach ($movies as $movie) {
            $movie->genres()->attach($genres->random(2));
        }
    }
}
