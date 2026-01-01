<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $seatIds = $request->input('seats', []); 

        // Ambil data kursi
        $seats = DB::table('tabel_kursi')
                    ->whereIn('id_kursi', $seatIds)
                    ->get();

        // Gabungkan baris + nomor
        $seatLabels = $seats->map(function($s) {
            return $s->baris_kursi . $s->nomor_kursi;
        })->toArray();

        // Ambil jadwal + harga + studio
        $jadwal = DB::table('jadwal_tayang')
                    ->where('id_studio', $request->input('id_studio'))
                    ->where('tanggal', $request->input('date'))
                    ->where('jam_tayang', $request->input('jam'))
                    ->first();

        // Ambil info studio + lokasi
        $studio = DB::table('tabel_studio')
                    ->where('id_studio', $request->input('id_studio'))
                    ->first();

        $lokasi = DB::table('tabel_lokasi')
                    ->where('id_lokasi', $studio->id_lokasi)
                    ->first();

        // Ambil info film
        $movie = DB::table('tabel_film')
                ->where('id_film', $jadwal->id_film)
                ->first();

        // Prepare booking array
        $booking = [
            'id_film'   => $movie->id_film,
            'id_studio' => $studio->id_studio,
            'movie' => $movie->judul ?? '-',
            'date' => $jadwal->tanggal ?? '-',
            'time' => $jadwal->jam_tayang ?? '-',
            'location' => $lokasi->nama_lokasi ?? '-',
            'seats' => $seatLabels,
            'seat_ids' => $seatIds,
            'price' => $jadwal->harga_tiket ?? 0
        ];

    return view('payment', compact('booking', 'jadwal'));
    }

    public function processPayment(Request $request)
    {
        
        $uniqueId = 'PYMT-' . Str::upper(Str::random(8));
        $seatIds = $request->input('seats', []);

        // Validasi form (opsional, tapi aman)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'method' => 'required|string',
        ]);

        // Simpan pembayaran ke DB
        $paymentId = DB::table('tabel_pembayaran')->insert([
        'id_pembayaran' => $uniqueId,
        'id_jadwal' => $request->id_jadwal,
        'full_name' => $request->name,
        'email' => $request->email,
        'metode_pembayaran' => $request->method,
        'id_kursi' => json_encode($seatIds),
        'tanggal_bayar' => now(),
    ]);

    foreach ($request->seats as $seatId) {
    DB::table('tabel_pemesanan')->insert([
        'id_pembayaran' => $uniqueId,
        'id_jadwal' => $request->id_jadwal,
        'id_kursi' => (int) $seatId,
    ]);

    // $jadwalId  = $request->query('id_jadwal');

    // $takenSeats = DB::table('tabel_pemesanan')
    // ->where('id_jadwal', $jadwalId)
    // ->pluck('id_kursi')
    // ->toArray();

     DB::table('tabel_kursi')
        ->whereIn('id_kursi', $seatIds)
        ->update(['status' => 'taken']);

    }

        return redirect()->route('payment.tiket', $uniqueId);
    }

    public function tiket($paymentId)
    {
    // Ambil data pembayaran berdasarkan ID
    $ticket = DB::table('tabel_pembayaran as p')
    ->join('jadwal_tayang as j', 'p.id_jadwal', '=', 'j.id_jadwal')
    ->join('tabel_film as f', 'j.id_film', '=', 'f.id_film')
    ->join('tabel_studio as s', 'j.id_studio', '=', 's.id_studio')
    ->join('tabel_lokasi as l', 's.id_lokasi', '=', 'l.id_lokasi')
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

    $seatIds = json_decode($ticket->id_kursi, true);

    $seats = DB::table('tabel_kursi')
        ->whereIn('id_kursi', $seatIds)
        ->get();


    return view('tiket', compact('ticket', 'seats'));

    }


}
