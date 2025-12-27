<!DOCTYPE html>
<html>
<head>
    <title>E-Ticket</title>
    <link rel="stylesheet" href="/css/styleTiket.css">
</head>
<body>

<div class="ticket-wrapper">

    
    <div class="ticket-card">
        
        <div class="qr-section">
            <img src="https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg" class="poster">
        </div>
        
        <div class="detail-section">
            <h2 class="title">E-Ticket</h2>

            <p class="movie">{{ $movie ?? 'Movie Title' }}</p>

            <div class="row">
                <span class="left">Date</span>
                <span class="right">{{ $date ?? '-' }}</span>
            </div>

            <div class="row">
                <span class="left">Show Time</span>
                <span class="right">{{ $time ?? '-' }}</span>
            </div>

            <div class="row">
                <span class="left">Location</span>
                <span class="right">{{ $location ?? '-' }}</span>
            </div>

            <div class="row">
                <span class="left">Seats</span>
                <span class="right">{{ $seat ?? '-' }}, {{ $seat ?? '-' }}</span>
            </div>

            <div class="row">
                <span class="left">Order Code</span>
                <span class="right">{{ $code ?? rand(10000,99999) }}</span>
            </div>

            <br>
            <div class="qr-ticket">
                <img 
                    class="qr-img"
                    src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ $code ?? 'TICKET' }}"
                >
            </div>

        </div>

    </div>

</div>

</body>
</html>
