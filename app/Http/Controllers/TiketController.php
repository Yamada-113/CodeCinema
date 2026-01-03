<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TiketController extends Controller
{
    public function result($paymentId)
    {
        // 1. Ambil data pembayaran
        $payment = DB::table('tabel_pembayaran')
            ->where('id_pembayaran', $paymentId)
            ->first();

        if (!$payment) {
            abort(404, 'Data pembayaran tidak ditemukan');
        }

        // 2. Ambil data jadwal untuk mendapatkan id_film dan id_studio
        $jadwal = DB::table('jadwal_tayang')
            ->where('id_jadwal', $payment->id_jadwal)
            ->first();

        // 3. Ambil data film
        $film = DB::table('tabel_film')
            ->where('id_film', $jadwal->id_film)
            ->first();

        // 4. Ambil data studio
        $studio = DB::table('tabel_studio')
            ->where('id_studio', $jadwal->id_studio)
            ->first();

        // 5. Ambil data lokasi
        $lokasi = DB::table('tabel_lokasi')
            ->where('id_lokasi', $studio->id_lokasi ?? null)
            ->first();

        // 6. Ambil data kursi
        $seats = DB::table('tabel_pemesanan')
            ->join('tabel_kursi', 'tabel_pemesanan.id_kursi', '=', 'tabel_kursi.id_kursi')
            ->where('tabel_pemesanan.id_pembayaran', $paymentId)
            ->select('tabel_kursi.baris_kursi', 'tabel_kursi.nomor_kursi')
            ->get();

        // 7. MENYATUKAN DATA KE DALAM VARIABEL $ticket
        // Ini agar sesuai dengan panggillan variabel di file Blade Anda
        $ticket = (object)[
            'poster_film'   => $film->poster_film ?? null,
            'judul'         => $film->judul ?? 'N/A',
            'tanggal'       => $jadwal->tanggal ?? 'N/A',
            'jam_tayang'    => $jadwal->jam_tayang ?? 'N/A',
            'nama_lokasi'   => $lokasi->nama_lokasi ?? 'Mall Taman Anggrek',
            'nama_studio'   => $studio->nama_studio ?? 'Regular',
            'id_pembayaran' => $payment->id_pembayaran,
        ];

        return view('tiket', compact('ticket', 'seats'));
    }
}