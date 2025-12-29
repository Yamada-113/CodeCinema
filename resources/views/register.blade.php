<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register | CodeCinema</title>
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

    <form action="/register" method="POST">
      {{ csrf_field() }}
      <div class="input-group">
        <input type="text" name="nama"required>
        <label>Username</label>
      </div>

      <div class="input-group">
        <input type="email" name="email" required>
        <label>Email</label>
      </div>

      <div class="input-group">
        <input type="text" name="no_hp" required>
        <label>No.Hp</label>
      </div>

      <div class="input-group">
        <input type="password" name="password" required>
        <label>Password</label>
      </div>

    <button type="submit" class="login-btn">Register</button>

      <div class="extra">
        <span>Already have an account?</span>
        <a href="/login">Login</a>
      </div>
    </form>
  </div>

</div>

</body>
</html>
