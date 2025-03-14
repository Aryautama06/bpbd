<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';
    
    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
        'deskripsi'
    ];

    public static function rules($id = null)
    {
        return [
            'kode_alternatif' => 'required|string|max:10|unique:alternatifs,kode_alternatif,' . $id,
            'nama_alternatif' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ];
    }

    public function nilaiAlternatifs(): HasMany
    {
        return $this->hasMany(NilaiAlternatif::class);
    }
}
