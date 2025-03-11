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
        'korban_jiwa',
        'kerusakan',
        'kerugian',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
