<!DOCTYPE html>
<html>
<head>
    <title>E-Ticket</title>
    <link rel="stylesheet" href="/css/styleTiket.css">
</head>
<body>

<div class="ticket-container">

    <div class="ticket">

    <div 
        class="ticket-poster"
        style="background-image: url('{{ $ticket->poster_film ?? 'https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg' }}')"
    ></div>

        <div class="ticket-info">
            <h1 class="movie-title">{{ $ticket->judul }}</h1>

            <div class="info-row">
                <span>Date:</span>
                <strong>{{ $ticket->tanggal }}</strong>
            </div>

            <div class="info-row">
                <span>Time:</span>
                <strong>{{ $ticket->jam_tayang }}</strong>
            </div>

            <div class="info-row">
                <span>Location:</span>
                <strong>{{ $ticket->nama_lokasi }}</strong>
            </div>

            <div class="info-row">
                <span>Studio:</span>
                <strong>{{ $ticket->nama_studio }}</strong>
            </div>

        <div class="info-row">
            <span>Seats:</span>
            <strong>
                {{ implode(', ', $seats) }}
            </strong>
        </div>

            <div class="order-code">
                ORDER CODE<br>
                <strong>{{ $ticket->id_pembayaran }}</strong>
            </div>
        </div>

        <div class="perforation"></div>

        <div class="ticket-qr">
            <img 
                src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ $ticket->id_pembayaran }}"
                alt="QR Code">

            <p>Scan at entrance</p>
        </div>

    </div>
    <div class="back-home">
    <a href="{{ session('role') === 'admin' 
            ? route('admin.booking.history') 
            : url('/home') }}" 
        class="btn-home">
        Kembali
    </a>
    </div>
    
</div>

</body>
</html>
