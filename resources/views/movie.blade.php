<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Movie Booking | CodeCinema</title>
  <link rel="stylesheet" href="/css/seat.css">

<style>
body {
  margin: 0;
  background: #0f1115;
  color: #fff;
  font-family: 'Segoe UI', sans-serif;
}

.container {
  display: flex;
  max-width: 1300px;
  margin: 40px auto;
  gap: 32px;
}

/* LEFT */
.movie-info {
  width: 280px;
  background: #181b22;
  padding: 20px;
  border-radius: 16px;
}

.poster {
  width: 100%;
  border-radius: 12px;
}

.meta {
  color: #9aa0aa;
  font-size: 14px;
}

.play-btn {
  width: 100%;
  margin-top: 16px;
  padding: 10px;
  background: #4f7cff;
  border: none;
  border-radius: 10px;
  color: white;
}

/* RIGHT */
.booking {
  flex: 1;
  background: #181b22;
  padding: 24px;
  border-radius: 16px;
}

.steps {
  display: flex;
  gap: 20px;
  font-size: 12px;
  color: #777;
}

.steps .active {
  color: #4f7cff;
}

/* DATE & TIME */
.days span,
.times button {
  margin: 6px;
  padding: 10px 14px;
  border-radius: 8px;
  background: #0f1115;
  border: none;
  color: #aaa;
}

.active {
  background: #4f7cff !important;
  color: #fff !important;
  border-radius: 8px;
}

/* SCREEN */
.screen {
  text-align: center;
  margin: 24px 0;
  letter-spacing: 4px;
  color: #777;
}

/* SEATS */
.seats {
  display: grid;
  grid-template-columns:
    repeat(4, 26px)
    40px
    repeat(8, 26px)
    40px
    repeat(4, 26px);
  gap: 12px;
  justify-content: center;
}

.seat {
  width: 26px;
  height: 26px;
  background: #2a2e38;
  border-radius: 6px;
  transition: 0.2s;
}

.seat:hover:not(.taken) {
  background: #3a3f4f;
}

.seat.selected {
  background: #4f7cff;
}

.seat.taken {
  background: #ff6b6b;
}

.aisle {
  width: 40px;
  height: 26px;
}

/* LEGEND */
.legend {
  display: flex;
  gap: 20px;
  margin: 16px 0;
  font-size: 13px;
  color: #aaa;
}

.legend i {
  display: inline-block;
  width: 14px;
  height: 14px;
  margin-right: 6px;
}

/* BUTTON */
.next {
  float: right;
  padding: 12px 20px;
  background: #4f7cff;
  border: none;
  border-radius: 10px;
  color: #fff;
}

.back {
  float: left;
  padding: 12px 20px;
  background: #4f7cff;
  border: none;
  border-radius: 10px;
  color: #fff;
}

  </style>

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

    <button class="next">Continue</button>
    <button class="back">Back</button>

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
