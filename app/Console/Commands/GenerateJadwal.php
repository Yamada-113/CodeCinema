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
        $filmId = DB::table('tabel_film')->pluck('id_film');;
        $studioIds = DB::table('tabel_studio')->pluck('id_studio');

        $showTimes = [
            ['jam' => '10:00:00', 'harga' => 50000],
            ['jam' => '13:00:00', 'harga' => 50000],
            ['jam' => '16:30:00', 'harga' => 55000],
            ['jam' => '20:00:00', 'harga' => 60000],
        ];

        foreach ($studioIds as $studioId) {
            for ($i = 0; $i < 7; $i++) {
                $tanggal = Carbon::now()->addDays($i)->toDateString();

                $exists = DB::table('jadwal_tayang')
                    ->where('id_studio', $studioId)
                    ->where('tanggal', $tanggal)
                    ->exists();

                if ($exists) continue;

                foreach ($showTimes as $time) {
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

        $this->info('Jadwal 7 hari berhasil digenerate');
    }
}
