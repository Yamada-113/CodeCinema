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
        <img src="https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg" class="poster">
        <p><b>Movie:</b> {{ $booking['movie'] }}</p>
        <p><b>Date:</b> {{ $booking['date'] }}</p>
        <p><b>Show Time:</b> {{ $booking['time'] }}</p>
        <p><strong>Lokasi:</strong> {{ session('location', '-') }}</p>
        <p><b>Seats:</b> {{ implode(', ', $booking['seats']) }}</p>
        <p><b>Price / Seat:</b> Rp {{ number_format($booking['price']) }}</p>

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

        <form method="POST" action="/payment/process">
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
