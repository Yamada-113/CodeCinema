<?php
namespace App\Http\Controllers;
use App\Models\Movie;

class MovieController extends Controller
{
    public function show()
    {
        return view('movieDetails');
    }
}
