<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Movie Booking | CodeCinema</title>
  <link rel="stylesheet" href="{{ asset('css/styleMovie.css') }}">

</head>
<body>

<div class="container">

  <!-- LEFT : MOVIE INFO -->
  <aside class="movie-info">
    <img src="https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg" class="poster">

    <h2>Interstellar</h2>
    <p class="meta">106 minutes • PG-13</p>

    <div class="detail">
      <p><strong>Director</strong><br>Rupert Sanders</p>
      <p><strong>Genre</strong><br>Action, Sci-Fi</p>
    </div>

    <button class="play-btn">▶ Trailer</button>
  </aside>

  <!-- RIGHT : BOOKING -->
  <main class="booking">

    <!-- STEPS -->
    <div class="steps">
      <!-- <span class="active">01 Choose Movie</span> -->
      <span class="active">01 Choose Time, Date, & Seats</span>
      <span>02 Payment</span>
      <span>03 Complete</span>
    </div>

    <!-- LOCATION -->
    <br>
    <section class="mall">
  <h3>Select The Cinema Location</h3>

  <div class="mall-list">

    <div class="mall-card active">
      <span class="mall-title">Grand Indonesia</span>
      <span class="mall-city">Jakarta</span>
    </div>

    <div class="mall-card">
      <span class="mall-title">Mall Taman Anggrek</span>
      <span class="mall-city">Jakarta</span>
    </div>

    <div class="mall-card">
      <span class="mall-title">Mall Of Indonesia</span>
      <span class="mall-city">Jakarta</span>
    </div>

    <div class="mall-card">
      <span class="mall-title">Green Pramuka Mall</span>
      <span class="mall-city">Jakarta</span>
    </div>
    </form>

  </div>
  </section>


    <!-- DATE -->
    <section class="date">
      <h3>Thursday, 4 May</h3>
      <div class="days">
        <span>1</span><span>2</span><span>3</span>
        <span class="active">4</span>
        <span>5</span><span>6</span>
      </div>
    </section>

    <!-- TIME -->
    <section class="time">
      <h3>Show Time</h3>
      <div class="times">
        <button>10:00</button>
        <button>12:30</button>
        <button>15:30</button>
        <button class="active">20:00</button>
        <button>22:30</button>
      </div>
    </section>

    <!-- SCREEN -->
    <div class="screen">SCREEN</div>

    <!-- SEATS -->
    <div class="seats">
  <script>
    const rows = 8;
    // const taken = Math.random() < 16 ? 'taken' : '';

    for (let r = 0; r < rows; r++) {

      // kiri
      for (let i = 0; i < 4; i++){
          document.write('<div class="seat"></div>');
        }

      // aisle
      document.write('<div class="aisle"></div>');

      // tengah
      for (let i = 0; i < 8; i++){
          document.write('<div class="seat"></div>');
        }
          
      // aisle
      document.write('<div class="aisle"></div>');

      // kanan
      for (let i = 0; i < 4; i++){
          document.write('<div class="seat"></div>');
        }
}

  </script>
</div>

    <!-- LEGEND -->
    <div class="legend">
      <span><i class="seat"></i> Available</span>
      <span><i class="seat selected"></i> Selected</span>
      <span><i class="seat taken"></i> Taken</span>
    </div>

    <a href="#" class="continue">Continue</a>
    <a href="/home" class="back">Back</a>

  </main>
</div>

<script>
  document.querySelectorAll('.seat:not(.taken)').forEach(seat => {
    seat.addEventListener('click', () => {
      seat.classList.toggle('selected');
    });
  });
</script>

</body>
</html>
