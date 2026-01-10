<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTayang extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tayang';

    protected $primaryKey = 'id_jadwal';

    public $timestamps = false; 

    protected $fillable = [
        'id_film',
        'id_studio',
        'tanggal',
        'jam_tayang',
        'harga_tiket'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_film', 'id_film');
    }
}
