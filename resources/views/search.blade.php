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
  @else
    <div class="text-center py-5">
      <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Not Found" style="width: 80px; opacity: 0.5;">
      <h5 class="text-white mt-3">Maaf, film tidak ditemukan</h5>
      <a href="/search" class="btn btn-outline-danger btn-sm">Reset Pencarian</a>
    </div>
  @endif
  </section>

@if(!request('query') && !request('genre'))
<section class="section">
  <h2>Coming Soon</h2>
  <div class="movie-row">
    <div class="movie-card coming">
      <img src="https://i.pinimg.com/1200x/e2/4f/47/e24f47ae328185e4fe30b80ca9e4650d.jpg" alt="Little Women">
      <div class="movie-info">
        <p class="title">Little Women</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/e9/0e/77/e90e77db90e904c3cfc9adffc37619e6.jpg" alt="Archer">
      <div class="movie-info">
        <p class="title">Archer</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/1200x/9a/5a/b7/9a5ab7adee2fde79b08a8437204dad12.jpg" alt="Madame Web">
      <div class="movie-info">
        <p class="title">Madame Web</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/a1/55/ed/a155ed481d21f0537fcbb5fb63e5dbb5.jpg" alt="Paddington in Peru">
      <div class="movie-info">
        <p class="title">Paddington in Peru</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/03/a1/cd/03a1cd1bf9b53c5be5e904424c29a5db.jpg" alt="Exhuma">
      <div class="movie-info">
        <p class="title">Exhuma</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/1200x/93/a6/f6/93a6f6f6e2fc495899c5ad23ded29aa1.jpg" alt="Satria Dewa Gatotkaca">
      <div class="movie-info">
        <p class="title">Satria Dewa Gatotkaca</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/c2/89/c2/c289c2d3ced72a5088c1e0bcc2ba9c68.jpg" alt="Sosok Ketiga Lintrik">
      <div class="movie-info">
        <p class="title">Sosok Ketiga Lintrik</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
      </div>
    </div>


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