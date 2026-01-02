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
        for ($i = 0; $i < 7; $i++) {
        $dateObj = now()->addDays($i);
        $calendar[] = [
            'full_date' => $dateObj->format('Y-m-d'),
            'day'       => $dateObj->format('D'), 
            'date'      => $dateObj->format('d'), 
            ];
        }
    }
    
    // JAM + HARGA - HANYA TAMPIL KALAU STUDIO DAN TANGGAL SUDAH DIPILIH
    $times = collect();

    if ($studioId && $date) {
        $times = DB::table('jadwal_tayang')
        ->where('id_film', $filmId)
        ->where('id_studio', $studioId)
        ->where('tanggal', $date)
        ->get();

        if ($times->isEmpty()) {
        $times = collect([
            (object)['jam_tayang' => '13:00', 'harga_tiket' => 50000],
            (object)['jam_tayang' => '16:00', 'harga_tiket' => 50000],
            (object)['jam_tayang' => '19:00', 'harga_tiket' => 55000],
            (object)['jam_tayang' => '21:00', 'harga_tiket' => 55000],
            ]);
        }
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
        'seats'
    ));
}


}