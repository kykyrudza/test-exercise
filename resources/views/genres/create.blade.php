@extends('layout')

@section('content')
    <div class="font-sans">
        <h1 class="text-2xl font-bold text-gray-800">Create Genre</h1>
        <form action="{{ route('genres.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full">
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
