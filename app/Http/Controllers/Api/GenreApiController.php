<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreApiController extends Controller
{
    public function index(): JsonResponse
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    public function show(int $id): JsonResponse
    {
        $genre = Genre::query()->findOrFail($id);
        return response()->json($genre);
    }
}
