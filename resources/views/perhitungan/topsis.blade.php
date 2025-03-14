<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Perhitungan TOPSIS</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo_bpbd.png') }}">
    </head>
    
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
<body class="min-h-screen bg-gray-50">
    @include('components.sidebar')   

    <div class="lg:pl-64"> <!-- Add left padding to match sidebar width -->
        <!-- Header -->
                <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary to-bpbd-accent">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                    </div>

                    <div class="relative py-12 px-8">
                        <div class="max-w-7xl mx-auto">
                            <!-- Header Content -->
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-8">
                                <div class="flex items-center gap-6">
                                    <div class="p-4 bg-white/10 backdrop-blur-lg rounded-2xl">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="text-3xl font-bold text-white">Perhitungan TOPSIS</h1>
                                        <p class="text-blue-100 mt-1">Technique for Order of Preference by Similarity to Ideal Solution</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Total Alternatif -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Total Alternatif</h3>
                                        <span class="p-2 bg-emerald-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">{{ $alternatifs->count() }} Alternatif</p>
                                </div>

                                <!-- Total Kriteria -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Total Kriteria</h3>
                                        <span class="p-2 bg-blue-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">{{ $kriterias->count() }} Kriteria</p>
                                </div>

                                <!-- Bobot AHP -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Status Bobot</h3>
                                        <span class="p-2 bg-purple-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">Menggunakan Bobot AHP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="py-8 px-8">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Tahap 1: Matriks Keputusan -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Tahap 1: Matriks Keputusan</h2>
                        <p class="mt-1 text-sm text-gray-500">X = Matriks keputusan yang terdiri dari nilai kriteria untuk setiap alternatif</p>
                    </div>
                    
                    <div class="p-6">
                        <!-- Input Nilai Alternatif -->
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-medium text-gray-900">Input Nilai Alternatif</h2>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('perhitungan.hitung-topsis') }}" method="POST">
                                    @csrf
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Alternatif
                                                    </th>
                                                    @foreach($kriterias as $kriteria)
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ $kriteria->kode_kriteria }}
                                                        <div class="text-xs font-normal text-gray-400">
                                                            ({{ $kriteria->jenis }})
                                                        </div>
                                                    </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($alternatifs as $alternatif)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $alternatif->kode_alternatif }}
                                                    </td>
                                                    @foreach($kriterias as $kriteria)
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="number" 
                                                               name="nilai[{{ $alternatif->id }}][{{ $kriteria->id }}]"
                                                               class="w-24 text-center border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                                               step="0.01" 
                                                               required>
                                                    </td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            Hitung TOPSIS
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('hasilTOPSIS'))
                <!-- Tahap 2: Normalisasi Matriks -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Tahap 2: Normalisasi Matriks Keputusan</h2>
                        <p class="mt-1 text-sm text-gray-500">rij = xij / √Σ(xij²)</p>
                    </div>
                    <div class="p-6 overflow-x-auto">
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
                            <tbody class="divide-y divide-gray-200">
                                @foreach($alternatifs as $alternatif)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $alternatif->kode_alternatif }}</td>
                                    @foreach($kriterias as $kriteria)
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ number_format(session('hasilTOPSIS')['matriksNormal'][$alternatif->id][$kriteria->id], 4) }}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tahap 3: Matriks Normalisasi Terbobot -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Tahap 3: Matriks Normalisasi Terbobot</h2>
                        <p class="mt-1 text-sm text-gray-500">Vij = Wj × rij</p>
                    </div>
                    <div class="p-6 overflow-x-auto">
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
                            <tbody class="divide-y divide-gray-200">
                                @foreach($alternatifs as $alternatif)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $alternatif->kode_alternatif }}</td>
                                    @foreach($kriterias as $kriteria)
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ number_format(session('hasilTOPSIS')['matriksTerbobot'][$alternatif->id][$kriteria->id], 4) }}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tahap 4: Solusi Ideal -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Tahap 4: Solusi Ideal Positif dan Negatif</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Solusi Ideal Positif -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">A⁺ (Solusi Ideal Positif)</h3>
                                <div class="space-y-2">
                                    @foreach($kriterias as $kriteria)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">{{ $kriteria->kode_kriteria }}:</span>
                                        <span class="text-sm font-medium">
                                            {{ number_format(session('hasilTOPSIS')['aPlus'][$kriteria->id], 4) }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Solusi Ideal Negatif -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">A⁻ (Solusi Ideal Negatif)</h3>
                                <div class="space-y-2">
                                    @foreach($kriterias as $kriteria)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">{{ $kriteria->kode_kriteria }}:</span>
                                        <span class="text-sm font-medium">
                                            {{ number_format(session('hasilTOPSIS')['aMinus'][$kriteria->id], 4) }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tahap 5-6: Jarak dan Preferensi -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Tahap 5-6: Jarak dan Nilai Preferensi</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            @foreach($alternatifs as $alternatif)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="mb-2">
                                    <h3 class="text-sm font-medium text-gray-900">{{ $alternatif->kode_alternatif }}</h3>
                                    <p class="text-xs text-gray-500">{{ $alternatif->nama_alternatif }}</p>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">D⁺:</span>
                                        <span class="text-sm font-medium">
                                            {{ number_format(session('hasilTOPSIS')['dPlus'][$alternatif->id], 4) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">D⁻:</span>
                                        <span class="text-sm font-medium">
                                            {{ number_format(session('hasilTOPSIS')['dMinus'][$alternatif->id], 4) }}
                                        </span>
                                    </div>
                                    <div class="pt-2 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-500">Ci*:</span>
                                            <span class="text-sm font-bold text-blue-600">
                                                {{ number_format(session('hasilTOPSIS')['preferensi'][$alternatif->id] * 100, 2) }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Hasil Perankingan -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                        <h2 class="text-lg font-medium text-gray-900">Hasil Perankingan TOPSIS</h2>
                        <p class="mt-1 text-sm text-gray-500">Urutan alternatif berdasarkan nilai preferensi tertinggi</p>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alternatif</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Preferensi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $ranking = 1;
                                        $sortedAlternatifs = $alternatifs->sortByDesc(function($alt) {
                                            return session('hasilTOPSIS')['preferensi'][$alt->id] ?? 0;
                                        });
                                    @endphp
                                    
                                    @foreach($sortedAlternatifs as $alternatif)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $ranking++ }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $alternatif->kode_alternatif }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $alternatif->nama_alternatif }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center">
                                                    @php
                                                        $preferensiValue = session('hasilTOPSIS')['preferensi'][$alternatif->id] ?? 0;
                                                    @endphp
                                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                                        <div class="bg-blue-600 h-2.5 rounded-full" 
                                                             style="width: {{ number_format($preferensiValue * 100, 2) }}%">
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium">
                                                        {{ number_format($preferensiValue * 100, 2) }}%
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($ranking <= 4)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                {{ $ranking == 2 ? 'bg-green-100 text-green-800' : 
                                                                   ($ranking == 3 ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                        {{ $ranking == 2 ? 'Terbaik' : ($ranking == 3 ? 'Runner Up' : 'Third Place') }}
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        Alternatif #{{ $ranking - 1 }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Save Result Button -->
                <div class="mt-8 flex justify-end">
                    <button type="button" 
                            onclick="showSaveModal()"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Simpan Hasil Perhitungan
                    </button>
                </div>

                <!-- Save Modal -->
                <div id="saveModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <form action="{{ route('perhitungan.simpan-hasil') }}" method="POST">
                                @csrf
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Simpan Hasil Perhitungan
                                            </h3>
                                            <div class="mt-4 space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">
                                                        Nama Perhitungan
                                                    </label>
                                                    <input type="text" 
                                                           name="nama_perhitungan" 
                                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                           required>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">
                                                        Deskripsi (Opsional)
                                                    </label>
                                                    <textarea name="deskripsi" 
                                                              rows="3" 
                                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" 
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Simpan
                                    </button>
                                    <button type="button" 
                                            onclick="hideSaveModal()"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                function showSaveModal() {
                    document.getElementById('saveModal').classList.remove('hidden');
                }

                function hideSaveModal() {
                    document.getElementById('saveModal').classList.add('hidden');
                }
                </script>
                @endif
            </div>
        </div>
    </div>
</body>
</html>