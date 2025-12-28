<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Movie;

class MovieController extends Controller
{

    public function seat($studioId)
    {
        $seats = DB::table('tabel_kursi')
            ->where('id_studio', $studioId)
            ->orderBy('nomor_kursi')
            ->orderBy('baris_kursi')
            ->get()
            ->groupBy('baris_kursi');

        return view('movieDetails', compact('seats'));
    }

}
