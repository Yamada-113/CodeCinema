<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenerateJadwal extends Command
{
    protected $signature = 'jadwal:generate';
    protected $description = 'Generate jadwal tayang 7 hari ke depan';

    public function handle()
    {
        $filmIds = DB::table('tabel_film')->pluck('id_film')->toArray();
        $studioIds = DB::table('tabel_studio')->pluck('id_studio');

        $showTimes = [
            ['jam' => '10:00:00', 'harga' => 50000],
            ['jam' => '13:00:00', 'harga' => 50000],
            ['jam' => '16:30:00', 'harga' => 55000],
            ['jam' => '20:00:00', 'harga' => 60000],
        ];

        foreach ($filmIds as $filmId) {
            $randomFilmId = $filmIds[array_rand($filmIds)];

            DB::table('jadwal_tayang')->insert([
                'id_film'     => $randomFilmId,
                'id_studio'   => $studioId,
                'tanggal'     => $tanggal,
                'jam_tayang'  => $time['jam'],
                'harga_tiket' => $time['harga'],
            ]);
            
            foreach ($studioIds as $studioId) {

                for ($i = 0; $i < 7; $i++) {
                    $tanggal = Carbon::now()->addDays($i)->toDateString();

                    foreach ($showTimes as $time) {

                        $exists = DB::table('jadwal_tayang')
                            ->where('id_film', $filmId)
                            ->where('id_studio', $studioId)
                            ->where('tanggal', $tanggal)
                            ->where('jam_tayang', $time['jam'])
                            ->exists();

                        if ($exists) continue;

                        DB::table('jadwal_tayang')->insert([
                            'id_film'     => $filmId,
                            'id_studio'   => $studioId,
                            'tanggal'     => $tanggal,
                            'jam_tayang'  => $time['jam'],
                            'harga_tiket' => $time['harga'],
                        ]);
                    }
                }
            }
        }

        $this->info('Jadwal tayang 7 hari ke depan berhasil digenerate');
    }
}
