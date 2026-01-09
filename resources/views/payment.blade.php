<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Payment | CodeCinema</title>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<body>

<div class="wrapper">

    {{-- LEFT : ORDER SUMMARY --}}
    <div class="card summary">
        <h2>Order Summary</h2>

        <img src="{{ asset($booking['poster']) }}"
             alt="{{ $booking['movie'] }}"
             class="poster">

        <p><b>Movie:</b> {{ $booking['movie'] }}</p>
        <p><b>Date:</b> {{ $booking['date'] }}</p>
        <p><b>Show Time:</b> {{ $booking['time'] }}</p>
        <p><b>Lokasi:</b> {{ $booking['location'] }}</p>
        <p><b>Seats:</b> {{ implode(', ', $booking['seats']) }}</p>
        <p><b>Price / Seat:</b> Rp {{ number_format($booking['price']) }}</p>

        <hr>

        @php
            $total = count($booking['seats']) * $booking['price'];
        @endphp

        <p><b>Total Price:</b> Rp {{ number_format($total,0,',','.') }}</p>
    </div>

    {{-- RIGHT : PAYMENT FORM --}}
    <div class="card">
        <h2>Payment Details</h2>

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf

            {{-- REQUIRED DATA --}}
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id_jadwal }}">

            @foreach ($booking['seat_ids'] as $seat)
                <input type="hidden" name="seats[]" value="{{ $seat }}">
            @endforeach

            {{-- FULL NAME --}}
            <div class="input-group">
                <label>Full Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autocomplete="off">
            </div>

            {{-- EMAIL --}}
            <div class="input-group">
                <label>Email (Gunakan email terdaftar)</label>
                <input type="email"
                name="email"
                value="{{ old('email') }}"
                class="@error('email') is-invalid @enderror"
                required
                autocomplete="off">

                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- PAYMENT METHOD --}}
            <div class="input-group">
                <label>Payment Method</label>
                <select name="method" required>
                    <option value="">-- Select Method --</option>
                    <option value="QRIS" {{ old('method')=='QRIS' ? 'selected' : '' }}>QRIS</option>
                    <option value="Bank BCA" {{ old('method')=='Bank BCA' ? 'selected' : '' }}>Bank BCA</option>
                    <option value="Bank Mandiri" {{ old('method')=='Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                </select>
            </div>

            <button class="btn-pay" type="submit">
                Pay Now
            </button>
        </form>
    </div>

</div>

</body>
</html>