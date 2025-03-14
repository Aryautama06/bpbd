<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Hasil Analisis</title>
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
                @if(!session('hasilAHP') || !session('hasilTOPSIS'))
                    <!-- Empty State -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="px-6 py-12">
                            <div class="text-center">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum Ada Hasil Analisis</h3>
                                <p class="mt-2 text-sm text-gray-500">
                                    Anda perlu melakukan perhitungan AHP dan TOPSIS terlebih dahulu untuk melihat hasil analisis.
                                </p>
                                <div class="mt-6 flex justify-center gap-4">
                                    <a href="{{ route('perhitungan.ahp') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        Mulai Perhitungan AHP
                                    </a>
                                    @if(session('hasilAHP'))
                                        <a href="{{ route('perhitungan.topsis') }}" 
                                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                            </svg>
                                            Lanjutkan ke TOPSIS
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Progress Indicator -->
                            <div class="mt-8">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <span class="h-8 w-8 rounded-full {{ session('hasilAHP') ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center">
                                                @if(session('hasilAHP'))
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @else
                                                    1
                                                @endif
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">Perhitungan AHP</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ session('hasilAHP') ? 'Selesai - Bobot kriteria telah dihitung' : 'Belum dilakukan - Menentukan bobot kriteria' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <span class="h-8 w-8 rounded-full {{ session('hasilTOPSIS') ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center">
                                                @if(session('hasilTOPSIS'))
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @else
                                                    2
                                                @endif
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">Perhitungan TOPSIS</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ session('hasilTOPSIS') ? 'Selesai - Perankingan alternatif telah dilakukan' : 'Belum dilakukan - Menentukan ranking alternatif' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
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
                @endif
            </div>
        </div>
    </div>
</body>
</html>