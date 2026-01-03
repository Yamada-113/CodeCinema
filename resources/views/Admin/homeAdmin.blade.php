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
  <div class="logo-wrapper">
    <img src="{{ asset('foto/Logo CodeCinema.png') }}" alt="Logo" class="cinema-logo">
    <h1>CodeCinema</h1>
  </div>
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
    @foreach($movies as $movie)
    <div class="movie-card">
        <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}">
        <div class="movie-info">
            <p class="title">{{ $movie->judul }}</p>
            <div class="meta">
                <span class="age">{{ $movie->rating }}</span>
                <span class="duration">{{ $movie->durasi }} min</span>
            </div>
            <div class="crud-actions">
                <button class="edit" onclick="openModal('edit', '{{ $movie->id_film }}')">Edit</button>
                <form action="{{ route('movie.destroy', $movie->id_film) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
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
<div id="modalAddMovie" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); z-index:9999; justify-content:center; align-items:center; padding:20px;">
    
    <div style="background:#181b22; padding:25px; border-radius:15px; width:100%; max-width:500px; border:1px solid #4f7cff; max-height: 90vh; overflow-y: auto;">
        <h3 style="color:#4f7cff; margin-bottom:20px; text-align:center;">Tambah Film Baru</h3>
        
        <form action="{{ route('movie.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Judul Film</label>
                <input type="text" name="judul" required style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:15px;">
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Genre</label>
                    <input type="text" name="genre" placeholder="Action, Sci-Fi" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Rating</label>
                    <input type="text" name="rating" placeholder="PG-13 / 17+" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:15px;">
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Durasi (Menit)</label>
                    <input type="number" name="durasi" placeholder="120" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Direktor</label>
                    <input type="text" name="direktor" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Link Poster (URL Pinterest/Lainnya)</label>
                <input type="text" name="poster_film" required style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px; resize:none;"></textarea>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" style="flex:2; background:#4f7cff; color:white; border:none; padding:12px; border-radius:8px; font-weight:bold; cursor:pointer;">Simpan Ke Database</button>
                <button type="button" onclick="closeModal()" style="flex:1; background:#333; color:white; border:none; padding:12px; border-radius:8px; cursor:pointer;">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalAddMovie').style.display = 'flex';
    }
    function closeModal() {
        document.getElementById('modalAddMovie').style.display = 'none';
    }
</script>


<nav class="bottom-nav">
  <a href="/home" class="active">Home</a>
  <a href="/Search">Search</a>
  <a href="/my-bookings">My Bookings</a>
  <a href="/profile">Profile</a>
</nav>

</body>
</html>