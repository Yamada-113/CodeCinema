<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie App</title>
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">

</head>
<body>

<header class="topbar">
  <h1>CodeCinema</h1>
  <span class="location">Jakarta ▼</span>
</header>

<section class="section">
  <h2>Now Playing</h2>
  <div class="movie-row">
    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg" alt="">
        <div class="movie-info">
            <p>Interstellar</p>
            <a href="/movieDetails" class="watch">Watch</a>
        </div>
    </div>
    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/96/dc/fb/96dcfbe4a7b35070f73fd81df4a8737a.jpg" alt="">
      <p>Howl Moving Castle</p>
    </div>
    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/f2/85/45/f28545a7aa8b7a65388853902d600ddf.jpg" alt="">
      <p>Us</p>
    </div>
    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/3d/5f/f7/3d5ff7aa662986869d31cba4d141dafd.jpg" alt="">
      <p>Talk To Me</p>
    </div>
  </div>
</section>

<nav class="bottom-nav">
  <a class="active">Home</a>
  <a>Movies</a>
  <a>Tickets</a>
  <a>Profile</a>
</nav>

</body>
</html>
