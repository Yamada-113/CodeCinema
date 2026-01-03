<!-- <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class TiketController extends Controller
// {

//     public function checkout(Request $request)
//     {
//         $user = DB::table('tabel_user')->where('email', $request->email)->first();

//         if (!$user) {
//             return back()->with('error', 'Email tidak ditemukan! Silahkan gunakan email yang terdaftar.');
//         }

//         $paymentId = DB::table('tabel_pembayaran')->insertGetId([
//             'id_film'      => $request->id_film,
//             'id_studio'    => $request->id_studio,
//             'total_harga'  => $request->total_harga,
//             'status'       => 'Success', 
//             'created_at'   => now(),
//         ]);

//         if ($request->has('seats')) {
//             foreach ($request->seats as $id_kursi) {
//                 DB::table('tabel_pemesanan')->insert([
//                     'id_pembayaran' => $paymentId,
//                     'id_kursi'      => $id_kursi,
//                 ]);
//             }
//         }

//         return redirect()->route('ticket.result', ['paymentId' => $paymentId]);
//     }

//     public function result($paymentId)
//     {
//         $payment = DB::table('tabel_pembayaran')
//             ->where('id_pembayaran', $paymentId)
//             ->first();

//         if (!$payment) {
//             abort(404, 'Data pembayaran tidak ditemukan');
//         }

//         $film = DB::table('tabel_film')
//             ->where('id_film', $payment->id_film)
//             ->first();

//         $studio = DB::table('tabel_studio')
//             ->where('id_studio', $payment->id_studio)
//             ->first();

//         $lokasi = DB::table('tabel_lokasi')
//             ->where('id_lokasi', $studio->id_lokasi ?? null)
//             ->first();

//         $seats = DB::table('tabel_pemesanan')
//             ->join('tabel_kursi', 'tabel_pemesanan.id_kursi', '=', 'tabel_kursi.id_kursi')
//             ->where('tabel_pemesanan.id_pembayaran', $paymentId)
//             ->select('tabel_kursi.baris_kursi', 'tabel_kursi.nomor_kursi')
//             ->get();

//         return view('ticket', compact('payment', 'film', 'studio', 'lokasi', 'seats'));
//     }
// }