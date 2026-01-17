<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingHistoryController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi user
        $history = DB::table('tabel_pembayaran as p')
            ->join('jadwal_tayang as j', 'p.id_jadwal', '=', 'j.id_jadwal')
            ->join('tabel_film as f', 'j.id_film', '=', 'f.id_film')
            ->select(
                'p.id_pembayaran',
                'p.full_name as customer_name',
                'f.judul as movie_title',
                'p.tanggal_bayar as tanggal',
                'p.id_kursi as kursi_json'
            )
            ->orderBy('p.tanggal_bayar', 'desc')
            ->get()
            ->map(function($item) {
                // Konversi JSON ID kursi ke array
                $seatIds = json_decode($item->kursi_json, true) ?: [];

                // Ambil label kursi dari tabel_kursi
                $seatLabels = DB::table('tabel_kursi')
                    ->whereIn('id_kursi', $seatIds)
                    ->selectRaw("CONCAT(baris_kursi, nomor_kursi) as label")
                    ->pluck('label')
                    ->toArray();

                // Gabungkan menjadi string H8, H9
                $item->daftar_kursi = implode(', ', $seatLabels);

                // Hitung total harga (misal tiap kursi sama harga)
                $item->total_harga = count($seatIds) * 50000; // atau ambil dari jadwal->harga

                return $item;
            });

        return view('Admin.bookingHistory', compact('history'));
    }
}
