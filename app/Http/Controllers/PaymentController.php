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
    <img src="{{ $movie->poster ?? 'https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg' }}" class="poster">
    <p><b>Movie:</b> {{ $booking['movie'] }}</p>
    <p><b>Date:</b> {{ $booking['date'] }}</p>
    <p><b>Show Time:</b> {{ $booking['time'] }}</p>
    <p><strong>Lokasi:</strong> {{ $booking['location'] }}</p>
    <p><b>Seats:</b> {{ implode(', ', $booking['seats']) }}</p>
    <p><b>Price / Seat:</b> Rp {{ number_format($booking['price']) }}</p>
    <p><b>Total Price:</b> Rp {{ number_format($booking['price'] * count($booking['seats'])) }}</p>


        <hr>
        <p class="total">
            Total:
            Rp {{ number_format(count($booking['seats']) * $booking['price']) }}
        </p>
    </div>

    {{-- RIGHT : PAYMENT FORM --}}
    <div class="card">
        <h2>Payment Details</h2>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

    <form method="POST" action="/payment/processPayment">
        <input type="hidden" name="film_id" value="{{ $booking['id_film'] }}">
        <input type="hidden" name="id_jadwal" value="{{ $jadwal->id_jadwal }}">
        <input type="hidden" name="studio_id" value="{{ $booking['id_studio'] }}">
        <input type="hidden" name="date" value="{{ $booking['date'] }}">
        <input type="hidden" name="time" value="{{ $booking['time'] }}">

        @foreach($booking['seat_ids'] as $seatId)
            <input type="hidden" name="seats[]" value="{{ $seatId }}">
        @endforeach
        
        @csrf
    
    <label>Full Name</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Payment Method</label>
    <select name="method" required>
        <option value="">-- Select Method --</option>
        <option>QRIS</option>
        <option>Bank BCA</option>
        <option>Bank Mandiri</option>
    </select>

    <button type="submit">Pay Now</button>
</form>

    </div>

</div>

</body>
</html>