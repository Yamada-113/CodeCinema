<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search - CodeCinema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/stylSearch.css') }}">
</head>
<body>

<header class="topbar">
  <div class="logo-wrapper">
    <img src="{{ asset('foto/Logo CodeCinema.png') }}" alt="Logo" class="cinema-logo">
    <h1>CodeCinema</h1>
  </div>
  <div class="header-right">
    <a href="/login" class="btn-logout">Logout</a>
    <span class="location">Jakarta ▼</span>
  </div>
</header>

<section class="section">
  <h2 class="px-3">Explore Movies</h2>
  
  <div class="filter-container px-3 mb-4">
    <form action="/search" method="GET">
      <input type="text" name="query" class="form-control bg-dark text-white mb-3 shadow-none" 
             placeholder="Search movies..." value="{{ request('query') }}" autocomplete="off">
    </form>
    
    <div class="d-flex gap-2 overflow-auto py-2" style="scrollbar-width: none;">
        <a href="/search" class="text-decoration-none">
          <span class="badge rounded-pill {{ !request('genre') ? 'bg-danger' : 'bg-secondary' }}">All</span>
        </a>
        <a href="/search?genre=Action" class="text-decoration-none">
          <span class="badge rounded-pill {{ request('genre') == 'Action' ? 'bg-danger' : 'bg-secondary' }}">Action</span>
        </a>
        <a href="/search?genre=Horror" class="text-decoration-none">
          <span class="badge rounded-pill {{ request('genre') == 'Horror' ? 'bg-danger' : 'bg-secondary' }}">Horror</span>
        </a>
        <a href="/search?genre=Comedy" class="text-decoration-none">
          <span class="badge rounded-pill {{ request('genre') == 'Comedy' ? 'bg-danger' : 'bg-secondary' }}">Comedy</span>
        </a>
        <a href="/search?genre=Romance" class="text-decoration-none">
          <span class="badge rounded-pill {{ request('genre') == 'Romance' ? 'bg-danger' : 'bg-secondary' }}">Romance</span>
        </a>
    </div>
  </div>

  {{-- Bagian Now Playing (Hasil Search) --}}
@if($movies->count() > 0)
    <h2 class="px-3">Now Playing</h2>
    <div class="movie-row">
        @foreach($movies as $movie)
            <div class="movie-card">
                <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}">
                <div class="movie-info">
                    <p class="title">{{ $movie->judul }}</p>
                    <div class="meta">
                        <span class="age">{{ $movie->rating }}</span>
                        <span class="duration">{{ $movie->durasi }} min</span>
                    </div>
                    <a href="{{ route('movie.details', $movie->id_film) }}" class="watch">Watch</a>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- Bagian Coming Soon (Hasil Search atau Default) --}}
@if($comingSoonMovies->count() > 0)
<section class="section">
    <h2 class="px-3">Coming Soon</h2>
    <div class="movie-row">
        @foreach($comingSoonMovies as $movie)
        <div class="movie-card coming">
            <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}">
            <div class="movie-info">
                <p class="title">{{ $movie->judul }}</p>
                <div class="meta">
                    <span class="age">{{ $movie->rating }}</span>
                    <span class="duration">{{ $movie->durasi }} min</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<nav class="bottom-nav">
  <a href="/home">Home</a>
  <a href="/Search" class="active">Search</a>
  <a href="/profile">Profile</a>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>