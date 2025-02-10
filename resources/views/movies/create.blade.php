@extends('layout')

@section('content')
    <div class="font-sans">
        <h1 class="text-2xl font-bold text-gray-800">Create Movie</h1>
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="border border-gray-300 p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="poster_file" class="block text-gray-700">Poster</label>
                <input type="file" name="poster_file" id="poster_file" class="border border-gray-300 p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="genre_id" class="block text-gray-700">Genre</label>
                <select name="genre_id" id="genre_id" class="border border-gray-300 p-2 w-full">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2">Create</button>
        </form>
        @if ($errors->any())
            <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
@endsection
