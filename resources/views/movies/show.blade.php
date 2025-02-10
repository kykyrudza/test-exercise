@extends('layout')

@section('content')
    <div class="font-sans">
        <h1 class="text-2xl font-bold text-gray-800">{{ $movie->title }}</h1>
        <img src="{{ asset($movie->poster_file) }}" alt="{{ $movie->title }}" class="w-40 h-auto">
    </div>
@endsection
