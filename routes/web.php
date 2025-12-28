<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/homeAdmin', [HomeController::class, 'admin']);
Route::get('/movieDetails', [MovieController::class, 'show']);
Route::get('/register', [LoginController::class, 'viewRegister']);
Route::get('/login', [LoginController::class, 'viewLogin']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/Admin/homeAdmin', function () {
    return view('Admin.homeAdmin');
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





