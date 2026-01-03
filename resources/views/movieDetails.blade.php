<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Movie Booking | CodeCinema</title>
    <link rel="stylesheet" href="{{ asset('css/styleMovie.css') }}">
</head>
<body>

<div class="container">

=
    <!-- LEFT : MOVIE INFO -->
    <aside class="movie-info">
        <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}" class="movie-poster">
  <!-- LEFT : MOVIE INFO -->
  <aside class="movie-info">
    <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}" class="movie-poster">


        <h2>{{ $movie->judul ?? '-' }}</h2>
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
            <span class="{{ $studioId && $date ? 'active' : '' }}">Tanggal</span>
            <span class="{{ $studioId && request('jam') ? 'active' : '' }}">Jam</span>
            <span class="{{ request('jam') ? 'active' : '' }}">Kursi</span>
        </div>

        <!-- LOCATION -->
        <h3>Select Cinema Location</h3>
        <div class="mall-list">
            @foreach($cinemas as $cinema)
                <a
                    href="?id_film={{ $filmId }}&id_lokasi={{ $cinema->id_lokasi }}"
                    class="mall-card {{ $cinemaId == $cinema->id_lokasi ? 'active' : '' }}">
                    <span class="mall-title">{{ $cinema->nama_lokasi }}</span>
                    <span class="mall-city">{{ $cinema->kota }}</span>
                </a>
            @endforeach
        </div>

        <!-- STUDIO -->
        <h3>Studio</h3>
        <div class="studio-list">
            @if(!$cinemaId)
                <div class="studio disabled">Pilih lokasi terlebih dahulu</div>
            @else
                @foreach($studios as $studio)
                    <a
                        href="?id_film={{ $filmId }}&id_lokasi={{ $cinemaId }}&id_studio={{ $studio->id_studio }}"
                        class="studio {{ $studioId == $studio->id_studio ? 'active' : '' }}">
                        {{ $studio->nama_studio }}
                    </a>
                @endforeach
            @endif
        </div>

        <!-- DATE (DIKUNCI SEBELUM STUDIO) -->
        <h3>Date</h3>
        <div class="calendar-grid">
            @if(!$studioId)
                @for($i=0;$i<7;$i++)
                    <div class="date-box disabled">
                        <span>--</span>
                    </div>
                @endfor
            @else
                @foreach($calendar as $c)
                    <a
                        href="?id_film={{ $filmId }}&id_lokasi={{ $cinemaId }}&id_studio={{ $studioId }}&date={{ $c['full_date'] }}"
                        class="date-box {{ $date == $c['full_date'] ? 'active' : '' }}">
                        <span class="day">{{ $c['day'] }}</span>
                        <span class="date">{{ $c['date'] }}</span>
                    </a>
                @endforeach
            @endif
        </div>

        <!-- TIME + HARGA (DIKUNCI SEBELUM STUDIO & TANGGAL) -->
        <h3>Show Time</h3>
        <div class="times">
            @if(!$studioId || !$date)
                @for($i=0;$i<4;$i++)
                    <div class="time-box disabled">--:-- | Rp---</div>
                @endfor
            @else
                @foreach($times as $t)
                    <a
                        href="?id_film={{ $filmId }}&id_lokasi={{ $cinemaId }}&id_studio={{ $studioId }}&date={{ $date }}&jam={{ $t->jam_tayang }}"
                        class="time-box {{ request('jam') == $t->jam_tayang ? 'active' : '' }}">
                        {{ $t->jam_tayang }} | Rp{{ number_format($t->harga_tiket) }}
                    </a>
                @endforeach
            @endif
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
                        <input
                            type="checkbox"
                            name="seats[]"
                            value="{{ $seat->id_kursi }}"
                            id="seat{{ $seat->id_kursi }}"
                            {{ $seat->status == 'taken' || !request('jam') ? 'disabled' : '' }}
                            hidden>

                        <label
                            for="seat{{ $seat->id_kursi }}"
                            class="seat {{ $seat->status == 'taken' ? 'taken' : '' }}">
                            {{ $row }}{{ $seat->nomor_kursi }}
                        </label>
                    @endforeach

                    <div class="row-label">{{ $row }}</div>
                @endforeach
            </div>

            @if($errors->has('seats'))
                <p style="color:red;text-align:center;font-weight:bold">
                    {{ $errors->first('seats') }}
                </p>
            @endif

            <div class="form-footer">
                <a href="/home" class="back">Back</a>
                <button type="submit" class="continue">Continue</button>
            </div>
        </form>

    </main>
