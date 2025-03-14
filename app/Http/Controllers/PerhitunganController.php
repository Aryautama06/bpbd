<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use App\Models\Kriteria;       
use App\Models\Alternatif;     
use App\Models\NilaiAlternatif;
use App\Models\PerbandinganKriteria;
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

    public function hitungAHP()
    {
        // 1. Struktur Hierarki sudah terdefinisi di database (tabel kriterias)
        $kriterias = Kriteria::all();

        // 2. Menyusun Matriks Perbandingan Berpasangan
        $matriksBerpasangan = $this->getMatriksBerpasangan($kriterias);

        // 3. Normalisasi Matriks
        $matriksNormal = $this->normalisasiMatriks($matriksBerpasangan, $kriterias);

        // 4. Menghitung Bobot Prioritas
        $bobotPrioritas = $this->hitungBobotPrioritas($matriksNormal, $kriterias);

        // 5. Menghitung Nilai Eigen Maksimum (λmax)
        $lambdaMax = $this->hitungLambdaMax($matriksBerpasangan, $bobotPrioritas, $kriterias);

        // 6 & 7. Menghitung CI dan CR
        $konsistensi = $this->hitungKonsistensi($lambdaMax, count($kriterias));

        return [
            'matriksBerpasangan' => $matriksBerpasangan,
            'matriksNormal' => $matriksNormal,
            'bobotPrioritas' => $bobotPrioritas,
            'lambdaMax' => $lambdaMax,
            'konsistensi' => $konsistensi
        ];
    }

    private function getMatriksBerpasangan($kriterias)
    {
        $matriks = [];
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($kriteria1->id === $kriteria2->id) {
                    // Diagonal utama bernilai 1
                    $matriks[$kriteria1->id][$kriteria2->id] = 1;
                } else {
                    // Ambil nilai perbandingan dari database
                    $perbandingan = PerbandinganKriteria::where('kriteria1_id', $kriteria1->id)
                        ->where('kriteria2_id', $kriteria2->id)
                        ->first();

                    if ($perbandingan) {
                        $matriks[$kriteria1->id][$kriteria2->id] = $perbandingan->nilai;
                        // Nilai kebalikan untuk pasangan bersesuaian
                        $matriks[$kriteria2->id][$kriteria1->id] = 1 / $perbandingan->nilai;
                    } else {
                        // Default value jika belum ada perbandingan
                        $matriks[$kriteria1->id][$kriteria2->id] = 1;
                        $matriks[$kriteria2->id][$kriteria1->id] = 1;
                    }
                }
            }
        }
        return $matriks;
    }

    private function normalisasiMatriks($matriksBerpasangan, $kriterias)
    {
        $matriksNormal = [];
        
        // Hitung jumlah setiap kolom
        $jumlahKolom = [];
        foreach ($kriterias as $kriteria2) {
            $sum = 0;
            foreach ($kriterias as $kriteria1) {
                $sum += $matriksBerpasangan[$kriteria1->id][$kriteria2->id];
            }
            $jumlahKolom[$kriteria2->id] = $sum;
        }

        // Normalisasi dengan membagi setiap elemen dengan jumlah kolomnya
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($jumlahKolom[$kriteria2->id] != 0) {
                    $matriksNormal[$kriteria1->id][$kriteria2->id] = 
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] / $jumlahKolom[$kriteria2->id];
                } else {
                    $matriksNormal[$kriteria1->id][$kriteria2->id] = 0;
                }
            }
        }

        return $matriksNormal;
    }

    private function hitungBobotPrioritas($matriksNormal, $kriterias)
    {
        $bobot = [];
        foreach ($kriterias as $kriteria1) {
            $sum = 0;
            foreach ($kriterias as $kriteria2) {
                $sum += $matriksNormal[$kriteria1->id][$kriteria2->id];
            }
            // Bobot prioritas adalah rata-rata baris matriks normal
            $bobot[$kriteria1->id] = $sum / count($kriterias);
        }
        return $bobot;
    }

    private function hitungLambdaMax($matriksBerpasangan, $bobotPrioritas, $kriterias)
    {
        $lambdaValues = [];
        
        foreach ($kriterias as $kriteria1) {
            $sum = 0;
            foreach ($kriterias as $kriteria2) {
                $sum += $matriksBerpasangan[$kriteria1->id][$kriteria2->id] * $bobotPrioritas[$kriteria2->id];
            }
            if ($bobotPrioritas[$kriteria1->id] != 0) {
                $lambdaValues[] = $sum / $bobotPrioritas[$kriteria1->id];
            }
        }

        // λmax adalah rata-rata dari semua λ
        return array_sum($lambdaValues) / count($lambdaValues);
    }

    private function hitungKonsistensi($lambdaMax, $n)
    {
        // Hitung Consistency Index (CI)
        $CI = ($lambdaMax - $n) / ($n - 1);

        // Hitung Consistency Ratio (CR)
        $RI = $this->randomIndex[$n] ?? 1.49;
        $CR = $CI / $RI;

        return [
            'CI' => $CI,
            'CR' => $CR,
            'isConsistent' => $CR <= 0.1
        ];
    }

    public function ahp()
    {
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        $perbandinganValues = []; // Initialize empty or get from storage
        $hasilAHP = session('hasilAHP', []); // Get results from session if exists
        
        return view('perhitungan.ahp', compact('kriterias', 'perbandinganValues', 'hasilAHP'));
    }

    public function topsis()
    {
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        $alternatifs = Alternatif::orderBy('kode_alternatif')->get();
        $hasilAHP = session('hasilAHP');

        // Pastikan ada hasil AHP sebelum melanjutkan ke TOPSIS
        if (!$hasilAHP || !isset($hasilAHP['bobotPrioritas'])) {
            return redirect()
                ->route('perhitungan.ahp')
                ->with('error', 'Harap lakukan perhitungan AHP terlebih dahulu');
        }

        return view('perhitungan.topsis', compact('kriterias', 'alternatifs', 'hasilAHP'));
    }

    public function hitungTopsis(Request $request)
    {
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        $alternatifs = Alternatif::orderBy('kode_alternatif')->get();
        $hasilAHP = session('hasilAHP');
        $nilai = $request->input('nilai');

        // 1. Membuat matriks keputusan
        $matriksKeputusan = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $matriksKeputusan[$alternatif->id][$kriteria->id] = 
                    floatval($nilai[$alternatif->id][$kriteria->id]);
            }
        }

        // 2. Normalisasi matriks keputusan
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $sum = 0;
            foreach ($alternatifs as $alternatif) {
                $sum += pow($matriksKeputusan[$alternatif->id][$kriteria->id], 2);
            }
            $pembagi[$kriteria->id] = sqrt($sum);
        }

        $matriksNormal = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $matriksNormal[$alternatif->id][$kriteria->id] = 
                    $matriksKeputusan[$alternatif->id][$kriteria->id] / $pembagi[$kriteria->id];
            }
        }

        // 3. Pembobotan matriks yang dinormalisasi
        $matriksTerbobot = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $matriksTerbobot[$alternatif->id][$kriteria->id] = 
                    $matriksNormal[$alternatif->id][$kriteria->id] * $hasilAHP['bobotPrioritas'][$kriteria->id];
            }
        }

        // 4. Menentukan solusi ideal positif dan negatif
        $aPlus = [];
        $aMinus = [];
        foreach ($kriterias as $kriteria) {
            $nilai_kriteria = array_column($matriksTerbobot, $kriteria->id);
            if ($kriteria->jenis === 'benefit') {
                $aPlus[$kriteria->id] = max($nilai_kriteria);
                $aMinus[$kriteria->id] = min($nilai_kriteria);
            } else {
                $aPlus[$kriteria->id] = min($nilai_kriteria);
                $aMinus[$kriteria->id] = max($nilai_kriteria);
            }
        }

        // 5. Menghitung jarak dengan solusi ideal
        $dPlus = [];
        $dMinus = [];
        foreach ($alternatifs as $alternatif) {
            $sumPlus = 0;
            $sumMinus = 0;
            foreach ($kriterias as $kriteria) {
                $sumPlus += pow($matriksTerbobot[$alternatif->id][$kriteria->id] - $aPlus[$kriteria->id], 2);
                $sumMinus += pow($matriksTerbobot[$alternatif->id][$kriteria->id] - $aMinus[$kriteria->id], 2);
            }
            $dPlus[$alternatif->id] = sqrt($sumPlus);
            $dMinus[$alternatif->id] = sqrt($sumMinus);
        }

        // 6. Menghitung nilai preferensi
        $preferensi = [];
        foreach ($alternatifs as $alternatif) {
            $preferensi[$alternatif->id] = $dMinus[$alternatif->id] / ($dMinus[$alternatif->id] + $dPlus[$alternatif->id]);
        }

        // Urutkan hasil berdasarkan nilai preferensi
        arsort($preferensi);

        $hasilTOPSIS = [
            'matriksKeputusan' => $matriksKeputusan,
            'matriksNormal' => $matriksNormal,
            'matriksTerbobot' => $matriksTerbobot,
            'aPlus' => $aPlus,
            'aMinus' => $aMinus,
            'dPlus' => $dPlus,
            'dMinus' => $dMinus,
            'preferensi' => $preferensi
        ];

        session(['hasilTOPSIS' => $hasilTOPSIS]);

        return redirect()
            ->route('perhitungan.topsis')
            ->with('success', 'Perhitungan TOPSIS berhasil dilakukan');
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
        $perbandingan = $request->input('perbandingan');
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        
        // 1. Matriks Perbandingan Berpasangan
        $matriksBerpasangan = [];
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                if ($kriteria1->id === $kriteria2->id) {
                    $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = 1;
                } else {
                    if (isset($perbandingan[$kriteria1->id][$kriteria2->id])) {
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = floatval($perbandingan[$kriteria1->id][$kriteria2->id]);
                    } else if (isset($perbandingan[$kriteria2->id][$kriteria1->id])) {
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = 1 / floatval($perbandingan[$kriteria2->id][$kriteria1->id]);
                    } else {
                        $matriksBerpasangan[$kriteria1->id][$kriteria2->id] = 1;
                    }
                }
            }
        }

        // 2. Hitung Jumlah Kolom
        $jumlahKolom = [];
        foreach ($kriterias as $kriteria2) {
            $sum = 0;
            foreach ($kriterias as $kriteria1) {
                $sum += $matriksBerpasangan[$kriteria1->id][$kriteria2->id];
            }
            $jumlahKolom[$kriteria2->id] = $sum;
        }

        // 3. Normalisasi Matriks
        $matriksNormal = [];
        foreach ($kriterias as $kriteria1) {
            foreach ($kriterias as $kriteria2) {
                $matriksNormal[$kriteria1->id][$kriteria2->id] = 
                    $matriksBerpasangan[$kriteria1->id][$kriteria2->id] / $jumlahKolom[$kriteria2->id];
            }
        }

        // 4. Hitung Bobot Prioritas
        $bobotPrioritas = [];
        foreach ($kriterias as $kriteria1) {
            $sum = 0;
            foreach ($kriterias as $kriteria2) {
                $sum += $matriksNormal[$kriteria1->id][$kriteria2->id];
            }
            $bobotPrioritas[$kriteria1->id] = $sum / count($kriterias);
        }

        // 5. Hitung λmax
        $lambdaMax = 0;
        foreach ($kriterias as $kriteria) {
            $sum = 0;
            foreach ($kriterias as $kriteria2) {
                $sum += $matriksBerpasangan[$kriteria2->id][$kriteria->id] * $bobotPrioritas[$kriteria2->id];
            }
            $lambdaMax += $sum;
        }

        $n = count($kriterias);
        $lambdaMax = $lambdaMax / $n;

        // 6. Hitung CI
        $CI = ($n > 1) ? ($lambdaMax - $n) / ($n - 1) : 0;
        
        // 7. Hitung CR
        $RI = [0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $currentRI = ($n <= 10 && $n > 0) ? $RI[$n - 1] : 1.49;
        
        $CR = ($currentRI > 0) ? ($CI / $currentRI) : 0;
        $isConsistent = $CR <= 0.1;

        // Simpan hasil perhitungan
        $hasilAHP = [
            'matriksBerpasangan' => $matriksBerpasangan,
            'jumlahKolom' => $jumlahKolom,
            'matriksNormal' => $matriksNormal,
            'bobotPrioritas' => $bobotPrioritas,
            'lambdaMax' => $lambdaMax,
            'konsistensi' => [
                'CI' => $CI,
                'CR' => $CR,
                'RI' => $currentRI,
                'n' => $n,
                'isConsistent' => $isConsistent
            ],
            'showResults' => true // Flag untuk menampilkan hasil
        ];

        // Simpan ke session
        session(['hasilAHP' => $hasilAHP]);

        return redirect()
            ->route('perhitungan.ahp')
            ->with('success', 'Perbandingan berhasil disimpan dan dihitung');
    }

    // AHP Helper Methods
    private function buildPairwiseMatrix($kriterias, $perbandingan)
    {
        $matrix = [];
        foreach ($kriterias as $k1) {
            foreach ($kriterias as $k2) {
                if ($k1->id === $k2->id) {
                    $matrix[$k1->id][$k2->id] = 1;
                } else {
                    $nilai = $perbandingan
                        ->where('kriteria1_id', $k1->id)
                        ->where('kriteria2_id', $k2->id)
                        ->first();
                    
                    if ($nilai) {
                        $matrix[$k1->id][$k2->id] = $nilai->nilai;
                        $matrix[$k2->id][$k1->id] = 1 / $nilai->nilai;
                    } else {
                        $matrix[$k1->id][$k2->id] = 1;
                        $matrix[$k2->id][$k1->id] = 1;
                    }
                }
            }
        }
        return $matrix;
    }

    private function calculatePriorityWeights($matrix, $kriterias)
    {
        $weights = [];
        $n = count($kriterias);

        // Calculate column sums
        $colSums = [];
        foreach ($kriterias as $k2) {
            $sum = 0;
            foreach ($kriterias as $k1) {
                $sum += $matrix[$k1->id][$k2->id];
            }
            $colSums[$k2->id] = $sum;
        }

        // Normalize and calculate average
        foreach ($kriterias as $k1) {
            $sum = 0;
            foreach ($kriterias as $k2) {
                $sum += $matrix[$k1->id][$k2->id] / $colSums[$k2->id];
            }
            $weights[$k1->id] = $sum / $n;
        }

        return $weights;
    }

    private function checkConsistency($matrix, $weights, $kriterias)
    {
        $n = count($kriterias);
        
        // Calculate weighted sum
        $weightedSum = [];
        foreach ($kriterias as $k1) {
            $sum = 0;
            foreach ($kriterias as $k2) {
                $sum += $matrix[$k1->id][$k2->id] * $weights[$k2->id];
            }
            $weightedSum[$k1->id] = $sum;
        }

        // Calculate lambda max
        $lambdaMax = 0;
        foreach ($kriterias as $k) {
            $lambdaMax += $weightedSum[$k->id] / ($weights[$k->id] * $n);
        }

        // Calculate CI and CR
        $CI = ($lambdaMax - $n) / ($n - 1);
        $RI = $this->randomIndex[$n] ?? 1.49;
        $CR = $CI / $RI;

        return [
            'CI' => $CI,
            'CR' => $CR,
            'isConsistent' => $CR <= 0.1
        ];
    }

    // Metode Helper TOPSIS
    private function buildDecisionMatrix($alternatifs, $kriterias, $nilaiAlternatifs)
    {
        $matrix = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $nilai = $nilaiAlternatifs
                    ->where('alternatif_id', $alternatif->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->first();
                
                $matrix[$alternatif->id][$kriteria->id] = $nilai ? $nilai->nilai : 0;
            }
        }
        return $matrix;
    }

    private function normalizeMatrix($matrix)
    {
        $normalizedMatrix = [];
        $pembagi = [];

        // Hitung pembagi (akar kuadrat jumlah kuadrat)
        foreach ($matrix as $altId => $kriteriaValues) {
            foreach ($kriteriaValues as $kritId => $nilai) {
                if (!isset($pembagi[$kritId])) {
                    $pembagi[$kritId] = 0;
                }
                $pembagi[$kritId] += pow($nilai, 2);
            }
        }

        // Normalisasi setiap nilai
        foreach ($matrix as $altId => $kriteriaValues) {
            foreach ($kriteriaValues as $kritId => $nilai) {
                $normalizedMatrix[$altId][$kritId] = 
                    $pembagi[$kritId] != 0 ? $nilai / sqrt($pembagi[$kritId]) : 0;
            }
        }

        return $normalizedMatrix;
    }

    private function calculateWeightedMatrix($normalizedMatrix, $weights)
    {
        $weightedMatrix = [];
        foreach ($normalizedMatrix as $altId => $kriteriaValues) {
            foreach ($kriteriaValues as $kritId => $nilai) {
                $weightedMatrix[$altId][$kritId] = $nilai * ($weights[$kritId] ?? 0);
            }
        }
        return $weightedMatrix;
    }

    private function determineIdealSolutions($weightedMatrix, $kriterias)
    {
        $positif = [];
        $negatif = [];

        // Inisialisasi array untuk menyimpan semua nilai per kriteria
        $nilaiPerKriteria = [];
        foreach ($weightedMatrix as $altValues) {
            foreach ($altValues as $kritId => $nilai) {
                $nilaiPerKriteria[$kritId][] = $nilai;
            }
        }

        // Tentukan solusi ideal positif dan negatif
        foreach ($kriterias as $kriteria) {
            if ($kriteria->jenis === 'Benefit') {
                $positif[$kriteria->id] = max($nilaiPerKriteria[$kriteria->id]);
                $negatif[$kriteria->id] = min($nilaiPerKriteria[$kriteria->id]);
            } else {
                $positif[$kriteria->id] = min($nilaiPerKriteria[$kriteria->id]);
                $negatif[$kriteria->id] = max($nilaiPerKriteria[$kriteria->id]);
            }
        }

        return [
            'positif' => $positif,
            'negatif' => $negatif
        ];
    }

    private function calculateDistances($weightedMatrix, $solusiIdeal)
    {
        $jarakPositif = [];
        $jarakNegatif = [];

        foreach ($weightedMatrix as $altId => $kriteriaValues) {
            $sumPositif = 0;
            $sumNegatif = 0;

            foreach ($kriteriaValues as $kritId => $nilai) {
                $sumPositif += pow($nilai - $solusiIdeal['positif'][$kritId], 2);
                $sumNegatif += pow($nilai - $solusiIdeal['negatif'][$kritId], 2);
            }

            $jarakPositif[$altId] = sqrt($sumPositif);
            $jarakNegatif[$altId] = sqrt($sumNegatif);
        }

        return [
            'positif' => $jarakPositif,
            'negatif' => $jarakNegatif
        ];
    }

    private function calculatePreferences($jarak)
    {
        $preferensi = [];
        foreach ($jarak['positif'] as $altId => $dPlus) {
            $dMinus = $jarak['negatif'][$altId];
            $preferensi[$altId] = $dMinus / ($dPlus + $dMinus);
        }
        return $preferensi;
    }

    private function rankAlternatives($preferensi)
    {
        arsort($preferensi); // Urutkan dari nilai tertinggi ke terendah
        $peringkat = [];
        $rank = 1;
        
        foreach ($preferensi as $altId => $nilai) {
            $peringkat[$altId] = [
                'nilai' => $nilai,
                'peringkat' => $rank++
            ];
        }
        
        return $peringkat;
    }
}

