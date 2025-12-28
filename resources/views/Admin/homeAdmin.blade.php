<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie App - CodeCinema</title>
  <link rel="stylesheet" href="{{ asset('css/styleHomeAdmin.css') }}">
</head>
<body>

<header class="topbar">
  <h1>CodeCinema</h1>
  <div class="header-right">
    <a href="/login" class="btn-logout">Logout</a>
    <span class="location">Jakarta ▼</span>
  </div>
</header>

<section class="section">
  <h2>Now Playing</h2>
  <section class="section admin-controls">
    <button class="btn-primary" onclick="openModal('add')">+ Add New Movie</button>
</section>

  <div class="movie-row">
    
    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/f0/0e/f4/f00ef4ef28062a3ffe32c80cfa039c86.jpg" alt="Interstellar">
      <div class="movie-info">
        <p class="title">Interstellar</p>
        <div class="meta">
          <span class="age">13+</span>
          <span class="duration">169 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/96/dc/fb/96dcfbe4a7b35070f73fd81df4a8737a.jpg" alt="Howl Moving Castle">
      <div class="movie-info">
        <p class="title">Howl Moving Castle</p>
        <div class="meta">
          <span class="age">7+</span>
          <span class="duration">119 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/f2/85/45/f28545a7aa8b7a65388853902d600ddf.jpg" alt="Us">
      <div class="movie-info">
        <p class="title">Us</p>
        <div class="meta">
          <span class="age">17+</span>
          <span class="duration">116 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/3d/5f/f7/3d5ff7aa662986869d31cba4d141dafd.jpg" alt="Talk To Me">
      <div class="movie-info">
        <p class="title">Talk To Me</p>
        <div class="meta">
          <span class="age">17+</span>
          <span class="duration">95 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/c7/56/8b/c7568bd112255cab2a581a53893d613b.jpg" alt="Dear Zindagi">
      <div class="movie-info">
        <p class="title">Dear Zindagi</p>
        <div class="meta">
          <span class="age">17+</span>
          <span class="duration">95 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/20/d1/35/20d135bac134cc0ea741de4afabec9cd.jpg" alt="Zero">
      <div class="movie-info">
        <p class="title">Zero</p>
        <div class="meta">
          <span class="age">17+</span>
          <span class="duration">95 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <img src="https://i.pinimg.com/1200x/11/d4/3b/11d43b2bf9559d162af8fe36663c770a.jpg" alt="Sumala">
      <div class="movie-info">
        <p class="title">Sumala</p>
        <div class="meta">
          <span class="age">17+</span>
          <span class="duration">95 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

  </div>
</section>

<section class="section">
  <h2>Coming Soon</h2>
  <section class="section admin-controls">
    <button class="btn-primary" onclick="openModal('add')">+ Add New Movie</button>
</section>
  <div class="movie-row">
    <div class="movie-card coming">
      <img src="https://i.pinimg.com/1200x/e2/4f/47/e24f47ae328185e4fe30b80ca9e4650d.jpg" alt="Little Women">
      <div class="movie-info">
        <p class="title">Little Women</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/e9/0e/77/e90e77db90e904c3cfc9adffc37619e6.jpg" alt="Archer">
      <div class="movie-info">
        <p class="title">Archer</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/1200x/9a/5a/b7/9a5ab7adee2fde79b08a8437204dad12.jpg" alt="Madame Web">
      <div class="movie-info">
        <p class="title">Madame Web</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/a1/55/ed/a155ed481d21f0537fcbb5fb63e5dbb5.jpg" alt="Paddington in Peru">
      <div class="movie-info">
        <p class="title">Paddington in Peru</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/03/a1/cd/03a1cd1bf9b53c5be5e904424c29a5db.jpg" alt="Exhuma">
      <div class="movie-info">
        <p class="title">Exhuma</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/1200x/93/a6/f6/93a6f6f6e2fc495899c5ad23ded29aa1.jpg" alt="Satria Dewa Gatotkaca">
      <div class="movie-info">
        <p class="title">Satria Dewa Gatotkaca</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>

    <div class="movie-card coming">
      <img src="https://i.pinimg.com/736x/c2/89/c2/c289c2d3ced72a5088c1e0bcc2ba9c68.jpg" alt="Sosok Ketiga Lintrik">
      <div class="movie-info">
        <p class="title">Sosok Ketiga Lintrik</p>
        <div class="meta">
          <span class="age">SU</span>
          <span class="duration">135 min</span>
        </div>
        <div class="crud-actions">
            <button class="edit" onclick="openModal('edit', 'Interstellar')">Edit</button>
            <button class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
        </div>
      </div>
    </div>


    </div>
</section>


<nav class="bottom-nav">
  <a href="/home" class="active">Home</a>
  <a href="/movies">Movies</a>
  <a href="/tickets">Tickets</a>
  <a href="/profile">Profile</a>
</nav>

</body>
</html>