</div>


    <!-- LOCATION -->
    <br>
    <section class="mall">
  <h3>Select The Cinema Location</h3>

<div class="mall-list">
  @foreach($cinemas as $cinema)
    <a
      href="?{{ http_build_query(array_filter([
          'id_film'   => $filmId,
          'id_lokasi' => $cinema->id_lokasi,
          'id_studio' => null,   // reset studio saat ganti lokasi
          'date'      => null    // reset tanggal
      ])) }}"
      class="mall-card {{ (int)$cinema->id_lokasi === (int)$cinemaId ? 'active' : '' }}">
      
      <span class="mall-title">{{ $cinema->nama_lokasi }}</span>
      <span class="mall-city">{{ $cinema->kota }}</span>
    </a>
  @endforeach
</div>

<h3>Studio</h3>

<div class="studio-wrapper">
  <div class="studio-list">

    @if(!$cinemaId)
      {{-- PLACEHOLDER --}}
      <div class="studio disabled">Regular</div>
      <div class="studio disabled">The Premiere</div>
      <div class="studio disabled">IMAX</div>

    @else
      @foreach ($studios as $studio)
        <a
          class="studio {{ $studioId == $studio->id_studio ? 'active' : '' }}"
          href="?{{ http_build_query(array_filter([
              'id_film'   => $filmId,
              'id_lokasi' => $cinemaId,
              'id_studio' => $studio->id_studio,
              'date'      => null,
              'jam'       => null
          ])) }}">
          {{ $studio->nama_studio }}
        </a>
      @endforeach
    @endif

  </div>
</div>



<h3>Date</h3>

<div class="calendar-grid">
  @forelse ($calendar as $c)
    <a
      class="date-box {{ !$studioId ? 'disabled' : '' }} {{ $date === $c['full_date'] ? 'active' : '' }}"
      href="{{ $studioId ? '?id_lokasi='.$cinemaId.'&id_studio='.$studioId.'&date='.$c['full_date'] : '#' }}">
      <span class="day">{{ $c['day'] }}</span>
      <span class="date">{{ $c['date'] }}</span>
    </a>
  @empty
    {{-- PLACEHOLDER --}}
    @for($i = 0; $i < 7; $i++)
      <div class="date-box disabled">
        <span class="day">---</span>
        <span class="date">--</span>
      </div>
    @endfor
  @endforelse
</div>



    <!-- TIME -->
<h3>Show Time</h3>

<div class="times">
  @forelse($times as $t)
    <a
      class="time-box {{ !$date ? 'disabled' : '' }} {{ request('jam') === $t->jam_tayang ? 'active' : '' }}"
      href="{{ ($studioId && $date) ? '?id_lokasi='.$cinemaId.'&id_studio='.$studioId.'&date='.$date.'&jam='.$t->jam_tayang : '#' }}">
      {{ $t->jam_tayang }} | Rp{{ number_format($t->harga_tiket) }}
    </a>
  @empty
    {{-- PLACEHOLDER --}}
    @for($i = 0; $i < 4; $i++)
      <div class="time-box disabled">--:-- | Rp---</div>
    @endfor
  @endforelse
</div>



    <!-- SCREEN -->
    <div class="screen-wrapper">
      <div class="screen-curved"></div>
    </div>
    <div class="screen">SCREEN</div>

    <!-- SEATS -->
