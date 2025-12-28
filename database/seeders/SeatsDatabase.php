<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsDatabase extends Seeder
{
    use WithoutModelEvents;

    public function run(): void {

        $rows = ['H','G','F','E','D','C','B','A'];

        foreach ($rows as $row) {
            for ($seat = 1; $seat <= 24; $seat++) {
                DB::table('tabel_kursi')->insert([
                    'id_studio'   => 1,
                    'nomor_kursi' => $seat,
                    'baris_kursi'    => $row,
                    'status'      => 'available'
                ]);
            }
        }

        DB::table('tabel_kursi')
        ->where('id_studio', 1)
        ->inRandomOrder()
        ->limit(6)
        ->update(['status' => 'taken']);

    }
}
