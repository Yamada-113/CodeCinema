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
      <p><strong>Description</strong><br>
      Film ini bercerita tentang sekelompok astronaut yang menuju lubang cacing (worm hole) 
      dekat Saturnus untuk mencari planet baru yang mampu merumahi manusia, ditengah era distopia. 
      Naskah aslinya ditulis Jonathan pada tahun 2007, kemudian dilanjuti Christopher dan Jonathan.
    </p>
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

    <div class="mall-card">
      <span class="mall-title">Mall Taman Anggrek</span>
      <span class="mall-city">Jakarta</span>
    </div>

    <div class="mall-card active">
      <span class="mall-title">Grand Indonesia</span>
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

<div class="calendar">
  @php
    $calendar = [
      ['day'=>'MON','date'=>1],
      ['day'=>'TUE','date'=>2],
      ['day'=>'WED','date'=>3],
      ['day'=>'THU','date'=>4],
      ['day'=>'FRI','date'=>5],
      ['day'=>'SAT','date'=>6],
      ['day'=>'SUN','date'=>7],
    ];
  @endphp

  <div class="calendar-grid">
    @foreach ($calendar as $c)
      <div class="date-box {{ $c['date'] == 4 ? 'active' : '' }}">
        <span class="day">{{ $c['day'] }}</span>
        <span class="date">{{ $c['date'] }}</span>
      </div>
    @endforeach
  </div>
</div>

    <!-- TIME -->
    <section class="time">
      <h3>Show Time</h3>
      <div class="times">
        <button>10:00 | Rp50.000</button>
        <button>12:30 | Rp50.000</button>
        <button>15:30 | Rp50.000</button>
        <button class="active">20:00 | Rp50.000</button>
        <button>22:30 | Rp65.000</button>
      </div>
    </section>

    <!-- SCREEN -->
    <div class="screen-wrapper">
      <div class="screen-curved"></div>
    </div>
    <div class="screen">SCREEN</div>

    <!-- SEATS -->
@php
$rows = 8;        //FYI: INI BLM FINAL (bakal di implementasi ulang pake DB proses random cukup 1x dan simpan)
@endphp
<!-- It's not flexible it just to make the point that it's taken reeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
<div class="seats">
@for ($r = 0; $r < $rows; $r++)

  @php
    $rowLetter = chr(65 + $r);
    $taken = collect(range(1,16))->random(rand(3,5))->toArray();
    $seat = 1;
  @endphp

  <div class="row-label">{{ $rowLetter }}</div>

  @for ($i = 0; $i < 4; $i++)
    <div class="seat {{ in_array($seat++, $taken) ? 'taken' : '' }}"></div>
  @endfor

  <div class="aisle"></div>

  @for ($i = 0; $i < 8; $i++)
    <div class="seat {{ in_array($seat++, $taken) ? 'taken' : '' }}"></div>
  @endfor

  <div class="aisle"></div>

  @for ($i = 0; $i < 4; $i++)
    <div class="seat {{ in_array($seat++, $taken) ? 'taken' : '' }}"></div>
  @endfor

  <div class="row-label">{{ $rowLetter }}</div>

@endfor
</div>

    <!-- STATUS -->
    <div class="status">
      <span><i class="seat"></i> Available</span>
      <span><i class="seat selected"></i> Selected</span>
      <span><i class="seat taken"></i> Taken</span>
    </div>

    <a href="/payment" class="continue">Continue</a>
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

//
<script>
document.querySelectorAll('.mall-card').forEach(card => {

    card.addEventListener('click', () => {

        document.querySelectorAll('.mall-card')
            .forEach(c => c.classList.remove('active'));

        card.classList.add('active');

        const location = card.getAttribute('data-location');

        document.getElementById('locationInput').value = location;

        document.getElementById('locForm').submit();
    });

});
</script>


</body>
</html>
