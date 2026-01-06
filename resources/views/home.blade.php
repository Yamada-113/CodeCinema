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