<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perhitungan AHP - {{ config('app.name') }}</title>

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

<body class="min-h-screen bg-gray-50">
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
                            <!-- Header Content -->
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-8">
                                <div class="flex items-center gap-6">
                                    <div class="p-4 bg-white/10 backdrop-blur-lg rounded-2xl">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="text-3xl font-bold text-white">Perhitungan AHP</h1>
                                        <p class="text-blue-100 mt-1">Analytical Hierarchy Process</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Total Kriteria -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Total Kriteria</h3>
                                        <span class="p-2 bg-emerald-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">{{ $kriterias->count() }} Kriteria</p>
                                </div>

                                <!-- Perbandingan Required -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Perbandingan</h3>
                                        <span class="p-2 bg-blue-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">{{ ($kriterias->count() * ($kriterias->count() - 1)) / 2 }} Nilai</p>
                                </div>

                                <!-- Status Konsistensi -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Konsistensi</h3>
                                        <span class="p-2 bg-purple-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    @if(isset($hasilAHP['konsistensi']))
                                        <p class="text-2xl font-bold text-white">
                                            {{ $hasilAHP['konsistensi']['isConsistent'] ? 'Konsisten' : 'Tidak Konsisten' }}
                                        </p>
                                        <p class="text-sm text-blue-100 mt-1">
                                            CR: {{ number_format($hasilAHP['konsistensi']['CR'], 4) }}
                                        </p>
                                    @else
                                        <p class="text-2xl font-bold text-white">Belum dihitung</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto space-y-8">
                        <!-- Tahap 1: Struktur Hierarki -->
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-lg font-medium text-gray-900">Tahap 1: Struktur Hierarki</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach($kriterias as $kriteria)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $kriteria->kode_kriteria }}</div>
                                        <div class="mt-1 text-sm text-gray-500">{{ $kriteria->nama_kriteria }}</div>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kriteria->jenis === 'benefit' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                                {{ ucfirst($kriteria->jenis) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Tahap 2: Matriks Perbandingan -->
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-lg font-medium text-gray-900">Tahap 2: Matriks Perbandingan Berpasangan (A)</h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    aij = nilai perbandingan antara kriteria i dengan kriteria j
                                </p>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('perhitungan.simpan-perbandingan') }}" method="POST" id="perbandinganForm">
                                    @csrf
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr class="bg-gray-50">
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kriteria</th>
                                                    @foreach($kriterias as $kriteria)
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ $kriteria->kode_kriteria }}
                                                    </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($kriterias as $kriteria1)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        {{ $kriteria1->kode_kriteria }}
                                                    </td>
                                                    @foreach($kriterias as $kriteria2)
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($kriteria1->id === $kriteria2->id)
                                                            <input type="number" value="1" readonly
                                                                   class="w-20 text-center bg-gray-50 border-gray-200 rounded-md">
                                                        @else
                                                            <input type="number" 
                                                                   name="perbandingan[{{ $kriteria1->id }}][{{ $kriteria2->id }}]"
                                                                   id="perbandingan_{{ $kriteria1->id }}_{{ $kriteria2->id }}"
                                                                   value="{{ isset($perbandinganValues[$kriteria1->id][$kriteria2->id]) ? number_format($perbandinganValues[$kriteria1->id][$kriteria2->id], 4) : '' }}"
                                                                   step="0.01"
                                                                   min="0.11"
                                                                   max="9"
                                                                   class="w-20 text-center border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md"
                                                                   onchange="updateInverseValue({{ $kriteria1->id }}, {{ $kriteria2->id }}, this.value)"
                                                                   {{ $kriteria1->id > $kriteria2->id ? 'readonly' : '' }}>
                                                        @endif
                                                    </td>
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-6 bg-gray-50 p-6 rounded-lg space-y-4">
                                        <h3 class="text-sm font-medium text-gray-900">Skala Perbandingan:</h3>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                            <div class="bg-white p-3 rounded-md text-sm">
                                                <span class="font-medium">1</span> = Sama penting
                                            </div>
                                            <div class="bg-white p-3 rounded-md text-sm">
                                                <span class="font-medium">3</span> = Sedikit lebih penting
                                            </div>
                                            <div class="bg-white p-3 rounded-md text-sm">
                                                <span class="font-medium">5</span> = Lebih penting
                                            </div>
                                            <div class="bg-white p-3 rounded-md text-sm">
                                                <span class="font-medium">7</span> = Sangat lebih penting
                                            </div>
                                            <div class="bg-white p-3 rounded-md text-sm">
                                                <span class="font-medium">9</span> = Mutlak lebih penting
                                            </div>
                                            <div class="bg-white p-3 rounded-md text-sm">
                                                <span class="font-medium">2,4,6,8</span> = Nilai tengah
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex justify-end">
                                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Simpan & Hitung
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if(session('hasilAHP'))
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-8">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-lg font-medium text-gray-900">Hasil Normalisasi Matriks</h2>
                                <p class="mt-1 text-sm text-gray-500">Matriks yang telah dinormalisasi dengan membagi setiap elemen dengan jumlah kolomnya</p>
                            </div>
                            
                            <div class="p-6 overflow-x-auto">
                                <!-- Jumlah Kolom -->
                                <div class="mb-6">
                                    <h3 class="text-sm font-medium text-gray-700 mb-2">Jumlah Kolom:</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                        @foreach($kriterias as $kriteria)
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <div class="text-xs text-gray-500">{{ $kriteria->kode_kriteria }}</div>
                                            <div class="text-sm font-medium">
                                                {{ number_format(session('hasilAHP')['jumlahKolom'][$kriteria->id], 4) }}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Matriks Normalisasi -->
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Kriteria
                                            </th>
                                            @foreach($kriterias as $kriteria)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                            @endforeach
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Bobot
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($kriterias as $kriteria1)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $kriteria1->kode_kriteria }}
                                            </td>
                                            @foreach($kriterias as $kriteria2)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format(session('hasilAHP')['matriksNormal'][$kriteria1->id][$kriteria2->id], 4) }}
                                            </td>
                                            @endforeach
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                                {{ number_format(session('hasilAHP')['bobotPrioritas'][$kriteria1->id], 4) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Tahap 3: Normalisasi Matriks -->
                        @if(isset($hasilAHP['matriksNormal']))
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Tahap 3: Normalisasi Matriks (Anorm)
                                </h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    Anorm = aij / Ʃaj (Membagi setiap elemen dengan jumlah kolom)
                                </p>
                            </div>
                            <div class="p-6 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Kriteria
                                            </th>
                                            @foreach($kriterias as $kriteria)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($kriterias as $kriteria1)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $kriteria1->kode_kriteria }}
                                            </td>
                                            @foreach($kriterias as $kriteria2)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format($hasilAHP['matriksNormal'][$kriteria1->id][$kriteria2->id], 4) }}
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Tahap 4: Bobot Prioritas -->
                        @if(isset($hasilAHP['bobotPrioritas']))
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-lg font-medium text-gray-900">
                                    Tahap 4: Bobot Prioritas (Wi)
                                </h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    Wi = Rata-rata baris matriks normalisasi
                                </p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach($kriterias as $kriteria)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="text-sm font-medium text-gray-500">{{ $kriteria->kode_kriteria }}</div>
                                        <div class="mt-1 text-2xl font-bold text-gray-900">
                                            {{ number_format($hasilAHP['bobotPrioritas'][$kriteria->id], 4) }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Tahap 5-7: Perhitungan Konsistensi -->
                        @if(session('hasilAHP') && isset(session('hasilAHP')['konsistensi']))
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-8">
                            <!-- Header -->
                            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                                <h2 class="text-lg font-medium text-gray-900">Tahap 5-7: Perhitungan Konsistensi</h2>
                                <p class="mt-1 text-sm text-gray-600">Menghitung dan memverifikasi konsistensi matriks perbandingan</p>
                            </div>

                            <div class="p-6 space-y-8">
                                <!-- Tahap 5: Lambda Max -->
                                <div>
                                    <h3 class="text-md font-medium text-gray-900 mb-4">Tahap 5: Perhitungan Nilai Eigen Maksimum (λmax)</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Perhitungan Lambda Max -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="mb-2">
                                                <span class="text-sm font-medium text-gray-700">Formula:</span>
                                                <div class="mt-1 text-sm text-gray-600">
                                                    λmax = Σ(Total Kolom × Bobot Prioritas) / n
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <span class="text-sm font-medium text-gray-700">Hasil:</span>
                                                <div class="mt-1 text-xl font-bold text-blue-600">
                                                    {{ number_format(session('hasilAHP')['lambdaMax'], 4) }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detail Perhitungan -->
                                        <div class="bg-white border rounded-lg overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-4 py-2 text-xs font-medium text-gray-500">Kriteria</th>
                                                        <th class="px-4 py-2 text-xs font-medium text-gray-500">Total Kolom</th>
                                                        <th class="px-4 py-2 text-xs font-medium text-gray-500">Bobot (W)</th>
                                                        <th class="px-4 py-2 text-xs font-medium text-gray-500">Total × W</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                    @foreach($kriterias as $kriteria)
                                                    <tr>
                                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $kriteria->kode_kriteria }}</td>
                                                        <td class="px-4 py-2 text-sm text-gray-600">
                                                            {{ number_format(session('hasilAHP')['jumlahKolom'][$kriteria->id], 4) }}
                                                        </td>
                                                        <td class="px-4 py-2 text-sm text-gray-600">
                                                            {{ number_format(session('hasilAHP')['bobotPrioritas'][$kriteria->id], 4) }}
                                                        </td>
                                                        <td class="px-4 py-2 text-sm text-gray-600">
                                                            {{ number_format(session('hasilAHP')['jumlahKolom'][$kriteria->id] * session('hasilAHP')['bobotPrioritas'][$kriteria->id], 4) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap 6: Consistency Index -->
                                <div>
                                    <h3 class="text-md font-medium text-gray-900 mb-4">Tahap 6: Consistency Index (CI)</h3>
                                    
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <div class="mb-2">
                                                    <span class="text-sm font-medium text-gray-700">Formula:</span>
                                                    <div class="mt-1 text-sm text-gray-600">
                                                        CI = (λmax - n) / (n - 1)
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span class="text-sm text-gray-600">Dimana:</span>
                                                    <ul class="mt-1 text-sm text-gray-600 list-disc list-inside">
                                                        <li>λmax = {{ number_format(session('hasilAHP')['lambdaMax'], 4) }}</li>
                                                        <li>n = {{ count($kriterias) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <div>
                                                    <span class="text-sm font-medium text-gray-700">Hasil CI:</span>
                                                    <div class="mt-1 text-xl font-bold text-blue-600">
                                                        {{ number_format(session('hasilAHP')['konsistensi']['CI'], 4) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap 7: Consistency Ratio -->
                                <div>
                                    <h3 class="text-md font-medium text-gray-900 mb-4">Tahap 7: Consistency Ratio (CR)</h3>
                                    
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <div class="mb-2">
                                                    <span class="text-sm font-medium text-gray-700">Formula:</span>
                                                    <div class="mt-1 text-sm text-gray-600">
                                                        CR = CI / RI
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <span class="text-sm text-gray-600">Dimana:</span>
                                                    <ul class="mt-1 text-sm text-gray-600 list-disc list-inside">
                                                        <li>CI = {{ number_format(session('hasilAHP')['konsistensi']['CI'], 4) }}</li>
                                                        @if(session()->has('hasilAHP') && 
                                                            isset(session('hasilAHP')['konsistensi']) && 
                                                            isset(session('hasilAHP')['konsistensi']['RI']))
                                                            <li>RI = {{ number_format(session('hasilAHP')['konsistensi']['RI'], 4) }} 
                                                                (untuk n={{ session('hasilAHP')['konsistensi']['n'] }})</li>
                                                        @else
                                                            <li>RI belum dihitung</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="mb-4">
                                                    <span class="text-sm font-medium text-gray-700">Hasil CR:</span>
                                                    <div class="mt-1 text-xl font-bold text-blue-600">
                                                        {{ number_format(session('hasilAHP')['konsistensi']['CR'], 4) }}
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-4">
                                                    <div class="inline-flex items-center px-4 py-2 rounded-lg {{ session('hasilAHP')['konsistensi']['isConsistent'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            @if(session('hasilAHP')['konsistensi']['isConsistent'])
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            @else
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            @endif
                                                        </svg>
                                                        {{ session('hasilAHP')['konsistensi']['isConsistent'] ? 'Konsisten (CR ≤ 0.1)' : 'Tidak Konsisten (CR > 0.1)' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(session('hasilAHP') && isset(session('hasilAHP')['konsistensi']))
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-8">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-lg font-medium text-gray-900">Hasil Pengujian Konsistensi</h2>
                                <p class="mt-1 text-sm text-gray-500">Menghitung tingkat konsistensi dari matriks perbandingan</p>
                            </div>
                            
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <!-- Lambda Max -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="text-sm font-medium text-gray-500">Nilai λmax</div>
                                        <div class="mt-1 text-xl font-bold text-gray-900">
                                            {{ number_format(session('hasilAHP')['lambdaMax'], 4) }}
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Nilai eigen maksimum</p>
                                    </div>

                                    <!-- Consistency Index -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="text-sm font-medium text-gray-500">Consistency Index (CI)</div>
                                        <div class="mt-1 text-xl font-bold text-gray-900">
                                            {{ number_format(session('hasilAHP')['konsistensi']['CI'], 4) }}
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">CI = (λmax - n)/(n-1)</p>
                                    </div>

                                    <!-- Consistency Ratio -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="text-sm font-medium text-gray-500">Consistency Ratio (CR)</div>
                                        <div class="mt-1 text-xl font-bold text-gray-900">
                                            {{ number_format(session('hasilAHP')['konsistensi']['CR'], 4) }}
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">CR = CI/RI</p>
                                    </div>

                                    <!-- Consistency Status -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="text-sm font-medium text-gray-500">Status Konsistensi</div>
                                        <div class="mt-2">
                                            @if(session('hasilAHP')['konsistensi']['isConsistent'])
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Konsisten
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Tidak Konsisten
                                                </span>
                                            @endif
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">
                                            CR {{ session('hasilAHP')['konsistensi']['CR'] <= 0.1 ? '≤' : '>' }} 0.1
                                        </p>
                                    </div>
                                </div>

                                @if(!session('hasilAHP')['konsistensi']['isConsistent'])
                                    <div class="mt-4 p-4 bg-red-50 rounded-lg">
                                        <div class="flex">
                                            <div class="shrink-0">
                                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-red-800">Peringatan Konsistensi</h3>
                                                <div class="mt-2 text-sm text-red-700">
                                                    <p>Matriks perbandingan tidak konsisten. Sebaiknya lakukan penilaian ulang untuk mendapatkan hasil yang lebih baik.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(session('hasilAHP') && session('hasilAHP')['showResults'])
            </div>
        </div>
    </div>
@endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
    function updateInverseValue(id1, id2, value) {
        if (value && value > 0) {
            const inverseInput = document.getElementById(`perbandingan_${id2}_${id1}`);
            if (inverseInput) {
                inverseInput.value = (1 / parseFloat(value)).toFixed(4);
            }
        }
    }

    document.getElementById('perbandinganForm').addEventListener('submit', function(e) {
        const inputs = document.querySelectorAll('input[type="number"]:not([readonly])');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('border-red-500');
            } else {
                input.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua nilai perbandingan');
        }
    });
    </script>
</body>
</html>