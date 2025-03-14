<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilPerhitungan extends Model
{
    use HasFactory;

    protected $table = 'hasil_perhitungan';
    
    protected $fillable = [
        'kode_perhitungan',
        'nama_perhitungan',
        'deskripsi',
        'bobot_ahp',
        'hasil_topsis'
    ];

    protected $casts = [
        'bobot_ahp' => 'array',
        'hasil_topsis' => 'array'
    ];
}