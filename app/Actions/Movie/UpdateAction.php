<?php

namespace App\Actions\Movie;

use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UpdateAction
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function handle(MovieRequest $request, int $id): void
    {
        $service = app()->get('movieService');

        DB::beginTransaction();

        try {
            $movie = $service->getMovie($id);

            if ($request->hasFile('poster_file')) {
                $posterPath = $request->file('poster_file')
                    ->store('images/posters', 'public');

                $posterUrl = Storage::url($posterPath);

                if ($movie->poster_file) {
                    Storage::disk('public')->delete($movie->poster_file);
                }

                $data['poster_file'] = $posterUrl;
            }

            $data['title'] = $request->title;

            $service->updateMovie($id, (object) $data);

            $movie->genres()->sync($request->input('genre_ids'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            if (isset($posterPath)) {
                Storage::disk('public')->delete($posterPath);
            }

            Log::error('Error updating movie: ' . $e->getMessage());

            throw $e;
        }
    }
}
