<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use App\Models\Kriteria;       
use App\Models\Alternatif;     
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    private $randomIndex = [
        1 => 0.00,
        2 => 0.00,
        3 => 0.58,
        4 => 0.90,
        5 => 1.12,
        6 => 1.24,
        7 => 1.32,
        8 => 1.41,
        9 => 1.45,
        10 => 1.49
    ];

    // Tambahkan property skala
    private $skala = [
        1 => 'Sama penting',
        2 => 'Nilai tengah antara 1 dan 3',
        3 => 'Sedikit lebih penting',
        4 => 'Nilai tengah antara 3 dan 5', 
        5 => 'Lebih penting',
        6 => 'Nilai tengah antara 5 dan 7',
        7 => 'Sangat lebih penting',
        8 => 'Nilai tengah antara 7 dan 9',
        9 => 'Mutlak lebih penting'
    ];

    public function index()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        $nilaiAlternatifs = NilaiAlternatif::all();

        return view('perhitungan.index', compact('kriterias', 'alternatifs', 'nilaiAlternatifs'));
    }

    private function hitungAHP()
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
        $nilaiAkhirAHP = [];
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
            $nilaiAkhirAHP[$alternatif->id] = $total;
        }

        return [
            'bobotKriteria' => $bobotKriteria,
            'nilaiAkhirAHP' => $nilaiAkhirAHP
        ];
    }

    public function ahp()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        $nilaiAlternatifs = NilaiAlternatif::all();

        // 1. Initialize the pairwise comparison matrix
        $matriksBerpasangan = [];
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($kriteria1->id === $kriteria2->id) {
                    $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = 1;
                } else {
                    // Get saved comparison value or use default
                    $nilai = PerbandinganKriteria::where('kriteria1_id', $kriteria1->id)
                        ->where('kriteria2_id', $kriteria2->id)
                        ->first();
                    
                    if ($nilai) {
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = $nilai->nilai;
                    } else {
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = 1;
                    }
                }
            }
        }

        // 2. Calculate column sums
        $jumlahKolom = [];
        foreach ($kriterias as $kriteria2) {
            $sum = 0;
            foreach ($kriterias as $kriteria1) {
                $sum += $matriksBerpasangan[$kriteria1->id][$kriteria2->id];
            }
            $jumlahKolom[$kriteria2->id] = $sum;
        }

        // 3. Normalize matrix and calculate priority weights
        $matriksNormal = [];
        $bobotPriority = [];
        foreach ($kriterias as $kriteria1) {
            $sum = 0;
            foreach ($kriterias as $kriteria2) {
                if ($jumlahKolom[$kriteria2->id] != 0) {
                    $matriksNormal[$kriteria1->id][$kriteria2->id] = 
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] / $jumlahKolom[$kriteria2->id];
                    $sum += $matriksNormal[$kriteria1->id][$kriteria2->id];
                } else {
                    $matriksNormal[$kriteria1->id][$kriteria2->id] = 0;
                }
            }
            $bobotPriority[$kriteria1->id] = $sum / count($kriterias);
        }

        // 4. Calculate weighted sum matrix
        $weightedSum = [];
        foreach ($kriterias as $kriteria1) {
            $sum = 0;
            foreach ($kriterias as $kriteria2) {
                $sum += $matriksBerpasangan[$kriteria1->id][$kriteria2->id] * 
                       ($bobotPriority[$kriteria2->id] ?? 0);
            }
            $weightedSum[$kriteria1->id] = $sum;
        }

        // 5. Calculate consistency measures
        $consistencyVector = [];
        $lambdaValues = [];
        
        foreach ($kriterias as $kriteria) {
            if (isset($bobotPriority[$kriteria->id]) && $bobotPriority[$kriteria->id] > 0) {
                $lambdaValues[] = $weightedSum[$kriteria->id] / $bobotPriority[$kriteria->id];
                $consistencyVector[$kriteria->id] = $weightedSum[$kriteria->id] / $bobotPriority[$kriteria->id];
            } else {
                $lambdaValues[] = 0;
                $consistencyVector[$kriteria->id] = 0;
            }
        }

        $n = count($kriterias);
        
        if ($n > 1) {
            $lambdaMax = array_sum($lambdaValues) / count($lambdaValues);
            $CI = ($lambdaMax - $n) / ($n - 1);
            $RI = $this->randomIndex[$n] ?? 1.49;
            $CR = $RI != 0 ? $CI / $RI : 0;
        } else {
            $lambdaMax = 1;
            $CI = 0;
            $CR = 0;
        }

        $hasilAHP = [
            'skala' => $this->skala,
            'matriksBerpasangan' => $matriksBerpasangan,
            'jumlahKolom' => $jumlahKolom,
            'matriksNormal' => $matriksNormal,
            'bobotKriteria' => $bobotPriority,
            'weightedSum' => $weightedSum,
            'consistencyVector' => $consistencyVector,
            'lambdaMax' => $lambdaMax,
            'consistencyIndex' => $CI,
            'consistencyRatio' => $CR,
            'isConsistent' => $CR <= 0.1
        ];

        return view('perhitungan.ahp', compact(
            'kriterias',
            'alternatifs',
            'nilaiAlternatifs',
            'hasilAHP'
        ))->with('randomIndex', $this->randomIndex);
    }

    public function topsis()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        $nilaiAlternatifs = NilaiAlternatif::all();

        // Dapatkan hasil AHP terlebih dahulu
        $hasilAHP = $this->hitungAHP();
        $bobotKriteria = $hasilAHP['bobotKriteria'];

        // Matrix keputusan menggunakan nilai AHP
        $matrix = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $nilai = $nilaiAlternatifs
                    ->where('alternatif_id', $alternatif->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->first();
                
                // Gunakan nilai dari AHP jika ada
                $nilaiAHP = $hasilAHP['nilaiAkhirAHP'][$alternatif->id] ?? 0;
                $matrix[$alternatif->id][$kriteria->id] = $nilai ? $nilaiAHP : 0;
            }
        }

        // Normalisasi matrix
        $normalizedMatrix = [];
        foreach ($kriterias as $kriteria) {
            $sum = 0;
            foreach ($alternatifs as $alternatif) {
                $sum += pow($matrix[$alternatif->id][$kriteria->id], 2);
            }
            $sqrt = sqrt($sum);

            foreach ($alternatifs as $alternatif) {
                $normalizedMatrix[$alternatif->id][$kriteria->id] = 
                    $matrix[$alternatif->id][$kriteria->id] / ($sqrt ?: 1);
            }
        }

        // Matrix terbobot menggunakan bobot dari AHP
        $weightedMatrix = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $weightedMatrix[$alternatif->id][$kriteria->id] = 
                    $normalizedMatrix[$alternatif->id][$kriteria->id] * $bobotKriteria[$kriteria->id];
            }
        }

        // Solusi ideal positif & negatif
        $positifIdeal = [];
        $negatifIdeal = [];
        foreach ($kriterias as $kriteria) {
            $values = array_column($weightedMatrix, $kriteria->id);
            
            if ($kriteria->jenis === 'Benefit') {
                $positifIdeal[$kriteria->id] = max($values);
                $negatifIdeal[$kriteria->id] = min($values);
            } else {
                $positifIdeal[$kriteria->id] = min($values);
                $negatifIdeal[$kriteria->id] = max($values);
            }
        }

        // Jarak solusi ideal
        $jarakPositif = [];
        $jarakNegatif = [];
        foreach ($alternatifs as $alternatif) {
            $sumPositif = 0;
            $sumNegatif = 0;
            
            foreach ($kriterias as $kriteria) {
                $sumPositif += pow($weightedMatrix[$alternatif->id][$kriteria->id] - $positifIdeal[$kriteria->id], 2);
                $sumNegatif += pow($weightedMatrix[$alternatif->id][$kriteria->id] - $negatifIdeal[$kriteria->id], 2);
            }
            
            $jarakPositif[$alternatif->id] = sqrt($sumPositif);
            $jarakNegatif[$alternatif->id] = sqrt($sumNegatif);
        }

        // Nilai preferensi
        $nilaiAkhir = [];
        foreach ($alternatifs as $alternatif) {
            $nilaiAkhir[$alternatif->id] = 
                $jarakNegatif[$alternatif->id] / 
                ($jarakPositif[$alternatif->id] + $jarakNegatif[$alternatif->id]);
        }

        // Urutkan hasil
        arsort($nilaiAkhir);

        return view('perhitungan.topsis', compact(
            'kriterias',
            'alternatifs',
            'hasilAHP',
            'matrix',
            'normalizedMatrix',
            'weightedMatrix',
            'positifIdeal',
            'negatifIdeal',
            'jarakPositif',
            'jarakNegatif',
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

    public function simpanNilai(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*.*' => 'required|numeric|min:1|max:100',
        ], [
            'nilai.required' => 'Nilai alternatif harus diisi',
            'nilai.*.*.required' => 'Semua nilai harus diisi',
            'nilai.*.*.numeric' => 'Nilai harus berupa angka',
            'nilai.*.*.min' => 'Nilai minimal adalah 1',
            'nilai.*.*.max' => 'Nilai maksimal adalah 100',
        ]);

        foreach ($request->nilai as $alternatifId => $kriteriaNilai) {
            foreach ($kriteriaNilai as $kriteriaId => $nilai) {
                NilaiAlternatif::updateOrCreate(
                    [
                        'alternatif_id' => $alternatifId,
                        'kriteria_id' => $kriteriaId
                    ],
                    ['nilai' => $nilai]
                );
            }
        }

        return redirect()
            ->route('perhitungan.ahp')
            ->with('success', 'Nilai alternatif berhasil disimpan');
    }

    public function simpanPerbandingan(Request $request)
    {
        $request->validate([
            'perbandingan' => 'required|array',
            'perbandingan.*.*' => 'required|numeric|min:0.11|max:9'
        ], [
            'perbandingan.required' => 'Data perbandingan harus diisi',
            'perbandingan.*.*.required' => 'Semua nilai perbandingan harus diisi',
            'perbandingan.*.*.numeric' => 'Nilai harus berupa angka',
            'perbandingan.*.*.min' => 'Nilai minimal adalah 1/9 (0.11)',
            'perbandingan.*.*.max' => 'Nilai maksimal adalah 9'
        ]);

        $kriterias = Kriteria::all();
        
        // Save to database
        foreach ($request->perbandingan as $kriteria1Id => $values) {
            foreach ($values as $kriteria2Id => $nilai) {
                // Update bobot for both criteria
                $kriteria1 = $kriterias->find($kriteria1Id);
                $kriteria2 = $kriterias->find($kriteria2Id);
                
                if ($kriteria1 && $kriteria2) {
                    $kriteria1->bobot = $nilai;
                    $kriteria2->bobot = 1 / $nilai;
                    
                    $kriteria1->save();
                    $kriteria2->save();
                }
            }
        }

        return redirect()
            ->route('perhitungan.ahp')
            ->with('success', 'Nilai perbandingan berhasil disimpan');
    }
}

