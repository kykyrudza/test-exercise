<?php

namespace App\Actions\Movie;

use App\Http\Requests\MovieRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CreateAction
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function handle(MovieRequest $request): void
    {
        $service = app()->get('movieService');

        DB::beginTransaction();

        try {
            $posterPath = $request->file('poster_file')
                ->store('images/posters', 'public');

            $posterUrl = Storage::url($posterPath);

            $movie = $service->createMovie([
                'title' => $request->title,
                'poster_file' => $posterUrl,
                'is_published' => false,
            ]);

            $movie->genres()->attach($request->input('genre_ids'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            if (isset($posterPath)) {
                Storage::disk('public')->delete($posterPath);
            }

            Log::error('Error creating movie: ' . $e->getMessage());

            throw $e;
        }
    }
}
