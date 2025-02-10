<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Science Fiction'];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
