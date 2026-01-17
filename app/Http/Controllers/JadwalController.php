<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalController extends Controller
{
    /**
     * ============================
     * ADMIN : HALAMAN JADWAL FILM
     * ============================
     */
    public function index()
    {
    $movies = DB::table('tabel_film')
    ->where('status', 'now_playing')
    ->select('tabel_film.*')
    ->selectSub(function ($q) {
        $q->from('jadwal_tayang')
          ->selectRaw('COUNT(*)')
          ->whereColumn('jadwal_tayang.id_film', 'tabel_film.id_film');
    }, 'jadwal_count')
    ->get();

    $comingSoonMovies = DB::table('tabel_film')
        ->where('status', 'coming_soon')
        ->get();

    $lokasis = DB::table('tabel_lokasi')->get();

    $studios = DB::table('tabel_studio')
        ->join('tabel_lokasi', 'tabel_studio.id_lokasi', '=', 'tabel_lokasi.id_lokasi')
        ->select('tabel_studio.*', 'tabel_lokasi.nama_lokasi')
        ->get();


    $jadwals = DB::table('jadwal_tayang')
        ->join('tabel_studio', 'jadwal_tayang.id_studio', '=', 'tabel_studio.id_studio')
        ->join('tabel_lokasi', 'tabel_studio.id_lokasi', '=', 'tabel_lokasi.id_lokasi')
        ->select(
            'jadwal_tayang.*',
            'tabel_studio.nama_studio',
            'tabel_lokasi.nama_lokasi'
        )
        ->get();

    return view('Admin.homeAdmin', compact(
        'movies',
        'comingSoonMovies',
        'lokasis',
        'studios',
        'jadwals'
    ));
}

    /**
     * ============================
     * USER : Ambil jadwal per film
     * ============================
     */
    public function getJadwalByFilm(Request $request, $id_film)
    {
        $today = Carbon::today();
        $endDate = Carbon::today()->addDays(6);

        $jadwals = DB::table('jadwal_tayang')
            ->where('id_film', $id_film)
            ->whereBetween('tanggal', [$today, $endDate])
            ->orderBy('tanggal')
            ->orderBy('jam_tayang')
            ->get();

        return response()->json($jadwals);
    }

    /**
     * ============================
     * ADMIN : Simpan jadwal
     * ============================
     */
    public function store(Request $request)
    {
        $request->validate([
        'id_film'      => 'required|exists:tabel_film,id_film',
        'id_studio'    => 'required|exists:tabel_studio,id_studio', 
        'jam_tayang'   => 'required',
        'harga_tiket'  => 'required|numeric'
    ]);

    $validStudio = DB::table('tabel_studio')
    ->where('id_studio', $request->id_studio)
    ->where('id_lokasi', $request->id_lokasi)
    ->exists();

    if (!$validStudio) {
        return redirect()->back()
        ->withInput()
        ->with('error', 'Studio tidak sesuai dengan lokasi yang dipilih!');
    }

        // CEK DUPLIKAT JADWAL
        $exists = DB::table('jadwal_tayang')
            ->where([
                'id_film'   => $request->id_film,
                'id_studio' => $request->id_studio,
                'tanggal'   => $request->tanggal,
                'jam_tayang'       => $request->jam_tayang
            ])->exists();

        if ($exists) {
            return back()->with('error', 'Jadwal sudah ada!');
        }

        // GENERATE 7 HARI KE DEPAN
        for ($i = 0; $i < 7; $i++) {
        $tanggal = Carbon::today()->addDays($i)->format('Y-m-d');

        $exists = DB::table('jadwal_tayang')
            ->where([
                'id_film'    => $request->id_film,
                'id_studio'  => $request->id_studio,
                'tanggal'    => $tanggal,
                'jam_tayang' => $request->jam_tayang
            ])->exists();

        if (!$exists) {
            DB::table('jadwal_tayang')->insert([
                'id_film'     => $request->id_film,
                'id_studio'   => $request->id_studio,
                'tanggal'     => $tanggal,
                'jam_tayang'  => $request->jam_tayang,
                'harga_tiket' => $request->harga_tiket
            ]);
        }
    }

    foreach ($request->jam_tayang as $jam) {
    if (!$jam) continue;

    for ($i = 0; $i < 7; $i++) {
        DB::table('jadwal_tayang')->insert([
            'id_film'     => $request->id_film,
            'id_lokasi'   => $request->id_lokasi,
            'id_studio'   => $request->id_studio,
            'tanggal'     => Carbon::today()->addDays($i),
            'jam_tayang'  => $jam,
            'harga_tiket' => $request->harga_tiket
        ]);
    }
}
        return back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    /**
     * ============================
     * ADMIN : Hapus jadwal
     * ============================
     */
    public function destroy($id)
    {
        DB::table('jadwal_tayang')
            ->where('id_jadwal', $id)
            ->delete();

        return back()->with('success', 'Jadwal dihapus');
    }
}