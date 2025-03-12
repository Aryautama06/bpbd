<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    protected $table = 'dana';
    
    protected $fillable = [
        'kode_anggaran',
        'nama_kegiatan',
        'jenis_dana',
        'jumlah',
        'tanggal_terima',
        'status',
        'keterangan',
        'dokumen'
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
        'jumlah' => 'decimal:2'
    ];
}
