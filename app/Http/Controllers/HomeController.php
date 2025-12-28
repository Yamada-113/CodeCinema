<?php
namespace App\Http\Controllers;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function admin() {
    return view('/Admin/homeAdmin'); 
    }
}
