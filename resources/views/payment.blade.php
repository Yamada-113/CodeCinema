<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Payment | CodeCinema</title>
    <style>
        body {
            background: #090a0c;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }
        .wrapper {
            max-width: 1100px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 340px minmax(0, 1fr);
            gap: 30px;
        }
        .card {
            background: linear-gradient(
                to top,
                rgba(2, 15, 58, 0.26),
                rgb(6, 7, 10)
            );
            border-radius: 12px;
            padding: 25px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .summary p {
            margin: 8px 0;
            color: #cbd5f5;
        }
        .summary hr {
            border: 1px solid #1f2937;
            margin: 15px 0;
        }
        .total {
            font-size: 20px;
            color: #60a5fa;
        }
        label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: none;
            background: #1f2937;
            color: white;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            border: none;
            border-radius: 8px;
            background: #3b82f6;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #2563eb;
        }
        .success {
            background: #064e3b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            color: #6ee7b7;
        }
       .poster {
        width: 95%;
        border-radius: 12px;
        }
    </style>
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
