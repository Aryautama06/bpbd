<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use App\Models\Kriteria;       
use App\Models\Alternatif;     
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function ahp()
{
    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::all();
    $nilaiAlternatifs = NilaiAlternatif::all();
    
    // Hitung matriks perbandingan
    $matriksPerbandingan = [];
    foreach ($kriterias as $kriteria1) {
        foreach ($kriterias as $kriteria2) {
            if ($kriteria1->id === $kriteria2->id) {
                $matriksPerbandingan[$kriteria1->id][$kriteria2->id] = 1;
            } else {
                $matriksPerbandingan[$kriteria1->id][$kriteria2->id] = 
                    $kriteria1->bobot / $kriteria2->bobot;
            }
        }
    }
    
    // Hitung bobot kriteria
    $totalBobot = $kriterias->sum('bobot');
    $bobotKriteria = $kriterias->mapWithKeys(function ($kriteria) use ($totalBobot) {
        return [$kriteria->id => $kriteria->bobot / $totalBobot];
    });

    // Hitung nilai alternatif
    $nilaiAkhir = [];
    foreach ($alternatifs as $alternatif) {
        $total = 0;
        foreach ($kriterias as $kriteria) {
            $nilai = $nilaiAlternatifs
                ->where('alternatif_id', $alternatif->id)
                ->where('kriteria_id', $kriteria->id)
                ->first();

            if ($nilai) {
                $nilaiNormalisasi = $kriteria->jenis === 'Cost' 
                    ? 1 / $nilai->nilai 
                    : $nilai->nilai;
                
                $total += $nilaiNormalisasi * $bobotKriteria[$kriteria->id];
            }
        }
        $nilaiAkhir[$alternatif->id] = $total;
    }

    // Urutkan hasil
    arsort($nilaiAkhir);

    return view('perhitungan.ahp', compact(
        'kriterias', 
        'alternatifs', 
        'nilaiAlternatifs', 
        'matriksPerbandingan',
        'bobotKriteria', 
        'nilaiAkhir'
    ));
}
}

