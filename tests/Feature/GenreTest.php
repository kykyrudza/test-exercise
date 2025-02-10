<?php

namespace Tests\Feature;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_an_genre()
    {
        $data = [
            'name' => 'Test Name',
        ];

        $response = $this->post(route('genres.store'), $data);

        $response->assertRedirect(route('genres.index'));

        $this->assertDatabaseHas('genres', $data);
    }

    #[Test]
    public function it_can_update_an_genre()
    {

        $genre = Genre::query()->create(['name' => 'Old Name']);

        $data = [
            'name' => 'New Name',
        ];

        $response = $this->put(route('genres.update', $genre), $data);

        $response->assertRedirect(route('genres.index'));

        $this->assertDatabaseHas('genres', $data);

    }

    #[Test]
    public function it_can_delete_an_genre()
    {
        $genre = Genre::query()->create(['name' => 'Delete Name']);

        $response = $this->delete(route('genres.destroy', $genre));

        $response->assertRedirect(route('genres.index'));

        $this->assertDatabaseMissing('genres',['id' => $genre->id]);
    }
}
