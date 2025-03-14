<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerbandinganKriteria extends Model
{
    protected $table = 'perbandingan_kriterias';
    
    protected $fillable = [
        'kriteria1_id',
        'kriteria2_id',
        'nilai'
    ];

    protected $casts = [
        'nilai' => 'float'
    ];

    public function kriteria1(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria1_id');
    }

    public function kriteria2(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria2_id');
    }
}
