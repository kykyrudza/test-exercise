<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieApiController extends Controller
{
    public function index(): JsonResponse
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function show(int $id): JsonResponse
    {
        $movie = Movie::query()->findOrFail($id);
        return response()->json($movie);
    }
}
