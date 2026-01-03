<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentAndTicketController extends Controller
{

    public function payment(Request $request)
{
    if (
        !$request->filled(['id_studio', 'date', 'jam']) ||
        !$request->has('seats')
    ) {
        return redirect()->back()
            ->with('error', 'Silakan pilih kursi terlebih dahulu.');
    }

    $seatIds = $request->seats;

    $jadwal = DB::table('jadwal_tayang')
        ->where('id_studio', $request->id_studio)
        ->where('tanggal', $request->date)
        ->where('jam_tayang', $request->jam)
        ->first();

    $movie = DB::table('tabel_film')
        ->where('id_film', $jadwal->id_film)
        ->first();

    $studio = DB::table('tabel_studio')
        ->where('id_studio', $jadwal->id_studio)
        ->first();

    $lokasi = DB::table('tabel_lokasi')
        ->where('id_lokasi', $studio->id_lokasi)
        ->first();

    $seatLabels = DB::table('tabel_kursi')
        ->whereIn('id_kursi', $seatIds)
        ->selectRaw("CONCAT(baris_kursi, nomor_kursi) AS seat")
        ->pluck('seat')
        ->toArray();

    $booking = [
        'id_jadwal' => $jadwal->id_jadwal,
        'seat_ids'  => $seatIds,
        'movie'     => $movie->judul,
        'poster'    => $movie->poster_film,
        'date'      => $jadwal->tanggal,
        'time'      => $jadwal->jam_tayang,
        'location'  => $lokasi->nama_lokasi,
        'studio'    => $studio->nama_studio,
        'price'     => $jadwal->harga_tiket,
        'seats'     => $seatLabels,
    ];

    return view('payment', compact('booking', 'jadwal'));
}

    public function processPayment(Request $request)
    {
        $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|exists:tabel_user,email',
        'method'    => 'required|string',
        ], [
            'email.exists' => 'Email belum terdaftar. Silakan gunakan email yang terdaftar.',
        ]);

        $paymentId = 'PYMT-' . Str::upper(Str::random(8));
        $seatIds   = $request->seats;

        DB::transaction(function () use ($request, $paymentId, $seatIds) {

            DB::table('tabel_pembayaran')->insert([
                'id_pembayaran'     => $paymentId,
                'id_jadwal'         => $request->id_jadwal,
                'full_name'         => $request->name,
                'email'             => $request->email,
                'metode_pembayaran' => $request->method,
                'id_kursi'          => json_encode($seatIds),
                'tanggal_bayar'     => now(),
            ]);

            foreach ($seatIds as $seatId) {

                DB::table('tabel_pemesanan')->insert([
                    'id_pembayaran' => $paymentId,
                    'id_jadwal'     => $request->id_jadwal,
                    'id_kursi'      => $seatId,
                ]);

                DB::table('tabel_kursi')
                    ->where('id_kursi', $seatId)
                    ->update(['status' => 'taken']);
            }
        });

        return redirect()->route('payment.tiket', $paymentId)
            ->with('success', 'Pembayaran berhasil');
    }

    public function tiket($paymentId)
    {
        $ticket = DB::table('tabel_pembayaran AS p')
            ->join('jadwal_tayang AS j', 'p.id_jadwal', '=', 'j.id_jadwal')
            ->join('tabel_film AS f', 'j.id_film', '=', 'f.id_film')
            ->join('tabel_studio AS s', 'j.id_studio', '=', 's.id_studio')
            ->join('tabel_lokasi AS l', 's.id_lokasi', '=', 'l.id_lokasi')
            ->where('p.id_pembayaran', $paymentId)
            ->select(
                'p.id_pembayaran',
                'p.full_name',
                'p.email',
                'p.metode_pembayaran',
                'p.id_kursi',
                'p.tanggal_bayar',
                'j.tanggal',
                'j.jam_tayang',
                'j.harga_tiket',
                'f.judul',
                'f.poster_film',
                's.nama_studio',
                'l.nama_lokasi'
            )
            ->first();

        if (!$ticket) abort(404);

        $seatIds = json_decode($ticket->id_kursi, true);

        $seats = DB::table('tabel_kursi')
            ->whereIn('id_kursi', $seatIds)
            ->selectRaw("CONCAT(baris_kursi, nomor_kursi) AS seat")
            ->pluck('seat')
            ->toArray();

        return view('tiket', compact('ticket', 'seats'));
    }
}
