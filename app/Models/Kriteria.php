<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'jenis',
        'keterangan'
    ];

    // Tambahkan ini jika Anda ingin menggunakan kolom selain id
    public function getRouteKeyName()
    {
        return 'id';
    }
}
