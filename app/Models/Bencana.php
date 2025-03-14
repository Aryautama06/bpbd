<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'jenis_bencana',
        'lokasi',
        'kecamatan',
        'deskripsi',
        'dampak',
        'dampak_korban',
        'dampak_kerusakan',
        'status',
        'kerugian'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    protected $guarded = [];
}
