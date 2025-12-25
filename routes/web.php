<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/home', function () {
    return view('home');
});
Route::get('/movie', function () {
    return view('movie');
});
Route::get('/payment', function () {
    // simulasi data booking (nantinya dari halaman movie)
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

