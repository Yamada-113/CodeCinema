<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingHistoryController extends Controller
{
    public function index()
{
    // 1. Ambil data transaksi dengan join ke jadwal_tayang untuk mendapatkan harga kustom
    $history = DB::table('tabel_pembayaran as p')
        ->join('jadwal_tayang as j', 'p.id_jadwal', '=', 'j.id_jadwal')
        ->join('tabel_film as f', 'j.id_film', '=', 'f.id_film')
        ->select(
            'p.id_pembayaran',
            'p.full_name as customer_name',
            'f.judul as movie_title',
            'p.tanggal_bayar as tanggal',
            'p.id_kursi as kursi_json',
            'j.harga_tiket' // Tambahkan ini agar harga dari database ikut terbawa
        )
        ->orderBy('p.tanggal_bayar', 'desc')
        ->get()
        ->map(function($item) {
            // 2. Konversi JSON ID kursi ke array
            $seatIds = json_decode($item->kursi_json, true) ?: [];

            // 3. Ambil label kursi (H8, H9, dll)
            $seatLabels = DB::table('tabel_kursi')
                ->whereIn('id_kursi', $seatIds)
                ->selectRaw("CONCAT(baris_kursi, nomor_kursi) as label")
                ->pluck('label')
                ->toArray();

            $item->daftar_kursi = implode(', ', $seatLabels);

            // 4. PERBAIKAN: Hitung total harga berdasarkan harga kustom di database
            // Jangan pakai * 50000, tapi pakai $item->harga_tiket
            $item->total_harga = count($seatIds) * $item->harga_tiket; 

            return $item;
        });

    return view('Admin.bookingHistory', compact('history'));
}
}