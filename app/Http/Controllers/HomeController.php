<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->has('role') && session('role') === 'admin') {
        return redirect()->route('admin.home');
    }
        // Ambil semua data film dari database
        $movies = DB::table('tabel_film')->get(); 

        // Kirim data ke view menggunakan compact
        return view('home', compact('movies'));
    }
    
    public function admin() {
        
        $movies = DB::table('tabel_film')->get();
        return view('Admin.homeAdmin', compact('movies')); 
    }
}