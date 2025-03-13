<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perhitungan AHP - BPBD</title>

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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-white">Perhitungan AHP</h1>
                                    <p class="text-blue-100 mt-1">Analytical Hierarchy Process</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto space-y-8">
                        <!-- Penjelasan Metode -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900">Metode AHP (Analytical Hierarchy Process)</h2>
                                <div class="mt-4 prose prose-blue">
                                    <p>AHP adalah metode pengambilan keputusan yang menguraikan masalah multi kriteria menggunakan skala perbandingan 1-9 dari Saaty:</p>
                                    <div class="overflow-x-auto mt-4">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nilai</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Definisi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($hasilAHP['skala'] as $nilai => $definisi)
                                                <tr>
                                                    <td class="px-6 py-2 text-sm">{{ $nilai }}</td>
                                                    <td class="px-6 py-2 text-sm">{{ $definisi }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Langkah 1: Matriks Perbandingan -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 1: Matriks Perbandingan Berpasangan</h2>
                                <p class="mt-1 text-sm text-gray-500">Perbandingan tingkat kepentingan antar kriteria</p>
                            </div>
                            
                            <form action="{{ route('perhitungan.simpan-perbandingan') }}" method="POST">
                                @csrf
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Kriteria</th>
                                                @foreach($kriterias as $kriteria)
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                                    <div class="flex flex-col">
                                                        <span>{{ $kriteria->kode_kriteria }}</span>
                                                        <span class="text-xs text-gray-400">{{ $kriteria->nama_kriteria }}</span>
                                                    </div>
                                                </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($kriterias as $kriteria1)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm font-medium text-gray-900">{{ $kriteria1->kode_kriteria }}</span>
                                                        <span class="text-sm text-gray-500">{{ $kriteria1->nama_kriteria }}</span>
                                                    </div>
                                                </td>
                                                @foreach($kriterias as $kriteria2)
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($kriteria1->id === $kriteria2->id)
                                                        <!-- Diagonal cells -->
                                                        <input type="number" value="1" readonly
                                                               class="form-input w-20 text-center bg-gray-50 border-gray-200 rounded-lg" />
                                                    @elseif($kriteria1->id < $kriteria2->id)
                                                        <!-- Upper triangle - Input fields -->
                                                        <input type="number" 
                                                               name="perbandingan[{{ $kriteria1->id }}][{{ $kriteria2->id }}]"
                                                               value="{{ $matriksBerpasangan[$kriteria1->id][$kriteria2->id] ?? '' }}"
                                                               step="0.01"
                                                               min="0.11"
                                                               max="9"
                                                               class="form-input w-20 text-center border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg"
                                                               required />
                                                    @else
                                                        <!-- Lower triangle - Reciprocal values -->
                                                        <div class="text-sm text-gray-500 text-center">
                                                            {{ isset($matriksBerpasangan[$kriteria2->id][$kriteria1->id]) 
                                                                ? number_format(1 / $matriksBerpasangan[$kriteria2->id][$kriteria1->id], 4) 
                                                                : '' }}
                                                        </div>
                                                    @endif
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="p-6 bg-gray-50 border-t border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div class="space-y-1">
                                            <p class="text-sm font-medium text-gray-900">Panduan Pengisian:</p>
                                            <div class="text-sm text-gray-500">
                                                <p>* Isi nilai untuk membandingkan kriteria baris terhadap kolom</p>
                                                <p>* Nilai 1 = Sama penting</p>
                                                <p>* Nilai 9 = Mutlak lebih penting</p>
                                                <p>* Nilai desimal diperbolehkan (mis: 1.5)</p>
                                            </div>
                                        </div>
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Simpan & Hitung
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Langkah 2: Matriks Normalisasi -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 2: Matriks Normalisasi</h2>
                                <p class="mt-1 text-sm text-gray-500">Normalisasi matriks perbandingan dan perhitungan bobot prioritas</p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Kriteria</th>
                                            @foreach($kriterias as $kriteria)
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">
                                                {{ $kriteria->kode_kriteria }}
                                            </th>
                                            @endforeach
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($kriterias as $kriteria1)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{ $kriteria1->kode_kriteria }}
                                            </td>
                                            @foreach($kriterias as $kriteria2)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ number_format($hasilAHP['matriksNormal'][$kriteria1->id][$kriteria2->id], 4) }}
                                            </td>
                                            @endforeach
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                                {{ number_format($hasilAHP['bobotKriteria'][$kriteria1->id], 4) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Langkah 3: Uji Konsistensi -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Langkah 3: Uji Konsistensi</h2>
                                <p class="mt-1 text-sm text-gray-500">Pengujian konsistensi matriks perbandingan</p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Weighted Sum -->
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Weighted Sum Matrix</h3>
                                        <div class="mt-2 overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Kriteria</th>
                                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach($kriterias as $kriteria)
                                                    <tr>
                                                        <td class="px-4 py-2 text-sm">{{ $kriteria->kode_kriteria }}</td>
                                                        <td class="px-4 py-2 text-sm">
                                                            {{ number_format($hasilAHP['weightedSum'][$kriteria->id], 4) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Consistency Vector -->
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Consistency Vector</h3>
                                        <div class="mt-2 overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Kriteria</th>
                                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach($kriterias as $kriteria)
                                                    <tr>
                                                        <td class="px-4 py-2 text-sm">{{ $kriteria->kode_kriteria }}</td>
                                                        <td class="px-4 py-2 text-sm">
                                                            {{ number_format($hasilAHP['consistencyVector'][$kriteria->id], 4) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hasil Konsistensi -->
                                <div class="mt-6 p-4 {{ $hasilAHP['isConsistent'] ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }} rounded-lg">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="{{ $hasilAHP['isConsistent'] ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12' }}"/>
                                        </svg>
                                        <p class="font-medium">
                                            Rasio Konsistensi: {{ number_format($hasilAHP['consistencyRatio'], 4) }}
                                            ({{ $hasilAHP['isConsistent'] ? 'Konsisten' : 'Tidak Konsisten' }})
                                        </p>
                                    </div>
                                    <div class="mt-4 text-sm space-y-1">
                                        <p>λ max = {{ number_format($hasilAHP['lambdaMax'], 4) }}</p>
                                        <p>CI = {{ number_format($hasilAHP['consistencyIndex'], 4) }}</p>
                                        <p>RI = {{ $randomIndex[count($kriterias)] }}</p>
                                        <p>CR = {{ number_format($hasilAHP['consistencyRatio'], 4) }}</p>
                                        <p class="font-medium mt-2">
                                            @if($hasilAHP['isConsistent'])
                                                Matriks perbandingan konsisten (CR ≤ 0.1)
                                            @else
                                                Matriks perbandingan tidak konsisten (CR > 0.1).<br>
                                                Pertimbangkan untuk mengubah nilai perbandingan kriteria.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Navigasi -->
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('perhitungan.topsis') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 {{ !$hasilAHP['isConsistent'] ? 'opacity-50 cursor-not-allowed' : '' }}"
                               {{ !$hasilAHP['isConsistent'] ? 'disabled' : '' }}>
                                <span>Lanjut ke TOPSIS</span>
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>