<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perhitungan TOPSIS - BPBD</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tambahkan script Tailwind CDN sebagai fallback -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bpbd': {
                            primary: '#E63946',
                            secondary: '#1D3557',
                            accent: '#457B9D',
                            light: '#F1FAEE',
                            dark: '#1D3557'
                        }
                    }
                }
            }
        }
    </script>
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="min-h-screen bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')
        <div class="lg:pl-64">
            <main>
                <!-- Header -->
                <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary to-bpbd-accent">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                    </div>
                    <div class="relative py-12 px-8">
                        <div class="max-w-7xl mx-auto">
                            <div class="flex items-center gap-6">
                                <div class="p-4 bg-white/10 backdrop-blur-lg rounded-2xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-white">Perhitungan TOPSIS</h1>
                                    <p class="text-blue-100 mt-1">Menggunakan hasil bobot dari AHP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto space-y-8">
                        <!-- Penjelasan Metode -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900">Metode TOPSIS</h2>
                                <div class="mt-4 prose prose-blue">
                                    <p>TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution) adalah metode pengambilan keputusan dengan konsep bahwa alternatif terpilih harus memiliki jarak terdekat dari solusi ideal positif dan jarak terjauh dari solusi ideal negatif.</p>
                                    <p class="font-medium">Langkah-langkah perhitungan:</p>
                                    <ol>
                                        <li>Membuat matriks keputusan ternormalisasi</li>
                                        <li>Membuat matriks keputusan ternormalisasi terbobot</li>
                                        <li>Menentukan solusi ideal positif dan negatif</li>
                                        <li>Menghitung jarak alternatif dengan solusi ideal</li>
                                        <li>Menghitung nilai preferensi setiap alternatif</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 1: Matriks Keputusan Ternormalisasi -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 1: Matriks Keputusan Ternormalisasi</h2>
                                <p class="mt-1 text-sm text-gray-500">Nilai alternatif yang telah dinormalisasi</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alternatif</th>
                                            @foreach($kriterias as $kriteria)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($alternatifs as $alternatif)
                                        <tr>
                                            <td class="px-6 py-4">{{ $alternatif->nama_alternatif }}</td>
                                            @foreach($kriterias as $kriteria)
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ number_format($normalizedMatrix[$alternatif->id][$kriteria->id], 4) }}
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Langkah 2: Matriks Ternormalisasi Terbobot -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 2: Matriks Ternormalisasi Terbobot</h2>
                                <p class="mt-1 text-sm text-gray-500">Menggunakan bobot dari hasil perhitungan AHP</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alternatif</th>
                                            @foreach($kriterias as $kriteria)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($alternatifs as $alternatif)
                                        <tr>
                                            <td class="px-6 py-4">{{ $alternatif->nama_alternatif }}</td>
                                            @foreach($kriterias as $kriteria)
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ number_format($weightedMatrix[$alternatif->id][$kriteria->id], 4) }}
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Langkah 3: Solusi Ideal -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 3: Solusi Ideal</h2>
                                <p class="mt-1 text-sm text-gray-500">Nilai solusi ideal positif dan negatif</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Solusi Ideal</th>
                                            @foreach($kriterias as $kriteria)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 font-medium text-green-600">A+ (Positif)</td>
                                            @foreach($kriterias as $kriteria)
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ number_format($positifIdeal[$kriteria->id], 4) }}
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 font-medium text-red-600">A- (Negatif)</td>
                                            @foreach($kriterias as $kriteria)
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ number_format($negatifIdeal[$kriteria->id], 4) }}
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Langkah 4: Jarak Solusi -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 4: Jarak Solusi</h2>
                                <p class="mt-1 text-sm text-gray-500">Jarak setiap alternatif dengan solusi ideal</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alternatif</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">D+ (Jarak ke Positif)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">D- (Jarak ke Negatif)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($alternatifs as $alternatif)
                                        <tr>
                                            <td class="px-6 py-4">{{ $alternatif->nama_alternatif }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ number_format($jarakPositif[$alternatif->id], 4) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ number_format($jarakNegatif[$alternatif->id], 4) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Langkah 5: Hasil Akhir -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 5: Hasil Akhir TOPSIS</h2>
                                <p class="mt-1 text-sm text-gray-500">Nilai preferensi dan perangkingan final</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peringkat</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alternatif</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Preferensi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($nilaiAkhir as $alternatifId => $nilai)
                                        @php
                                            $alternatif = $alternatifs->find($alternatifId);
                                        @endphp
                                        <tr class="{{ $loop->first ? 'bg-green-50' : '' }}">
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center justify-center w-6 h-6 {{ $loop->first ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} rounded-full text-sm font-medium">
                                                    {{ $loop->iteration }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-medium text-gray-900">{{ $alternatif->nama_alternatif }}</span>
                                                    <span class="text-sm text-gray-500">{{ $alternatif->kode_alternatif }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="text-sm {{ $loop->first ? 'font-medium text-green-800' : 'text-gray-900' }}">
                                                    {{ number_format($nilai, 4) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>