<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;

class TiketController extends Controller
{
    public function result($paymentId)
    {
        $payment = DB::table('tabel_pembayaran')
                    ->where('id_pembayaran', $paymentId)
                    ->first();

        $film = DB::table('tabel_film')->where('id_film', $payment->id_film)->first();
        $studio = DB::table('tabel_studio')->where('id_studio', $payment->id_studio)->first();
        $lokasi = DB::table('tabel_lokasi')->where('id_lokasi', $studio->id_lokasi)->first();
        $seats = DB::table('tabel_pemesanan')
        ->join('tabel_kursi', 'tabel_pemesanan.id_kursi', '=', 'tabel_kursi.id_kursi')
        ->where('tabel_pemesanan.id_pembayaran', $paymentId)
        ->select(
            'tabel_kursi.baris_kursi',
            'tabel_kursi.nomor_kursi'
        )
        ->orderBy('tabel_kursi.baris_kursi')
        ->orderBy('tabel_kursi.nomor_kursi')
        ->get();

        return view('ticket', compact('payment','film','studio','lokasi','seats'));
    }
    
}
