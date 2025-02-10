<?php

namespace App\Providers;

use App\Services\GenreService;
use App\Services\MovieService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('genreService', function (){
            return new GenreService;
        });
        $this->app->singleton('movieService', function () {
            return new MovieService();
        });
    }
    public function boot(): void
    {
        //
    }
}
