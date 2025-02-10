<?php

namespace App\Actions\Genre;

use App\Http\Requests\GenreRequest;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CreateAction
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(GenreRequest $request): void
    {
        $service = app()->get('genreService');

        $service->createGenre([
            'name' => $request->name,
        ]);
    }
}
