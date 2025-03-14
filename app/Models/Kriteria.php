<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;
    
    protected $table = 'kriterias';
    
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'ahp_weight',
        'jenis'
    ];

    const JENIS_BENEFIT = 'benefit';
    const JENIS_COST = 'cost';

    public static function jenisOptions()
    {
        return [
            self::JENIS_BENEFIT => 'Benefit (Keuntungan)',
            self::JENIS_COST => 'Cost (Biaya)'
        ];
    }

    protected $casts = [
        'bobot' => 'integer' // Changed from decimal:4 to integer
    ];

    public static function rules($id = null)
    {
        return [
            'kode_kriteria' => 'required|string|max:10|unique:kriterias,kode_kriteria,' . $id,
            'nama_kriteria' => 'required|string|max:255',
            'jenis' => 'required|in:benefit,cost',
        ];
    }

    public function getJenisLabelAttribute()
    {
        return self::jenisOptions()[$this->jenis] ?? $this->jenis;
    }

    public function getJenisBadgeClassAttribute()
    {
        return $this->jenis === self::JENIS_BENEFIT 
            ? 'bg-blue-100 text-blue-800'
            : 'bg-purple-100 text-purple-800';
    }
}
