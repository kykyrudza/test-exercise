<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'movies' => Movie::query()->where(['is_published' => true])->get(),
            'genres' => Genre::query()->get()
        ]);
    }
}
