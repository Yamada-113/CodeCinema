<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/movieDetails', [MovieController::class, 'show']);


Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
