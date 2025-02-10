@extends('layout')

@section('content')
    <div class="font-sans">
        <h1 class="text-2xl font-bold text-gray-800">Movies</h1>
        <div class="flex flex-wrap gap-4">
            @foreach($movies as $movie)
                <div class="border border-gray-300 p-4 w-48 h-96 flex flex-col justify-between">
                    <div>
                        <a href="{{ route('movies.show', $movie->id) }}" class="block">
                            <h2 class="text-lg font-semibold">{{ $movie->title }}</h2>
                            <img src="{{ $movie->poster_file }}" alt="{{ $movie->title }}" class="w-full h-auto">
                        </a>
                        @if (!$movie->is_published)
                            <form action="{{ route('movies.publish', $movie->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white p-2 w-full">Publish</button>
                            </form>
                        @endif
                    </div>
                    <a href="{{ route('movies.edit', $movie->id) }}" class="bg-blue-500 text-center text-white p-2 w-full mt-2">Edit Movie</a>
                </div>
            @endforeach
        </div>
        <a href="{{ route('movies.create') }}" class="text-blue-500 hover:underline mt-4 block">Create New Movie</a>
    </div>
@endsection
