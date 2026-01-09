<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsDatabase extends Seeder
{
    public function run()
    {
        // Daftar baris (A-H misal)
        $rows = range('A', 'H'); 
        $seatCount = 16; // 16 kursi per baris

        // Ambil semua studio beserta id_lokasi
        $studios = DB::table('tabel_studio')
            ->select('id_studio', 'id_lokasi')
            ->get();

        foreach ($studios as $studio) {
            $studioId  = $studio->id_studio;
            $lokasiId  = $studio->id_lokasi;

            foreach ($rows as $row) {
                for ($num = 1; $num <= $seatCount; $num++) {
                    // Cek dulu, kalau kursi sudah ada skip
                    $exists = DB::table('tabel_kursi')
                        ->where('id_studio', $studioId)
                        ->where('baris_kursi', $row)
                        ->where('nomor_kursi', $num)
                        ->exists();

                    if (!$exists) {
                        DB::table('tabel_kursi')->insert([
                            'id_studio'   => $studioId,
                            'id_lokasi'   => $lokasiId, // pastikan ada lokasi
                            'baris_kursi' => $row,
                            'nomor_kursi' => $num,
                            'status'      => 'available', // default
                        ]);
                    }
                }
            }
        }

        $this->command->info('Seeder kursi dengan id_lokasi selesai dijalankan!');
    }
}
