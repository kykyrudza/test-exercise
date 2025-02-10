<?php

namespace App\Actions\Genre;

use App\Http\Requests\GenreRequest;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UpdateAction
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(GenreRequest $request, int $id)
    {
        $service = app()->get('genreService');

        $data = $request->all();

        return $service->updateGenre($id, (object) $data);
    }
}
