@extends('layout')

@section('content')
    <div class="font-sans">
        <div class="grid grid-cols-4 gap-8">
            <div class="col-span-3">
                <h1 class="text-2xl font-bold text-gray-800">Movies</h1>
                <div class="flex flex-wrap gap-4">
                    @foreach($movies as $movie)
                        <a href="{{ route('movies.show', $movie->id) }}" class="border border-gray-300 p-4 w-48 min-h-96 block">
                            <h2 class="text-lg font-semibold">{{ $movie->title }}</h2>
                            <img src="{{ asset($movie->poster_file) }}" alt="{{ $movie->title }}" class="w-full h-auto">
                        </a>
                    @endforeach
                </div>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Genres</h1>
                <ul class="list-none p-0">
                    @foreach($genres as $genre)
                        <li class="py-1">
                            <a href="{{ route('genres.edit', $genre->id) }}">{{ $genre->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
