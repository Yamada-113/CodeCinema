<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    public function result($paymentId)
    {
        $payment = DB::table('tabel_pembayaran')
        ->where('id_pembayaran', $paymentId)
        ->first();

        if (!$payment) {
            abort(404, 'Data pembayaran tidak ditemukan');
        }

        $user = DB::table('tabel_user')
            ->where('email', $payment->email)
            ->first();

        if (!$user) {
            return redirect('/')
                ->with('error', 'Email tidak terdaftar. Tidak dapat mengakses tiket.');
        }

        // ================= AMBIL DARI JADWAL =================
        $ticket = DB::table('tabel_pembayaran')
        ->join('jadwal_tayang', 'jadwal_tayang.id_jadwal', '=', 'tabel_pembayaran.id_jadwal')
        ->join('tabel_film', 'tabel_film.id_film', '=', 'jadwal_tayang.id_film')
        ->join('tabel_studio', 'tabel_studio.id_studio', '=', 'jadwal_tayang.id_studio')
        ->join('tabel_lokasi', 'tabel_lokasi.id_lokasi', '=', 'tabel_studio.id_lokasi')
        ->where('tabel_pembayaran.id_pembayaran', $paymentId)
        ->select(
            'tabel_pembayaran.id_pembayaran',
            'tabel_pembayaran.full_name',
            'tabel_pembayaran.email',
            'tabel_pembayaran.metode_pembayaran',
            'tabel_pembayaran.tanggal_bayar',

            'jadwal_tayang.tanggal',
            'jadwal_tayang.jam_tayang',

            'tabel_film.judul',
            'tabel_film.poster_film',

            'tabel_studio.nama_studio',
            'tabel_lokasi.nama_lokasi',

            'tabel_pembayaran.id_kursi'
        )
        ->first();

    if (!$ticket) {
        abort(404, 'Tiket tidak ditemukan');
    }

    $seatIds = json_decode($ticket->id_kursi ?? '[]', true);

    $seats = DB::table('tabel_kursi')
        ->whereIn('id_kursi', $seatIds)
        ->selectRaw("CONCAT(baris_kursi, nomor_kursi) as seat")
        ->pluck('seat')
        ->toArray();

    return view('tiket', compact('ticket', 'seats'));

    }
}
