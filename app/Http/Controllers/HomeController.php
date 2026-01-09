<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // Jika admin nyasar ke sini, lempar ke halaman admin
    if (session()->has('role') && session('role') === 'admin') {
        return redirect()->route('admin.home');
    }

    // Ambil data film Now Playing untuk User
    $movies = DB::table('tabel_film')->where('status', 'now_playing')->get(); 

    // Ambil data film Coming Soon untuk User
    $comingSoonMovies = DB::table('tabel_film')->where('status', 'coming_soon')->get(); 

    // Kirim kedua variabel ke view 'home'
    return view('home', compact('movies', 'comingSoonMovies'));
}
    
    public function admin() {
        
        $movies = DB::table('tabel_film')->get();
        return view('Admin.homeAdmin', compact('movies')); 
    }
}