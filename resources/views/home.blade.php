<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie App</title>
  <link rel="stylesheet" href="/css/app.css">
  
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', sans-serif;
}

body {
  background: #0f1115;
  color: #fff;
  padding-bottom: 70px;
}

.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  background: #0f1115;
  position: sticky;
  top: 0;
}

.topbar h1 {
  font-size: 20px;
  color: #4f7cff;
}

.location {
  font-size: 14px;
  color: #9aa0aa;
}

.section {
  padding: 16px;
}

.section h2 {
  margin-bottom: 12px;
  font-size: 18px;
}

.movie-row {
  display: flex;
  gap: 12px;
  overflow-x: auto;
}

.movie-card {
  min-width: 140px;
  background: #181b22;
  border-radius: 12px;
  padding: 8px;
}

.movie-card img {
  width: 100%;
  height: 90%;
  border-radius: 8px;
}

.movie-card p {
  margin-top: 8px;
  font-size: 14px;
  text-align: center;
}

.bottom-nav {
  position: fixed;
  bottom: 0;
  width: 100%;
  background: #181b22;
  display: flex;
  justify-content: space-around;
  padding: 12px 0;
}

.bottom-nav a {
  font-size: 12px;
  color: #9aa0aa;
}

.bottom-nav .active {
  color: #4f7cff;
}

  </style>
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
      <p>Interstellar</p>
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
    <!-- <div class="movie-card">
      <img src="https://i.pinimg.com/736x/93/a3/1e/93a31e6fe85919268c1481428e2793a3.jpg" alt="">
      <p>I See You</p>
    </div> -->
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
