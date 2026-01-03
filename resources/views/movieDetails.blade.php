Yang ada disini kenapa lu rubah anjir jangan dirubah kan lu bilang nyangkutin ke payment kocak

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

</body>
</html>
