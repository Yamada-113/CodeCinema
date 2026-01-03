<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        // 1. Menangani Data Kursi
        if ($request->has('seats')) {
            $seatIds = is_array($request->seats)
                ? $request->seats
                : explode(',', $request->seats);

            session(['seats' => $seatIds]);
        } else {
            $seatIds = session('seats', []);
        }

        // 2. Ambil Parameter dari Request atau Session
        $id_studio = $request->id_studio ?? session('id_studio');
        $date      = $request->date ?? session('date');
        $jam       = $request->jam ?? session('jam');

        if (!$id_studio || !$date || !$jam) {
            return redirect('/home')->with('error', 'Sesi habis, silakan pilih kursi kembali.');
        }

        session([
            'id_studio' => $id_studio,
            'date'      => $date,
            'jam'       => $jam
        ]);

        // 3. Ambil Data Jadwal
        $jadwal = DB::table('jadwal_tayang')->where([
            ['id_studio', $id_studio],
            ['tanggal', $date],
            ['jam_tayang', $jam]
        ])->first();

        if (!$jadwal) return redirect()->back();

        // 4. Ambil Data Pendukung (Film, Studio, Lokasi)
        $movie  = DB::table('tabel_film')->where('id_film', $jadwal->id_film)->first();
        $studio = DB::table('tabel_studio')->where('id_studio', $id_studio)->first();
        
        // PERBAIKAN: Mengambil data lokasi agar tidak muncul "Location1"
        $location = DB::table('tabel_lokasi')
            ->where('id_lokasi', $studio->id_lokasi)
            ->first();

        // 5. Format Label Kursi (Misal: A1, A2)
        $seatLabels = DB::table('tabel_kursi')
            ->whereIn('id_kursi', $seatIds)
            ->selectRaw("CONCAT(baris_kursi, nomor_kursi) as seat")
            ->pluck('seat')
            ->toArray();

        return view('payment', [
            'booking' => [
                'movie'     => $movie->judul ?? 'Unknown Movie',
                'date'      => $jadwal->tanggal,
                'time'      => $jadwal->jam_tayang,
                'location'  => $location->nama_lokasi ?? 'Mall Taman Anggrek', 
                'price'     => $jadwal->harga ?? 50000,

                // TAMPILAN
                'seats'     => $seatLabels,

                // DATA UNTUK FORM/DATABASE
                'seat_ids'  => $seatIds,
                'id_film'   => $movie->id_film,
                'id_studio' => $id_studio,
                'id_jadwal' => $jadwal->id_jadwal,
                'poster'    => $movie->poster_film,
            ],
            'jadwal' => $jadwal
        ]);
    }

    public function processPayment(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|exists:tabel_user,email',
            'method' => 'required|string',
            'id_jadwal' => 'required',
            'seats' => 'required|array'
        ], [
            'email.exists' => 'Email tidak terdaftar. Silakan gunakan email yang sudah terdaftar.'
        ]);

        $uniqueId = 'PYMT-' . Str::upper(Str::random(8));
        $seatIds  = $request->input('seats', []);

        // 2. Simpan ke tabel_pembayaran
        DB::table('tabel_pembayaran')->insert([
            'id_pembayaran'     => $uniqueId,
            'id_jadwal'         => $request->id_jadwal,
            'full_name'         => $request->name,
            'email'             => $request->email,
            'metode_pembayaran' => $request->method,
            'id_kursi'          => json_encode($seatIds),
            'tanggal_bayar'     => now(),
        ]);

        // 3. Simpan Detail Kursi ke tabel_pemesanan
        foreach ($seatIds as $seatId) {
            DB::table('tabel_pemesanan')->insert([
                'id_pembayaran' => $uniqueId,
                'id_jadwal'     => $request->id_jadwal,
                'id_kursi'      => (int) $seatId,
            ]);
        }

        // 4. Update Status Kursi Jadi 'taken'
        DB::table('tabel_kursi')
            ->whereIn('id_kursi', $seatIds)
            ->update(['status' => 'taken']);

        // 5. Redirect ke Halaman Tiket
        return redirect()->route('payment.tiket', $uniqueId);
    }
}