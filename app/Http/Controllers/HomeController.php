<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data film dari database
        $movies = DB::table('tabel_film')->get(); 

        // Kirim data ke view menggunakan compact
        return view('home', compact('movies'));
    }
    
    public function admin() {
        return view('/Admin/homeAdmin'); 
    }
}