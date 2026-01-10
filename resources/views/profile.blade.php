<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile - {{ $user->nama }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/styleProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
</head>
<body>

<main class="profile-wrapper">

    <div class="profile-desktop">

        <div class="profile-left">
            <div class="avatar">
                {{ strtoupper(substr($user->nama, 0, 1)) }}
            </div>

            <h2>{{ $user->nama }}</h2>
            <p class="email">{{ $user->email }}</p>

            <span class="account-badge">Active Account</span>
        </div>

        <div class="profile-right">
            <div class="section-header">
                <h3>Informasi Akun</h3>
                <span class="subtitle">Personal Details</span>
            </div>

            <div class="info-item">
                <span>Nama Lengkap</span>
                <strong>{{ $user->nama }}</strong>
            </div>

            <div class="info-item">
                <span>Email</span>
                <strong>{{ $user->email }}</strong>
            </div>

            <div class="info-item">
                <span>Nomor WhatsApp</span>
                <strong>{{ $user->no_hp }}</strong>
            </div>
        </div>

    </div>

</main>

{{-- NAVBAR BAWAH --}}
<nav class="bottom-nav">
    <a href="/home">Home</a>
    <a href="/search">Search</a>
    <a href="/profile" class="active">Profile</a>
</nav>

</body>
</html>
