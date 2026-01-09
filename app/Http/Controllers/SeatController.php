SeatController.php

<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function copySeatsToAllStudiosFast()
    {
        $templateStudio = 1; 


        $studios = DB::table('studios')
            ->whereNotIn('id_studio', function($query) use ($templateStudio) {
                $query->select('id_studio')
                      ->from('tabel_kursi');
            })
            ->pluck('id_studio');

        foreach ($studios as $studioId) {
            DB::statement("
            INSERT INTO tabel_kursi (id_studio, nomor_kursi, baris_kursi, status)
            SELECT $studioId, nomor_kursi, baris_kursi, 'available'
            FROM tabel_kursi
            WHERE id_studio = $templateStudio");

        }

        return "Seats copied to all new studios!";
    }
}