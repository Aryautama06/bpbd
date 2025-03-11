<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 'peralatan';
    
    protected $fillable = [
        'nama_alat',
        'kode_alat',
        'kategori',
        'jumlah',
        'kondisi',
        'spesifikasi',
        'lokasi_penyimpanan',
        'tanggal_pengadaan',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_pengadaan' => 'date'
    ];
}
