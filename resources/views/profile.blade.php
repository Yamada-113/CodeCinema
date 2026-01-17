@php
    // Tentukan nama yang ditampilkan (admin & user aman)
    $displayName = $user->nama
        ?? $user->nama_lengkap
        ?? $user->name
        ?? 'User';

    // Ambil huruf pertama untuk avatar
    $initial = strtoupper(substr($displayName, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile - {{ $displayName }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/styleProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
</head>
<body>

<main class="profile-wrapper">

    <div class="profile-desktop">

        {{-- BAGIAN KIRI --}}
        <div class="profile-left">
            <div class="avatar">
                {{ $initial }}
            </div>

            <h2>{{ $displayName }}</h2>
            <p class="email">{{ $user->email }}</p>

            <span class="account-badge {{ $user->role === 'admin' ? 'admin' : 'user' }}">
                {{ $user->role === 'admin' ? 'Admin Account' : 'Active Account' }}
            </span>
        </div>

        {{-- BAGIAN KANAN --}}
        <div class="profile-right">
            <div class="section-header">
                <h3>Informasi Akun</h3>
                <span class="subtitle">Personal Details</span>
            </div>

            <div class="info-item">
                <span>Nama Lengkap</span>
                <strong>{{ $displayName }}</strong>
            </div>

            <div class="info-item">
                <span>Email</span>
                <strong>{{ $user->email }}</strong>
            </div>

            <div class="info-item">
                <span>Nomor WhatsApp</span>
                <strong>{{ $user->no_hp ?? '-' }}</strong>
            </div>
        </div>

    </div>

</main>

{{-- NAVBAR BAWAH --}}
<nav class="bottom-nav">
  @if(session('role') === 'admin')
    <a href="/homeAdmin">Home</a>
    <a href="/booking-history">Booking History</a> 
  @else
    <a href="/home">Home</a>
    <a href="/search">Search</a>
  @endif
  <a href="/profile" class="active">Profile</a>

</body>
</html>