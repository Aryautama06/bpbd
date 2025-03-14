<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hasil Analisis - {{ config('app.name') }}</title>

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

    <div class="lg:pl-64">
        <!-- Header -->
        <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary to-bpbd-accent">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
            </div>
            <div class="relative py-12 px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                        <div class="flex items-center gap-6">
                            <div class="p-4 bg-white/10 backdrop-blur-lg rounded-2xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white">Hasil Analisis</h1>
                                <p class="text-blue-100 mt-1">Kombinasi hasil perhitungan AHP dan TOPSIS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="py-8 px-8">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Bobot Kriteria (AHP) -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Bobot Kriteria (Hasil AHP)</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($kriterias as $kriteria)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-500">{{ $kriteria->kode_kriteria }}</span>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                        {{ $kriteria->jenis === 'benefit' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($kriteria->jenis) }}
                                    </span>
                                </div>
                                <div class="text-xl font-bold {{ $kriteria->ahp_weight > 0 ? 'text-gray-900' : 'text-red-500' }}">
                                    {{ number_format($kriteria->ahp_weight * 100, 2) }}%
                                </div>
                                <div class="mt-1 text-sm text-gray-500">{{ $kriteria->nama_kriteria }}</div>
                            </div>
                            @endforeach
                        </div>

                        @if(collect($kriterias)->every(fn($k) => $k->ahp_weight == 0))
                        <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                            <div class="flex">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Bobot AHP Belum Tersedia</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>Silakan lakukan perhitungan AHP terlebih dahulu untuk melihat bobot kriteria.</p>
                                        <a href="{{ route('perhitungan.ahp') }}" class="mt-2 inline-flex items-center text-yellow-800 hover:underline">
                                            Hitung AHP
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Hasil Perankingan -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                        <h2 class="text-lg font-medium text-gray-900">Hasil Perankingan Final</h2>
                        <p class="mt-1 text-sm text-gray-500">Urutan rekomendasi berdasarkan TOPSIS</p>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alternatif</th>
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
                                        @php
                                            $preferensiValue = session('hasilTOPSIS')['preferensi'][$alternatif->id] ?? 0;
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-2xl font-bold text-gray-900">
                                                #{{ $ranking }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $alternatif->kode_alternatif }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $alternatif->nama_alternatif }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-grow">
                                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                            <div class="bg-blue-600 h-2.5 rounded-full" 
                                                                style="width: {{ number_format($preferensiValue * 100, 2) }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ number_format($preferensiValue * 100, 2) }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($ranking == 1)
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                        Rekomendasi Terbaik
                                                    </span>
                                                @elseif($ranking == 2)
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                        Alternatif Kedua
                                                    </span>
                                                @elseif($ranking == 3)
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                        Alternatif Ketiga
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                        Alternatif Lainnya
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @php $ranking++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>