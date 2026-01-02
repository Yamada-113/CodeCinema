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
    <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}" class="movie-poster">
    <h2>{{ $movie->judul ?? 'Unknown' }}</h2>
    <p class="meta">{{ $movie->durasi ?? '-' }} minutes • {{ $movie->rating ?? '-' }}</p>

    <div class="detail">
      <p><strong>Director</strong><br>{{ $movie->direktor ?? '-' }}</p>
      <p><strong>Genre</strong><br>{{ $movie->genre ?? '-' }}</p>
      <p><strong>Description</strong><br>{{ $movie->deskripsi ?? '-' }}</p>
    </div>
  </aside>

  <!-- RIGHT : BOOKING -->
  <main class="booking">

    <!-- STEPS -->
    <div class="steps">
      <span class="{{ $cinemaId ? 'active' : '' }}">Lokasi</span>
      <span class="{{ $studioId ? 'active' : '' }}">Studio</span>
      <span class="{{ $date ? 'active' : '' }}">Tanggal</span>
      <span class="{{ request('jam') ? 'active' : '' }}">Jam</span>
      <span class="{{ !empty($seats) ? 'active' : '' }}">Kursi</span>
    </div>

    <!-- LOCATION -->
    <h3>Select The Cinema Location</h3>
    <div class="mall-list">
      @foreach($cinemas as $cinema)
        <a href="?id_film={{ $filmId }}&id_lokasi={{ $cinema->id_lokasi }}"
           class="mall-card {{ $cinemaId == $cinema->id_lokasi ? 'active' : '' }}">
          <span class="mall-title">{{ $cinema->nama_lokasi }}</span>
          <span class="mall-city">{{ $cinema->kota }}</span>
        </a>
      @endforeach
    </div>

    <!-- STUDIO -->
    <h3>Studio</h3>
    <div class="studio-list">
      @foreach($studios as $studio)
        <a class="studio {{ $studioId == $studio->id_studio ? 'active' : '' }}"
           href="?id_film={{ $filmId }}&id_lokasi={{ $cinemaId }}&id_studio={{ $studio->id_studio }}">
          {{ $studio->nama_studio }}
        </a>
      @endforeach
    </div>

    <!-- DATE -->
    <h3>Date</h3>
    <div class="calendar-grid">
      @foreach ($calendar as $c)
        <a class="date-box {{ $date === $c['full_date'] ? 'active' : '' }}"
           href="?id_lokasi={{ $cinemaId }}&id_studio={{ $studioId }}&date={{ $c['full_date'] }}">
          <span class="day">{{ $c['day'] }}</span>
          <span class="date">{{ $c['date'] }}</span>
        </a>
      @endforeach
    </div>

    <!-- TIME -->
    <h3>Show Time</h3>
    <div class="times">
      @foreach($times as $t)
        <a class="time-box {{ request('jam') === $t->jam_tayang ? 'active' : '' }}"
           href="?id_lokasi={{ $cinemaId }}&id_studio={{ $studioId }}&date={{ $date }}&jam={{ $t->jam_tayang }}">
          {{ $t->jam_tayang }} | Rp{{ number_format($t->harga_tiket) }}
        </a>
      @endforeach
    </div>

    <!-- SCREEN -->
    <div class="screen">SCREEN</div>

    <!-- SEATS -->
    <form action="/payment" method="POST">
      @csrf

      <input type="hidden" name="id_lokasi" value="{{ request('id_lokasi') }}">
      <input type="hidden" name="id_studio" value="{{ request('id_studio') }}">
      <input type="hidden" name="date" value="{{ request('date') }}">
      <input type="hidden" name="jam" value="{{ request('jam') }}">

      <div class="seats {{ !request('jam') ? 'locked' : '' }}">
        @foreach($seats as $row => $rowSeats)
          <div class="row-label">{{ $row }}</div>
          @foreach($rowSeats as $seat)
            <input type="checkbox"
                   id="seat-{{ $seat->id_kursi }}"
                   name="seats[]"
                   value="{{ $seat->id_kursi }}"
                   {{ $seat->status === 'taken' ? 'disabled' : '' }}
                   hidden>
            <label for="seat-{{ $seat->id_kursi }}"
                   class="seat {{ $seat->status === 'taken' ? 'taken' : '' }}">
              {{ $row }}{{ $seat->nomor_kursi }}
            </label>
          @endforeach
        @endforeach
      </div>

      <!-- ERROR -->
      @if ($errors->has('seats'))
        <div style="color:red; margin:10px 0;">
          {{ $errors->first('seats') }}
        </div>
      @endif

      <div class="form-footer">
        <a href="/home" class="back">Back</a>
        <button type="submit"
                class="continue"
                {{ !request('jam') ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}>
          Continue
        </button>
      </div>

    </form>

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
