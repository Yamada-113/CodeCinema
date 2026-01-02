<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        // ===============================
        // 1. VALIDASI INPUT
        // ===============================
        $request->validate([
            'seats'      => 'required|array|min:1',
            'id_studio'  => 'required|integer',
            'date'       => 'required|date',
            'jam'        => 'required'
        ], [
            'seats.required' => 'Silakan pilih minimal 1 kursi.',
            'seats.min'      => 'Silakan pilih minimal 1 kursi.'
        ]);

        // ===============================
        // 2. DATA KURSI
        // ===============================
        $seatIds = $request->seats;

        $seats = DB::table('tabel_kursi')
            ->whereIn('id_kursi', $seatIds)
            ->get();

        $seatLabels = $seats->map(function ($seat) {
            return $seat->baris_kursi . $seat->nomor_kursi;
        })->toArray();

        // ===============================
        // 3. AMBIL JADWAL TAYANG
        // ===============================
        $jadwal = DB::table('jadwal_tayang')
            ->where('id_studio', $request->id_studio)
            ->where('tanggal', $request->date)
            ->where('jam_tayang', $request->jam)
            ->first();

        if (!$jadwal) {
            return back()->withErrors([
                'jadwal' => 'Jadwal tidak ditemukan.'
            ]);
        }

        // ===============================
        // 4. DATA STUDIO & LOKASI
        // ===============================
        $studio = DB::table('tabel_studio')
            ->where('id_studio', $request->id_studio)
            ->first();

        $lokasi = DB::table('tabel_lokasi')
            ->where('id_lokasi', $studio->id_lokasi)
            ->first();

        // ===============================
        // 5. DATA FILM
        // ===============================
        $movie = DB::table('tabel_film')
            ->where('id_film', $jadwal->id_film)
            ->first();

        // ===============================
        // 6. DATA BOOKING (ARRAY)
        // ===============================
        $booking = [
            'id_jadwal' => $jadwal->id_jadwal,
            'movie'     => $movie->judul ?? '-',
            'date'      => $jadwal->tanggal,
            'time'      => $jadwal->jam_tayang,
            'location'  => $lokasi->nama_lokasi ?? '-',
            'studio'    => $studio->nama_studio ?? '-',
            'seats'     => $seatLabels,
            'seat_ids'  => $seatIds,
            'price'     => $jadwal->harga_tiket
        ];

        // ===============================
        // 7. KIRIM KE VIEW PAYMENT
        // ===============================
        return view('payment', compact('booking', 'jadwal'));
    }
}
