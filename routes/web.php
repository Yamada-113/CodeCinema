<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/movieDetails', [MovieController::class, 'show']);
//Route::get('/movieDetails/taken', [MovieController::class, 'taken']);

Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/payment', function () {
    
    $booking = session('booking', [
        'movie' => 'Interstellar',
        'date' => 'Thursday, 4 May',
        'time' => '20:00',
        'seats' => ['A1', 'A2'],
        'price' => 50000
    ]);

    return view('payment', compact('booking'));
});
Route::post('/payment/process', function (Request $request) {
    $request->validate([
        'name'   => 'required',
        'email'  => 'required|email',
        'method' => 'required'
    ]);

    session()->forget('booking');

    return redirect('/payment')
        ->with('success', 'Pembayaran berhasil! Tiket Anda telah dipesan.');
});


Route::post('/set-location', function (Request $request) {
    session(['location' => $request->location]);
    return back();
});


Route::view('/tiket','tiket',[
    'movie' => 'Interstellar',
    'date' => 'Thursday, 4 May',
    'time' => '20:00',
    'location' => 'Mall Taman Anggrek',
    'seat' => 'A1', 'A2',
    'code' => '61400'
]);





