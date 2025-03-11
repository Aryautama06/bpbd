<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'status',
        'no_hp', 
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];
}