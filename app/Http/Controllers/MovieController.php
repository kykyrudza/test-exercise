<?php

namespace App\Http\Controllers;

use App\Actions\Movie\CreateAction;
use App\Actions\Movie\UpdateAction;
use App\Actions\Movie\PublishAction;
use App\Http\Requests\MovieRequest;
use App\Models\Genre;
use App\Services\MovieService;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MovieController extends Controller
{
    private MovieService $service;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct()
    {
        $this->service = app()->get('movieService');
    }

    public function index()
    {
        return view('movies.index', [
            'movies' => $this->service->getAllMovie(),
        ]);
    }

    public function create()
    {
        return view('movies.create', [
            'genres' => Genre::query()->get()
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function store(MovieRequest $request, CreateAction $action)
    {
        $request->validated();

        try {
            $action->handle($request);

            return redirect()->route('movies.index');
        } catch (Exception $e) {
            if (config('app.debug')) {
                throw new Exception($e->getMessage(), $e->getCode());
            } else {
                abort(500, 'Something went wrong');
            }
        }
    }

    public function show(string $id)
    {
        return view('movies.show', [
            'movie' => $this->service->getMovie($id)
        ]);
    }

    public function edit(string $id)
    {
        return view('movies.edit', [
            'movie' => $this->service->getMovie($id),
            'genres' => Genre::query()->get()
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function update(MovieRequest $request, string $id, UpdateAction $action)
    {
        $request->validated();

        try {
            $action->handle($request, $id);

            return redirect()->route('movies.index');
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
        $this->service->deleteMovie($id);

        return redirect()->route('movies.index');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function publish(string $id, PublishAction $action)
    {
        try {
            $action->handle($id);

            return redirect()->route('movies.index');
        } catch (Exception $e) {
            if (config('app.debug')) {
                throw new Exception($e->getMessage(), $e->getCode());
            } else {
                abort(500, 'Something went wrong');
            }
        }
    }
}
