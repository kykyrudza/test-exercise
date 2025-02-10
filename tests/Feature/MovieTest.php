<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_movie()
    {
        Storage::fake('public');

        Genre::query()
            ->create([
                'id' => 1,
                'name' => 'Genre 1'
            ]);

        Genre::query()
            ->create([
                'id' => 2,
                'name' => 'Genre 2'
            ]);

        $file = UploadedFile::fake()->image('poster.jpg');

        $response = $this->post(route('movies.store'), [
            'title' => 'Test Movie',
            'poster_file' => $file,
            'genre_ids' => [1, 2],
        ]);

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', ['title' => 'Test Movie']);
        Storage::disk('public')->assertExists('images/posters/' . $file->hashName());
    }

    #[Test]
    public function it_can_update_a_movie(): void
    {
        Storage::fake('public');

        Genre::query()
            ->create([
                'id' => 1,
                'name' => 'Genre 1'
            ]);

        Genre::query()
            ->create([
                'id' => 2,
                'name' => 'Genre 2'
            ]);

        $movie = Movie::query()->create([
            'title' => 'Old Movie',
            'poster_file' => 'old_poster.jpg',
            'is_published' => false,
        ]);

        $file = UploadedFile::fake()->image('new_poster.jpg');

        $response = $this->put(route('movies.update', $movie->id), [
            'title' => 'Updated Movie',
            'poster_file' => $file,
            'genre_ids' => [1, 2],
        ]);

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', ['title' => 'Updated Movie']);
        Storage::disk('public')->assertExists('images/posters/' . $file->hashName());
    }

    #[Test]
    public function it_can_publish_a_movie()
    {
        $movie = Movie::query()->create([
            'title' => 'Unpublished Movie',
            'poster_file' => 'poster.jpg',
            'is_published' => false,
        ]);

        $response = $this->post(route('movies.publish', $movie->id));

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', ['id' => $movie->id, 'is_published' => true]);
    }

    #[Test]
    public function it_can_delete_a_movie()
    {
        $movie = Movie::query()->create([
            'title' => 'Movie to Delete',
            'poster_file' => 'poster.jpg',
            'is_published' => false,
        ]);

        $response = $this->delete(route('movies.destroy', $movie->id));

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }
}
