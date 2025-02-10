<?php

namespace Tests\Feature\Api;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MovieApiControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_movies()
    {
        Movie::query()
            ->create([
                'title' => 'Movie 1'
            ]);

        Movie::query()
            ->create([
                'title' => 'Movie 2'
            ]);

        Movie::query()
            ->create([
                'title' => 'Movie 3'
            ]);


        $response = $this->getJson('/api/movies');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    #[Test]
    public function it_can_show_a_movie()
    {
        $movie = Movie::query()
            ->create(['title' => 'Movie 1']);

        $response = $this->getJson("/api/movies/$movie->id");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $movie->id,
                'title' => $movie->title,
            ]);
    }
}
