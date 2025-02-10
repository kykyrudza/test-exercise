<?php

namespace Tests\Feature\Api;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenreApiControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_genres()
    {
        Genre::query()
            ->create([
                'name' => 'Genre 1'
            ]);
        Genre::query()
            ->create([
                'name' => 'Genre 2'
            ]);
        Genre::query()
            ->create([
                'name' => 'Genre 3'
            ]);

        $response = $this->getJson('/api/genres');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    #[Test]
    public function it_can_show_a_genre()
    {
        $genre = Genre::query()
            ->create([
                'name' => 'Genre 1'
            ]);

        $response = $this->getJson("/api/genres/$genre->id");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $genre->id,
                'name' => $genre->name,
            ]);
    }
}
