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

        <img src="{{ $booking['poster'] }}" class="poster" alt="{{ $booking['movie'] }}">

        <p><b>Movie:</b> {{ $booking['movie'] ?? '-' }}
        <p><b>Date:</b> {{ $booking['date'] }}</p>
        <p><b>Show Time:</b> {{ $booking['time'] }}</p>
        <p><strong>Lokasi:</strong> {{ $booking['location'] }}</p>
        <p><b>Seats:</b> {{ implode(', ', $booking['seats'] ?? []) }}
        <p><b>Price / Seat:</b> Rp {{ number_format($booking['price']) }}</p>

        <hr style="border: 1px solid #777; margin: 8px 0;">

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

            {{-- hidden --}}
            <input type="hidden" name="id_jadwal" value="{{ $booking['id_jadwal'] }}">

            @foreach($booking['seat_ids'] as $sid)
                <input type="hidden" name="seats[]" value="{{ $sid }}">
            @endforeach

            {{-- FULL NAME --}}
            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            {{-- EMAIL --}}
            <div class="input-group">
                <label>Email (Gunakan email terdaftar)</label>

                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror"
                    required
                >

                @if(session('error'))
                    <div class="alert-error">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

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
