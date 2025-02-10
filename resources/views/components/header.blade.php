<header class="h-20 border-b">
    <div class="h-full flex justify-between items-center max-w-screen-xl mx-auto">
        <a href="{{ route('home') }}">
            Home
        </a>
       <div class="flex items-center justify-between gap-6">
           <a href="{{ route('movies.index') }}">
               All Movies
           </a>
           <a href="{{ route('movies.create') }}">
               Create Movie
           </a>
           <a href="{{ route('genres.create') }}">
               Create Genre
           </a>
       </div>
    </div>
</header>
