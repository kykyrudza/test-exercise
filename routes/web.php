<?php

use App\Http\Controllers\Api\GenreApiController;
use App\Http\Controllers\Api\MovieApiController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('genres', GenreController::class)->except(['show', 'index']);
Route::resource('movies', MovieController::class);

Route::post('movies/{id}/publish', [MovieController::class, 'publish'])
    ->name('movies.publish');

Route::prefix('api')->group(function () {
    Route::get('genres', [GenreApiController::class, 'index']);
    Route::get('genres/{id}', [GenreApiController::class, 'show']);
    Route::get('movies', [MovieApiController::class, 'index']);
    Route::get('movies/{id}', [MovieApiController::class, 'show']);
});
