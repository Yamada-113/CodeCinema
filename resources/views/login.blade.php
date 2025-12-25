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

    <form>
      <div class="input-group">
        <input type="email" required>
        <label>Email</label>
      </div>

      <div class="input-group">
        <input type="password" required>
        <label>Password</label>
      </div>

    <a href="/home" class="login-btn">Login</a>

      <div class="extra">
        <span>Don’t have an account?</span>
        <a href="/register">Register</a>
      </div>
    </form>
  </div>

</div>

</body>
</html>
