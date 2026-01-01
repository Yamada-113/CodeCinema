<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\SeatsController;
use Illuminate\Http\Request;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/homeAdmin', [HomeController::class, 'admin']);
// Route::get('/movieDetails', [MovieController::class, 'show']);
Route::get('/movieDetails', [MovieController::class, 'booking']);
Route::get(
  '/movie/{film}/{lokasi?}/{studio?}/{date?}/{jam?}',
  [MovieController::class, 'booking']
)->name('movie.booking');

Route::get('/register', [LoginController::class, 'viewRegister']);
Route::get('/login', [LoginController::class, 'viewLogin']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/Admin/homeAdmin', function () {
    return view('Admin.homeAdmin');
});

// Route::view('/tiket','tiket',[
//     'movie' => 'Interstellar',
//     'date' => 'Thursday, 4 May',
//     'time' => '20:00',
//     'location' => 'Mall Taman Anggrek',
//     'seat' => 'A1', 'A2',
//     'code' => '61400'
// ]);

Route::post('/payment', [PaymentController::class, 'payment']);
Route::post('/payment/processPayment', [PaymentController::class, 'processPayment']);
Route::get('/tiket/{paymentId}', [PaymentController::class, 'tiket'])->name('payment.tiket');






