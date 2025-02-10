<?php

namespace App\Http\Controllers;

use App\Actions\Genre\CreateAction;
use App\Actions\Genre\UpdateAction;
use App\Http\Requests\GenreRequest;
use App\Services\GenreService;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GenreController extends Controller
{

    private GenreService $service;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct()
    {
        $this->service = app()->get('genreService');
    }

    public function create()
    {
        return view('genres.create');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function store(GenreRequest $request, CreateAction $action)
    {
        $request->validated();

        try {
            $action->handle($request);

            return redirect()->route('home');
        }catch (Exception $e){
            if (config('app.debug')) {
                throw new Exception($e->getMessage(), $e->getCode());
            } else {
                abort(500, 'Something went wrong');
            }
        }
    }

    public function edit(string $id)
    {
        return view('genres.edit', [
           'genre' => $this->service->getGenre($id)
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function update(GenreRequest $request, string $id, UpdateAction $action)
    {
        $request->validated();

        try {
            $action->handle($request, $id);

            return redirect()->route('home');
        } catch (Exception $e) {
            if (config('app.debug')) {
                throw new Exception($e->getMessage(), $e->getCode());
            } else {
                abort(500, 'Something went wrong');
            }
        }
    }

    public function destroy(string $id)
    {
        $this->service->deleteGenre($id);

        return redirect()->route('home');
    }
}
