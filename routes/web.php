<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\PaymentAndTicketController;
use App\Http\Controllers\SeatsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

// ================= HOME =================
Route::get('/home', [HomeController::class, 'index']);
Route::get('/homeAdmin', [MovieController::class, 'admin'])->name('admin.home');

// ================= MOVIE CRUD =================
Route::post('/movie/store', [MovieController::class, 'store'])->name('movie.store');
Route::put('/movie/update/{id}', [MovieController::class, 'update'])->name('movie.update');
Route::get('/admin/movie/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
Route::delete('/movie/destroy/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');

// ================= MOVIE BOOKING =================
Route::get('/movieDetails/{id}', [MovieController::class, 'booking'])->name('movie.details');
Route::get(
    '/movie/{film}/{lokasi?}/{studio?}/{date?}/{jam?}',
    [MovieController::class, 'booking']
)->name('movie.booking');

// ================= AUTH =================
Route::get('/register', [LoginController::class, 'viewRegister']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/login', [LoginController::class, 'viewLogin']);
Route::post('/login', [LoginController::class, 'login']);

// ================= PAYMENT =================
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment.get');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])
    ->name('payment.process');

// ================= TICKET =================
Route::get('/payment/tiket/{paymentId}', [TiketController::class, 'result'])
    ->name('payment.tiket');

// ================= SEARCH =================
Route::get('/search', [MovieController::class, 'search'])->name('movies.search');

Route::get('/generate-seats', [SeatController::class, 'copySeatsToAllStudiosFast']);
// Di routes/web.php

// ================= PROFILE =================
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
