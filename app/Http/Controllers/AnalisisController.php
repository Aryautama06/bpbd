<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        // Check if AHP calculation exists
        if (!session()->has('hasilAHP')) {
            return redirect()
                ->route('perhitungan.ahp')
                ->with('error', 'Harap lakukan perhitungan AHP terlebih dahulu');
        }

        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        $alternatifs = Alternatif::orderBy('kode_alternatif')->get();
        $hasilAHP = session('hasilAHP');

        // Update each kriteria's ahp_weight from session
        foreach ($kriterias as $kriteria) {
            $kriteria->ahp_weight = $hasilAHP['bobotPrioritas'][$kriteria->id] ?? 0;
        }

        return view('analisis.index', compact('kriterias', 'alternatifs'));
    }
}