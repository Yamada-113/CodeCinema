<!DOCTYPE html>
<html>
<head>
    <title>Booking History - CodeCinema</title>
    <link rel="stylesheet" href="{{ asset('css/styleBooking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}"> 
</head>
<body>

<div class="history-container">
    <h2>Riwayat Transaksi User</h2>

    <div class="table-card">
        <table class="cinema-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Customer</th>
                    <th>Film</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="color: #6366f1; font-weight: bold;">{{ $item->id_pembayaran }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $item->customer_name }}</div>
                        <div style="font-size: 11px; color: #94a3b8;">Ref: {{ $item->id_pembayaran }}</div>
                    </td>
                    <td>
                    <div style="font-weight: 600;">{{ $item->movie_title }}</div>
                    {{-- Menampilkan daftar kursi gabungan (Contoh: A9, A10) --}}
                    <div style="font-size: 11px; color: #94a3b8;">
                    Kursi: {{ $item->daftar_kursi ?? 'Belum pilih kursi' }}
                    </div>
                    </td>
                    <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td><span class="status-completed">Completed</span></td>
                    <td>
                        <a href="/payment/tiket/{{ $item->id_pembayaran }}" class="btn-detail">Lihat Tiket</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<nav class="bottom-nav">
    <a href="/homeAdmin">Home</a>
    <a href="/booking-history" class="active">Booking History</a>
    <a href="/profile">Profile</a>
</nav>

</body>
</html>