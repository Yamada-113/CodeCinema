<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Movie;

class MovieController extends Controller
{

    public function seat($studioId = null)
    {
        if (!$studioId) {
        $studioId = 1;
        }

        $seats = DB::table('tabel_kursi')
            ->where('id_studio', $studioId)
            ->orderBy('baris_kursi')
            ->orderBy('nomor_kursi')
            ->get()
            ->groupBy('baris_kursi');

        return view('movieDetails', compact('seats'));
    }

    public function booking(Request $request, $id)
    {
    $cinemas   = DB::table('tabel_lokasi')->get();
    $cinemaId  = $request->query('id_lokasi');
    $studioId  = $request->query('id_studio');
    $filmId    = $id;
    $date      = $request->query('date');

    //FILM
    $movie = DB::table('tabel_film')
           ->where('id_film', $filmId)
           ->first();

    // STUDIO
    $studios = $cinemaId
        ? DB::table('tabel_studio')->where('id_lokasi', $cinemaId)->get()
        : [];

    // KURSI
    $jam = $request->query('jam');

    $seats = [];
    if ($studioId) {
        $seats = DB::table('tabel_kursi')
            ->where('id_studio', $studioId)
            ->orderBy('baris_kursi')
            ->orderBy('nomor_kursi')
            ->get()
            ->groupBy('baris_kursi');
    }

    // TANGGAL BERDASARKAN JADWAL - HANYA TAMPIL KALAU STUDIO SUDAH DIPILIH
    $calendar = [];

    if ($studioId) {
        $calendar = DB::table('jadwal_tayang')
            ->where('id_film', $filmId)
            ->where('id_studio', $studioId)
            ->whereDate('tanggal', '>=', now())
            ->selectRaw('DATE(tanggal) as tanggal')
            ->distinct()
            ->orderBy('tanggal')
            ->limit(7)
            ->get()
            ->map(function ($item) {
                $dateObj = \Carbon\Carbon::parse($item->tanggal);
                return [
                    'full_date' => $dateObj->format('Y-m-d'),
                    'day'       => $dateObj->format('D'),
                    'date'      => $dateObj->format('d'),
                ];
            });
    }

    
    // JAM + HARGA - HANYA TAMPIL KALAU STUDIO DAN TANGGAL SUDAH DIPILIH
    $times = collect();

    if ($studioId && $date) {
    $times = DB::table('jadwal_tayang')
        ->where('id_film', $filmId)
        ->where('id_studio', $studioId)
        ->where('tanggal', $date)
        ->orderBy('jam_tayang')
        ->get();
    }

    return view('movieDetails', compact(
        'movie',
        'cinemas',
        'cinemaId',
        'studios',
        'studioId',
        'filmId',
        'date',
        'calendar',
        'times',
        'jam',
        'seats'
    ));
}

public function search(Request $request)
{
    $query = $request->input('query');
    $genre = $request->input('genre');

    // Pencarian untuk Now Playing
    $movies = DB::table('tabel_film')
        ->where('status', 'now_playing') // Kunci perbaikannya di sini
        ->when($query, function ($q) use ($query) {
            return $q->where('judul', 'like', "%{$query}%");
        })
        ->when($genre, function ($q) use ($genre) {
            return $q->where('genre', 'like', "%{$genre}%");
        })
        ->get();

    // Pencarian untuk Coming Soon (Opsional, jika ingin ditampilkan juga saat search)
    $comingSoonMovies = DB::table('tabel_film')
        ->where('status', 'coming_soon')
        ->when($query, function ($q) use ($query) {
            return $q->where('judul', 'like', "%{$query}%");
        })
        ->get();

    return view('search', compact('movies', 'comingSoonMovies'));
}

public function store(Request $request)
{
    // Gunakan DB::table agar Laravel TIDAK otomatis mencari created_at/updated_at
    \Illuminate\Support\Facades\DB::table('tabel_film')->insert([
        'judul'       => $request->judul,
        'genre'       => $request->genre,
        'rating'      => $request->rating,
        'durasi'      => $request->durasi,
        'direktor'    => $request->direktor,
        'deskripsi'   => $request->deskripsi,
        'poster_film' => $request->poster_film,
        'status'      => $request->status,
       
    ]);

    return redirect('/homeAdmin')->with('success', 'Film Moana 2 berhasil disimpan!');
}
// Tambahkan fungsi ini di dalam class MovieController
public function update(Request $request, $id)
{
    DB::table('tabel_film')->where('id_film', $id)->update([
        'judul'       => $request->judul,
        'genre'       => $request->genre,
        'rating'      => $request->rating,
        'durasi'      => $request->durasi,
        'direktor'    => $request->direktor,
        'deskripsi'   => $request->deskripsi,
        'poster_film' => $request->poster_film,
    ]);

    return redirect()->route('admin.home')->with('success', 'Film berhasil diperbarui!');
}
public function edit($id)
{
    // Mengambil data film dari database berdasarkan ID yang diklik
    $movie = DB::table('tabel_film')->where('id_film', $id)->first();
    
    if (!$movie) {
        return redirect()->route('admin.home')->with('error', 'Film tidak ditemukan!');
    }
    return view('Admin.edit', compact('movie'));
}
// Perbaiki fungsi destroy agar redirect ke route name
public function destroy($id) {
    DB::table('tabel_film')->where('id_film', $id)->delete();
    return redirect()->route('admin.home')->with('success', 'Film berhasil dihapus!');
}

public function admin()
{
    // Film now playing
    $movies = DB::table('tabel_film')
        ->where('status', 'now_playing')
        ->get();

    // Film coming soon
    $comingSoonMovies = DB::table('tabel_film')
        ->where('status', 'coming_soon')
        ->get();

    // Lokasi bioskop
    $lokasis = DB::table('tabel_lokasi')->get();

    // Studio (kalau dropdown studio dipakai di halaman ini)
    $studios = DB::table('tabel_studio')
        ->join('tabel_lokasi', 'tabel_studio.id_lokasi', '=', 'tabel_lokasi.id_lokasi')
        ->select('tabel_studio.*', 'tabel_lokasi.nama_lokasi')
        ->get();

    return view('Admin.homeAdmin', compact(
        'movies',
        'comingSoonMovies',
        'lokasis',
        'studios'
    ));
}
}