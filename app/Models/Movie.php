<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // 1. Beritahu Laravel nama tabel kamu yang sebenarnya
    protected $table = 'tabel_film';

    // 2. Beritahu Laravel nama Primary Key kamu
    protected $primaryKey = 'id_film';

    // 3. Masukkan nama kolom agar bisa diisi saat "Add New Movie"
    protected $fillable = [
        'judul', 
        'genre', 
        'rating', 
        'durasi', 
        'direktor', 
        'deskripsi', 
        'poster_film'
    ];

}