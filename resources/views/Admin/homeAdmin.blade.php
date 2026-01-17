<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie App - CodeCinema</title>
  <link rel="stylesheet" href="{{ asset('css/styleHomeAdmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
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
              <button type="button" class="edit" 
              onclick="openEditModal('{{ $movie->id_film }}', '{{ addslashes($movie->judul) }}', '{{ $movie->genre }}', '{{ $movie->rating }}', '{{ $movie->poster_film }}', '{{ $movie->durasi }}', 
              '{{ addslashes($movie->direktor) }}', '{{ addslashes($movie->deskripsi) }}')">Edit</button>
                <form action="{{ route('movie.destroy', $movie->id_film)}}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete" onclick="return confirm('Hapus film ini?')">Hapus</button>
                    
                    <button type="button" class="schedule"
                        onclick="openJadwalModal('{{ $movie->id_film }}', '{{ addslashes($movie->judul) }}')">
                        Atur Jadwal
                    </button>
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
        @foreach($comingSoonMovies as $movie)
        <div class="movie-card coming">
            <img src="{{ $movie->poster_film }}" alt="{{ $movie->judul }}">
            <div class="movie-info">
                <p class="title">{{ $movie->judul }}</p>
                <div class="meta">
                    <span class="age">{{ $movie->rating }}</span>
                    <span class="duration">{{ $movie->durasi }} min</span>
                </div>
                <div class="crud-actions">
                    <button type="button" class="edit" 
                        onclick="openEditModal('{{ $movie->id_film }}', '{{ addslashes($movie->judul) }}', '{{ $movie->genre }}', '{{ $movie->rating }}', '{{ $movie->poster_film }}', '{{ $movie->durasi }}', '{{ addslashes($movie->direktor) }}', '{{ addslashes($movie->deskripsi) }}', '{{ $movie->status }}')">
                        Edit
                    </button>
                    <form action="{{ route('movie.destroy', $movie->id_film)}}" method="POST" style="display:inline;">
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

    </div>
</section>
<div id="modalAddMovie" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); z-index:9999; justify-content:center; align-items:center; padding:20px;">
    
    <div style="background:#181b22; padding:25px; border-radius:15px; width:100%; max-width:500px; border:1px solid #4f7cff; max-height: 90vh; overflow-y: auto;">
        <h3 style="color:#4f7cff; margin-bottom:20px; text-align:center;">Tambah Film Baru</h3>
        
        <form action="{{ route('movie.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Status Tayang</label>
            <select name="status" required style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
            <option value="now_playing">Now Playing</option>
            <option value="coming_soon">Coming Soon</option>
            </select>
          </div>
            
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

<div id="modalJadwal" class="modal-jadwal">
  <div class="modal-box">

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('modalJadwal').style.display = 'flex';
            });
        </script>
    @endif

    <h3>Atur Jadwal Film</h3>
    <p class="subtitle" id="judulFilmJadwal"></p>

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
      @csrf
      <input type="hidden" name="id_film" id="jadwal_id_film">

      <div class="form-group">
        <label>Lokasi</label>
        <select name="id_lokasi" required>
        <option value="">-- Pilih Lokasi --</option>
            @foreach ($lokasis as $lokasi)
                <option value="{{ $lokasi->id_lokasi }}">
                    {{ $lokasi->nama_lokasi }}
                </option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Studio</label>
        <select name="id_studio" required>
            <option value="">-- Pilih Studio --</option>
            @foreach ($studios as $studio)
                <option value="{{ $studio->id_studio }}">
                    {{ $studio->nama_studio }} ({{ $studio->nama_lokasi }})
                </option>
            @endforeach
    </select>
        @if (session('error'))
            <div style="
                margin-top:6px;
                font-size:12px;
                color:#ff4d4f;">
                {{ session('error') }}
            </div>
        @endif
      </div>

      <div class="form-group">
        <label>Jam Tayang</label>
        <input type="time" name="jam_tayang" required>
      </div>

      <div class="form-group">
        <label>Harga Tiket</label>
        <input type="number" name="harga_tiket" placeholder="50000" required>
      </div>

      <div class="modal-actions">
        <button type="submit" class="btn-primary">
          Simpan Jadwal
        </button>
        <button type="button" onclick="closeJadwalModal()" class="btn-secondary">
          Batal
        </button>
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

<script>
function openJadwalModal(idFilm, judul) {
    document.getElementById('modalJadwal').style.display = 'flex';
    document.getElementById('jadwal_id_film').value = idFilm;
    document.getElementById('judulFilmJadwal').innerText = judul;
}

function closeJadwalModal() {
    document.getElementById('modalJadwal').style.display = 'none';
}
</script>


<div id="modalEditMovie" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); z-index:9999; justify-content:center; align-items:center; padding:20px;">
    
    <div style="background:#181b22; padding:25px; border-radius:15px; width:100%; max-width:500px; border:1px solid #4f7cff; max-height: 90vh; overflow-y: auto;">
        <h3 style="color:#4f7cff; margin-bottom:20px; text-align:center;">Edit Film</h3>
        
        <form id="formEditMovie" method="POST">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 15px;">
            <label style="color:#9aa0aa;">Status Tayang</label>
          <select name="status" id="edit_status" required style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
          <option value="now_playing">Now Playing</option>
          <option value="coming_soon">Coming Soon</option>
          </select>
        </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Judul Film</label>
                <input type="text" name="judul" id="edit_judul" required style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:15px;">
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Genre</label>
                    <input type="text" name="genre" id="edit_genre" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Rating</label>
                    <input type="text" name="rating" id="edit_rating" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:15px;">
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Durasi (Menit)</label>
                    <input type="number" name="durasi" id="edit_durasi" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
                <div>
                    <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Direktor</label>
                    <input type="text" name="direktor" id="edit_direktor" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Link Poster</label>
                <input type="text" name="poster_film" id="edit_poster" required style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:5px; font-size:12px; color:#9aa0aa;">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="edit_deskripsi" rows="3" style="width:100%; padding:10px; background:#0f1115; border:1px solid #2d323d; color:white; border-radius:5px; resize:none;"></textarea>
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" style="flex:2; background:#4f7cff; color:white; border:none; padding:12px; border-radius:8px; font-weight:bold; cursor:pointer;">Simpan Perubahan</button>
                <button type="button" onclick="closeEditModal()" style="flex:1; background:#333; color:white; border:none; padding:12px; border-radius:8px; cursor:pointer;">Batal</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openEditModal(id, judul, genre, rating, poster, durasi, direktor, deskripsi, status) {
        const modal = document.getElementById('modalEditMovie');
        const form = document.getElementById('formEditMovie');

        if (modal && form) {
            form.action = '/movie/update/' + id;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_genre').value = genre;
            document.getElementById('edit_rating').value = rating;
            document.getElementById('edit_poster').value = poster;
            document.getElementById('edit_durasi').value = durasi;
            document.getElementById('edit_direktor').value = direktor;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_status').value = status;
            
            modal.style.display = 'flex'; // Ini yang bikin ke tengah
        }
    }

    function closeEditModal() {
        document.getElementById('modalEditMovie').style.display = 'none';
    }
</script>

<nav class="bottom-nav">
  @if(session('role') === 'admin')
        <a href="{{ route('admin.home') }}" class="{{ request()->is('homeAdmin') ? 'active' : '' }}">Home</a>
    @else
        <a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">Home</a>
    @endif

    <a href="{{ route('movies.search') }}" class="{{ request()->is('search') ? 'active' : '' }}">Search</a>
  <a href="/profile">Profile</a>
</nav>

</body>
</html>