<form action="/payment" method="POST" id="bookingForm">
   {{ csrf_field() }}
  <!-- Kirim query lain sebagai hidden -->
  <input type="hidden" name="id_lokasi" value="{{ request('id_lokasi') }}">
  <input type="hidden" name="id_studio" value="{{ request('id_studio') }}">
  <input type="hidden" name="date" value="{{ request('date') }}">
  <input type="hidden" name="jam" value="{{ request('jam') }}">

  <div class="seats {{ !request('jam') ? 'locked' : '' }}">
    @foreach($seats as $rowLetter => $rowSeats)
      @php $index = 0; @endphp

      {{-- LABEL BARIS KIRI --}}
      <div class="row-label">{{ $rowLetter }}</div>

      {{-- LEFT --}}
      @for($i = 0; $i < 4; $i++)
        @php $seat = $rowSeats[$index++] ?? null; @endphp
        @if($seat)
          @php $seatId = 'seat-'.$seat->id_kursi; @endphp
          <input type="checkbox" id="{{ $seatId }}" name="seats[]" value="{{ $seat->id_kursi }}"
                 {{ $seat->status==='taken' || !request('jam') ? 'disabled' : '' }} style="display:none;">
          <label for="{{ $seatId }}" class="seat {{ $seat->status==='taken' ? 'taken' : '' }}">
            {{ $rowLetter }}{{ $seat->nomor_kursi }}
          </label>
        @endif
      @endfor

      <div class="aisle"></div>

      {{-- CENTER --}}
      @for($i = 0; $i < 8; $i++)
        @php $seat = $rowSeats[$index++] ?? null; @endphp
        @if($seat)
          @php $seatId = 'seat-'.$seat->id_kursi; @endphp
          <input type="checkbox" id="{{ $seatId }}" name="seats[]" value="{{ $seat->id_kursi }}"
                 {{ $seat->status==='taken' || !request('jam') ? 'disabled' : '' }} style="display:none;">
          <label for="{{ $seatId }}" class="seat {{ $seat->status==='taken' ? 'taken' : '' }}">
            {{ $rowLetter }}{{ $seat->nomor_kursi }}
          </label>
        @endif
      @endfor

      <div class="aisle"></div>

      {{-- RIGHT --}}
      @for($i = 0; $i < 4; $i++)
        @php $seat = $rowSeats[$index++] ?? null; @endphp
        @if($seat)
          @php $seatId = 'seat-'.$seat->id_kursi; @endphp
          <input type="checkbox" id="{{ $seatId }}" name="seats[]" value="{{ $seat->id_kursi }}"
                 {{ $seat->status==='taken' || !request('jam') ? 'disabled' : '' }} style="display:none;">
          <label for="{{ $seatId }}" class="seat {{ $seat->status==='taken' ? 'taken' : '' }}">
            {{ $rowLetter }}{{ $seat->nomor_kursi }}
          </label>
        @endif
      @endfor

      {{-- LABEL BARIS KANAN --}}
      <div class="row-label">{{ $rowLetter }}</div>
    @endforeach
  </div>

  <!-- STATUS -->
  <div class="status">
    <span><i class="seat"></i> Available</span>
    <span><i class="seat selected"></i> Selected</span>
    <span><i class="seat taken"></i> Taken</span>
  </div>

  <div id="seatError" style="display:none; color: red; text-align: center; margin: 10px 0; font-weight: bold;">
    ⚠️ Pilih minimal 1 kursi sebelum melanjutkan!
  </div>

  <div class="form-footer">
        <a href="/home" class="back">Back</a>
        <button type="submit" class="continue">Continue</button>
  </div>
    
</form>
  </main>
</div>

<script>
  document.querySelectorAll('.seat:not(.taken)').forEach(seat => {
    seat.addEventListener('click', () => {
      seat.classList.toggle('selected');
      document.getElementById('seatError').style.display = 'none';
    });
  });

  document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const selectedSeats = document.querySelectorAll('input[name="seats[]"]:checked');
    
    if (selectedSeats.length === 0) {
      e.preventDefault();
      const errorDiv = document.getElementById('seatError');
      errorDiv.style.display = 'block';
      errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return false;
    }
  });
</script>

>>>>>>> 9699ab1767a348a6db97c3df21d22d9e1745d1f8
</body>
</html>
