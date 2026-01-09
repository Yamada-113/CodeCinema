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
        // ================= SEAT SESSION =================
        if ($request->has('seats')) {
            $seatIds = is_array($request->seats)
                ? $request->seats
                : explode(',', $request->seats);

            session(['seats' => $seatIds]);
        } else {
            $seatIds = session('seats', []);
        }

        $id_film = $request->id_film ?? session('id_film');
        $id_studio = $request->id_studio ?? session('id_studio');
        $date      = $request->date ?? session('date');
        $jam       = $request->jam ?? session('jam');

        if (!$id_studio || !$date || !$jam) {
            return redirect('/home')->with('error', 'Sesi habis, silakan pilih kursi kembali.');
        }

        session([
            'id_film'   => $id_film,
            'id_studio' => $id_studio,
            'date'      => $date,
            'jam'       => $jam
        ]);

        // ================= JADWAL =================
        $jadwal = DB::table('jadwal_tayang')->where([
            ['id_film', $id_film],
            ['id_studio', $id_studio],
            ['tanggal', $date],
            ['jam_tayang', $jam]
        ])->first();

        if (!$jadwal) {
        dd([
            'id_film' => $id_film,
            'id_studio' => $id_studio,
            'date' => $date,
            'jam' => $jam,
        ]);
    }

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
                'movie'     => $movie->judul,
                'date'      => $jadwal->tanggal,
                'time'      => $jadwal->jam_tayang,
                'location'  => $location->nama_lokasi ?? '-',
                'price'     => $jadwal->harga ?? 50000,
                'seats'     => $seatLabels,
                'seat_ids'  => $seatIds,
                'id_film'   => $movie->id_film,
                'id_studio' => $id_studio,
                'poster'    => $movie->poster_film,
            ],
            'jadwal' => $jadwal
        ]);
    }

    // ================= PROCESS PAYMENT =================
    public function processPayment(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|exists:tabel_user,email',
            'method' => 'required|string',
        ], [
            'email.exists' => 'Email tidak terdaftar.'
        ]);

        $uniqueId = 'PYMT-' . Str::upper(Str::random(8));
        $seatIds  = $request->input('seats', []);

        DB::transaction(function () use ($request, $uniqueId, $seatIds) {

            DB::table('tabel_pembayaran')->insert([
                'id_pembayaran'     => $uniqueId,
                'id_jadwal'         => $request->id_jadwal,
                'full_name'         => $request->name,
                'email'             => $request->email,
                'metode_pembayaran' => $request->method,
                'id_kursi'          => json_encode($seatIds),
                'tanggal_bayar'     => now(),
            ]);

            foreach ($seatIds as $seatId) {
                DB::table('tabel_pemesanan')->insert([
                    'id_pembayaran' => $uniqueId,
                    'id_jadwal'     => $request->id_jadwal,
                    'id_kursi'      => (int) $seatId,
                ]);

                DB::table('tabel_kursi')
                    ->where('id_kursi', $seatId)
                    ->update(['status' => 'taken']);
            }
        });

        session()->forget('seats');

        return redirect()->route('payment.tiket', $uniqueId)
            ->with('success', 'Pembayaran berhasil');
    }
}
