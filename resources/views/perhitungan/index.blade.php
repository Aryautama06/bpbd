<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Perhitungan - BPBD</title>
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
                                    <h1 class="text-3xl font-bold text-white">Perhitungan SPK</h1>
                                    <p class="text-blue-100 mt-1">Sistem Pendukung Keputusan dengan AHP-TOPSIS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Overview Section -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-900">Ringkasan Data</h2>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 bg-blue-50 rounded-xl">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Total Alternatif</p>
                                            <p class="text-2xl font-semibold text-gray-900">{{ $alternatifs->count() }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 bg-indigo-50 rounded-xl">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Total Kriteria</p>
                                            <p class="text-2xl font-semibold text-gray-900">{{ $kriterias->count() }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 bg-purple-50 rounded-xl">
                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Total Penilaian</p>
                                            <p class="text-2xl font-semibold text-gray-900">{{ $nilaiAlternatifs->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Methods Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- AHP Card -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:border-blue-500 transition-colors group">
                                <a href="{{ route('perhitungan.ahp') }}" class="block p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="p-3 bg-blue-50 rounded-xl group-hover:bg-blue-100 transition-colors">
                                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">1. Perhitungan AHP</h3>
                                                <p class="text-gray-500 mt-1">Analytical Hierarchy Process</p>
                                                <p class="text-sm text-gray-500 mt-2">Menghitung bobot kriteria dan nilai alternatif menggunakan metode AHP</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>

                            <!-- TOPSIS Card -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:border-blue-500 transition-colors group">
                                <a href="{{ route('perhitungan.topsis') }}" class="block p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="p-3 bg-blue-50 rounded-xl group-hover:bg-blue-100 transition-colors">
                                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">2. Perhitungan TOPSIS</h3>
                                                <p class="text-gray-500 mt-1">Technique for Order of Preference by Similarity to Ideal Solution</p>
                                                <p class="text-sm text-gray-500 mt-2">Perangkingan alternatif menggunakan bobot dari hasil AHP</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>