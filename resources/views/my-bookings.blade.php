<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings - CodeCinema</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styleMyBookings.css') }}">
</head>
<body>

<header class="topbar">
  <div class="logo-wrapper">
    <img src="{{ asset('foto/Logo CodeCinema.png') }}" alt="Logo" class="cinema-logo">
    <h1>CodeCinema</h1>
  </div>
  <div class="header-right">
    <span class="location">Jakarta ▼</span>
  </div>
</header>

<main class="bookings-container">
    <h2 class="text-white fw-bold mb-4">My Bookings</h2>

    <span class="label-header">Active Bookings</span>
    <a href="#" class="booking-card">
        <img src="https://i.pinimg.com/736x/03/a1/cd/03a1cd1bf9b53c5be5e904424c29a5db.jpg" class="booking-poster" alt="Exhuma">
        <div class="booking-details">
            <h5>Exhuma</h5>
            <p>📅 Jan 05, 2026 • 19:45</p>
            <p>📍 Studio 1 • B12</p>
            <div class="status-tag status-active">Active</div>
        </div>
    </a>

    <div class="mt-5">
        <span class="label-header">Booking History</span>
        <div class="booking-card" style="opacity: 0.6;">
            <img src="https://i.pinimg.com/1200x/9a/5a/b7/9a5ab7adee2fde79b08a8437204dad12.jpg" class="booking-poster" alt="Madame Web">
            <div class="booking-details">
                <h5>Madame Web</h5>
                <p>📅 Jan 01, 2026</p>
                <div class="status-tag status-past">Completed</div>
            </div>
        </div>
    </div>
</main>

<nav class="bottom-nav">
  <a href="/home">Home</a>
  <a href="/search">Search</a>
  <a href="/my-bookings" class="active">My Bookings</a>
  <a href="/profile">Profile</a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>