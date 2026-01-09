<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie App - CodeCinema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
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


<div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" style="background:black">
 <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="https://web3.21cineplex.com/mobile-banner/XXI_HEADLINE%20APPS.jpg" class="d-block w-100 promo-img">
    </div>

    <div class="carousel-item">
      <img src="https://web3.21cineplex.com/mobile-banner/dusun%20mayit%20Headline%20apps_840%20x%20400%20px.jpg" class="d-block w-100 promo-img">
    </div>

    <div class="carousel-item">
      <img src="https://web3.21cineplex.com/evoucher/WA2025120917005475762151912801_banner.jpg?sn=460962021" class="d-block w-100 promo-img">
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


<section class="section">
  </section>


<section class="section">
  <h2>Now Playing</h2>
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
</section>

<section class="section">
  <h2>Coming Soon</h2>
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

    {{-- Tampilkan pesan jika tidak ada film coming soon --}}
    @if($comingSoonMovies->isEmpty())
        <p style="color: gray; margin-left: 20px;">Belum ada film yang akan datang.</p>
    @endif
  </div>
</section>

<nav class="bottom-nav">
  @if(session('role') === 'admin')
        <a href="{{ route('admin.home') }}" class="{{ request()->is('homeAdmin') ? 'active' : '' }}">Home</a>
    @else
        <a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">Home</a>
    @endif

    <a href="{{ route('movies.search') }}" class="{{ request()->is('search') ? 'active' : '' }}">Search</a>
  <a href="/profile">Profile</a>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>