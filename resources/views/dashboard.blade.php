<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name') }}</title>

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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white">Dashboard</h1>
                                <p class="text-blue-100 mt-1">Ringkasan data dan aktivitas BPBD</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-white bg-white/10 px-4 py-2 rounded-lg backdrop-blur-lg">
                                {{ now()->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
                        <!-- Personnel Stats -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-100">Total Personel</p>
                                    <p class="text-2xl font-bold text-white mt-2">{{ $stats['personel']['total'] }}</p>
                                </div>
                                <div class="p-3 bg-blue-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-blue-100">
                                <span>{{ $stats['personel']['pns'] }} PNS</span>
                                <span class="mx-2">•</span>
                                <span>{{ $stats['personel']['kontrak'] }} Kontrak</span>
                                <span class="mx-2">•</span>
                                <span>{{ $stats['personel']['sukarela'] }} Sukarela</span>
                            </div>
                        </div>

                        <!-- Equipment Stats -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-100">Peralatan</p>
                                    <p class="text-2xl font-bold text-white mt-2">{{ $stats['peralatan']['total'] }}</p>
                                </div>
                                <div class="p-3 bg-green-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-green-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-blue-100">
                                <span class="text-green-300">{{ $stats['peralatan']['baik'] }} Baik</span>
                                <span class="mx-2">•</span>
                                <span class="text-yellow-300">{{ $stats['peralatan']['rusak_ringan'] }} Rusak Ringan</span>
                                <span class="mx-2">•</span>
                                <span class="text-red-300">{{ $stats['peralatan']['rusak_berat'] }} Rusak Berat</span>
                            </div>
                        </div>

                        <!-- Fund Stats -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-100">Dana Tersedia</p>
                                    <p class="text-2xl font-bold text-white mt-2">
                                        Rp {{ number_format($stats['dana']['tersedia'], 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="p-3 bg-yellow-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-blue-100">
                                <span>{{ $stats['dana']['count'] }} sumber dana</span>
                                <span class="mx-2">•</span>
                                <span>{{ number_format($stats['dana']['terpakai'] / max($stats['dana']['total'], 1) * 100, 1) }}% terpakai</span>
                            </div>
                        </div>

                        <!-- Disaster Stats -->
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-100">Total Bencana</p>
                                    <p class="text-2xl font-bold text-white mt-2">{{ $stats['bencana']['total'] }}</p>
                                </div>
                                <div class="p-3 bg-red-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-red-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm text-blue-100">
                                <span>{{ $stats['bencana']['bulan_ini'] }} bulan ini</span>
                                <span class="mx-2">•</span>
                                <span>{{ $stats['bencana']['tahun_ini'] }} tahun {{ date('Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="py-8 px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Latest Analysis -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Analisis Terbaru</h3>
                        @if($stats['perhitungan']['terakhir'])
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $stats['perhitungan']['terakhir']->nama_perhitungan }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $stats['perhitungan']['terakhir']->created_at->format('d M Y H:i') }}
                                        </p>
                                    </div>
                                    <a href="{{ route('perhitungan.detail', $stats['perhitungan']['terakhir']->id) }}" 
                                       class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                        Lihat Detail →
                                    </a>
                                </div>
                                @php
                                    $sortedResults = collect($stats['perhitungan']['terakhir']->hasil_topsis['preferensi'])
                                        ->sortDesc()
                                        ->take(5);
                                @endphp
                                @foreach($sortedResults as $altId => $nilai)
                                    <div class="flex items-center">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-sm font-medium text-gray-700">
                                                    Alternatif {{ $altId }}
                                                </span>
                                                <span class="text-sm text-gray-500">
                                                    {{ number_format($nilai * 100, 1) }}%
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-blue-600 rounded-full h-2" 
                                                     style="width: {{ $nilai * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                Belum ada analisis yang dilakukan
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('personel.create') }}" 
                               class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                                <div class="p-2 bg-blue-100 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tambah Personel</p>
                                    <p class="text-xs text-gray-500">Daftarkan anggota baru</p>
                                </div>
                            </a>

                            <a href="{{ route('peralatan.create') }}" 
                               class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <div class="p-2 bg-green-100 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tambah Peralatan</p>
                                    <p class="text-xs text-gray-500">Catat peralatan baru</p>
                                </div>
                            </a>

                            <a href="{{ route('dana.create') }}" 
                               class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100">
                                <div class="p-2 bg-yellow-100 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tambah Dana</p>
                                    <p class="text-xs text-gray-500">Catat sumber dana baru</p>
                                </div>
                            </a>

                            <a href="{{ route('bencana.create') }}" 
                               class="flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100">
                                <div class="p-2 bg-red-100 rounded-lg mr-4">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Catat Bencana</p>
                                    <p class="text-xs text-gray-500">Laporkan kejadian bencana</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>