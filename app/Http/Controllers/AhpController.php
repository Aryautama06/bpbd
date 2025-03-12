<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class AhpController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        $nilaiAlternatifs = NilaiAlternatif::all();
        
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

        return view('ahp.index', compact(
            'kriterias', 
            'alternatifs', 
            'nilaiAlternatifs', 
            'bobotKriteria', 
            'nilaiAkhir'
        ));
    }

    public function nilaiAlternatif(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatif,id',
            'kriteria_id' => 'required|exists:kriteria,id',
            'nilai' => 'required|numeric|min:1|max:100'
        ]);

        NilaiAlternatif::updateOrCreate(
            [
                'alternatif_id' => $request->alternatif_id,
                'kriteria_id' => $request->kriteria_id
            ],
            ['nilai' => $request->nilai]
        );

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }
}