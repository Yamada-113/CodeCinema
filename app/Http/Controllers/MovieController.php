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

    public function booking(Request $request)
    {
    $cinemas   = DB::table('tabel_lokasi')->get();
    $cinemaId  = $request->query('id_lokasi');
    $studioId  = $request->query('id_studio');
    $filmId    = $request->query('id_film') ?? 1;
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

    // TANGGAL BERDASARKAN JADWAL
    $calendar = [];
    if ($filmId && $studioId) {
        $dates = DB::table('jadwal_tayang')
            ->where('id_film', $filmId)
            ->where('id_studio', $studioId)
            ->select('tanggal')
            ->distinct()
            ->orderBy('tanggal')
            ->pluck('tanggal');

        foreach ($dates as $tgl) {
            $d = Carbon::parse($tgl);
            $calendar[] = [
                'full_date' => $d->toDateString(),
                'day'       => strtoupper($d->format('D')),
                'date'      => $d->format('d'),
            ];
        }
    }

    // JAM + HARGA
    $times = [];
    if ($filmId && $studioId && $date) {
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
        'seats'
    ));
}


}
