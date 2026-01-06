<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentAndTicketController;
use App\Http\Controllers\SeatsController;
use Illuminate\Http\Request;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/homeAdmin', [HomeController::class, 'admin']);
Route::get('/homeAdmin', [MovieController::class, 'admin'])->name('admin.home');

// Tambahkan rute untuk fitur CRUD (Tambah & Hapus)
Route::post('/movie/store', [MovieController::class, 'store'])->name('movie.store');
Route::put('/movie/update/{id}', [MovieController::class, 'update'])->name('movie.update');
Route::get('/admin/movie/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
Route::delete('/movie/destroy/{id}', [MovieController::class, 'destroy'])->name('movie.destroy');

Route::get('/movieDetails/{id}', [MovieController::class, 'booking'])->name('movie.details');
Route::get(
  '/movie/{film}/{lokasi?}/{studio?}/{date?}/{jam?}',
  [MovieController::class, 'booking']
)->name('movie.booking');

Route::get('/register', [LoginController::class, 'viewRegister']);
Route::get('/login', [LoginController::class, 'viewLogin']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::match(['GET','POST'], '/payment', [PaymentAndTicketController::class, 'payment'])
->name('payment');

Route::post('/payment/process', [PaymentAndTicketController::class, 'processPayment'])
    ->name('payment.process');

Route::get('/payment/tiket/{paymentId}', [PaymentAndTicketController::class, 'tiket'])
    ->name('payment.tiket');

// Route::get('/payment', [PaymentController::class, 'payment'])->name('payment.get');
// Route::get('/tiket', [TiketController::class, 'index'])->name('tiket.index');

Route::get('/search', [MovieController::class, 'search'])->name('movies.search');
// Di routes/web.php
