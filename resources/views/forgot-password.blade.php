<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | CodeCinema</title>
    <link rel="stylesheet" href="{{ asset('css/styleLogin.css') }}">
</head>
<body>

<div class="login-container">

    <div class="login-form" style="margin:auto; max-width:400px">
        <h2>Reset Password</h2>
        <p class="subtitle">Masukkan password baru</p>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="input-group">
                <input type="email" name="email" value="{{ old('email') }}" required>
                <label>Email</label>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password Baru</label>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <input type="password" name="password_confirmation" required>
                <label>Konfirmasi Password</label>
            </div>

            <button type="submit" class="login-btn">Update Password</button>

            <div class="extra">
                <a href="/login">Kembali ke Login</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
