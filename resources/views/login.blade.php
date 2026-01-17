<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | CodeCinema</title>
  <link rel="stylesheet" href="{{ asset('css/styleLogin.css') }}">
</head>
<body>

<div class="login-container">

  <div class="login-image">
    <div class="overlay">
      <h1>CodeCinema</h1>
      <p>Book your favorite movie seats easily</p>
    </div>
  </div>

  <div class="login-form">
    <h2>Welcome Back</h2>
    <p class="subtitle">Login to continue</p>

    <form action="/login" method="POST">
      {{ csrf_field() }}
      
      <div class="input-group">
        
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Email</label>
      </div>
      
      <div class="input-group">
        <input type="password" name="password" required>
        <label>Password</label>
      </div>

      @error('login')
        <small class="error-text">{{ $message }}</small>
      @enderror

    <button type="submit" class="login-btn">Login</button>

      <div class="extra">
        <span>Don’t have an account?</span>
        <a href="/register">Register</a>
        <br>
        <a href="{{ route('password.request') }}" class="forgot-password">
          Forgot password?
        </a>
      </div>
    </form>
  </div>

</div>

</body>
</html>