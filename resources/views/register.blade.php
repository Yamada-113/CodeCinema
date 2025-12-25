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
    <h2>Welcome to CodeCinema</h2>
    <p class="subtitle">Register to have a full experience</p>

    <form>
      <div class="input-group">
        <input type="text" required>
        <label>Username</label>
      </div>

      <div class="input-group">
        <input type="email" required>
        <label>Email</label>
      </div>

      <div class="input-group">
        <input type="password" required>
        <label>Password</label>
      </div>

    <a href="/home" class="login-btn">Register</a>

      <div class="extra">
        <span>Already have an account?</span>
        <a href="/login">Login</a>
      </div>
    </form>
  </div>

</div>

</body>
</html>
