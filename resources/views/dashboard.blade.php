<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Dashboard - BPBD Deli Serdang</title>

    <!-- Enhanced Font Selection -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-body {
            font-family: 'Inter', sans-serif;
        }
    </style>

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
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'heading': ['Plus Jakarta Sans', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="font-body antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Include Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="ml-64 p-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-bpbd-secondary tracking-tight">Dashboard SPK BPBD</h1>
                        <p class="mt-2 text-base text-gray-600 leading-relaxed">Sistem Pendukung Keputusan Alokasi Sumber Daya Multi-Bencana</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ now()->format('d M Y') }}
                        </button>
                        <button class="flex items-center px-4 py-2 text-white bg-bpbd-primary rounded-lg shadow-sm hover:bg-bpbd-primary/90">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Laporan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Bencana -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">30 Hari Terakhir</span>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900">24</h3>
                    <p class="text-sm font-medium text-gray-600">Total Bencana</p>
                    <div class="mt-2 flex items-center text-green-600 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>12% dari bulan lalu</span>
                    </div>
                </div>

                <!-- Personel Aktif -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Real-time</span>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900">156</h3>
                    <p class="text-sm font-medium text-gray-600">Personel Aktif</p>
                    <div class="mt-2 flex items-center text-green-600 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>8% dari minggu lalu</span>
                    </div>
                </div>

                <!-- Peralatan Tersedia -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Status</span>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900">85%</h3>
                    <p class="text-sm font-medium text-gray-600">Peralatan Siap</p>
                    <div class="mt-2 flex items-center text-yellow-600 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                        <span>Stabil</span>
                    </div>
                </div>

                <!-- Dana Tersedia -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Anggaran</span>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-gray-900">Rp 2.5M</h3>
                    <p class="text-sm font-medium text-gray-600">Dana Tersedia</p>
                    <div class="mt-2 flex items-center text-red-600 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                        <span>15% penggunaan</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Map and Status - Spans 2 columns -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Map -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-heading font-semibold text-lg text-gray-900">Sebaran Bencana</h3>
                            <div class="flex items-center space-x-2">
                                <select class="text-sm border-gray-200 rounded-lg">
                                    <option>Semua Kecamatan</option>
                                    <!-- Add 22 districts here -->
                                </select>
                                <button class="p-2 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="aspect-video bg-gray-100 rounded-lg">
                            <!-- Add your map component here -->
                            <div class="flex items-center justify-center h-full text-gray-400">
                                Peta Sebaran Bencana
                            </div>
                        </div>
                    </div>

                    <!-- Recent Events -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="font-heading font-semibold text-lg text-gray-900">Kejadian Terkini</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @for ($i = 0; $i < 3; $i++)
                            <div class="p-6 hover:bg-gray-50">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <span class="flex-none w-2 h-2 bg-red-400 rounded-full"></span>
                                        <h4 class="text-sm font-medium text-gray-900">Banjir di Kec. Percut Sei Tuan</h4>
                                    </div>
                                    <span class="text-xs text-gray-500">2 jam yang lalu</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Ketinggian air mencapai 1 meter, 50 KK terdampak.</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <span class="px-2.5 py-0.5 text-xs font-medium text-red-700 bg-red-100 rounded-full">Prioritas Tinggi</span>
                                        <span class="text-sm text-gray-500">Tim: 12 personel</span>
                                    </div>
                                    <button class="text-sm text-bpbd-primary hover:text-bpbd-primary/80">Detail</button>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Priority Analysis -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <h3 class="font-heading font-semibold text-lg text-gray-900 mb-4">Analisis Prioritas (AHP-TOPSIS)</h3>
                        <div class="space-y-4">
                            @foreach(['Banjir', 'Longsor', 'Kebakaran'] as $index => $bencana)
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $bencana }}</span>
                                        <span class="text-sm text-gray-500">{{ 90 - ($index * 15) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-bpbd-primary rounded-full h-2" style="width: {{ 90 - ($index * 15) }}%"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="mt-4 w-full px-4 py-2 text-sm text-bpbd-primary bg-bpbd-primary/5 rounded-lg hover:bg-bpbd-primary/10">
                            Lihat Detail Analisis
                        </button>
                    </div>

                    <!-- Resource Allocation -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <h3 class="font-heading font-semibold text-lg text-gray-900 mb-4">Alokasi Sumber Daya</h3>
                        <div class="space-y-4">
                            <div class="p-4 rounded-lg bg-blue-50 border border-blue-100">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-blue-800">Personel</span>
                                    <span class="text-xs text-blue-600">156/200</span>
                                </div>
                                <div class="w-full bg-blue-200 rounded-full h-2">
                                    <div class="bg-blue-600 rounded-full h-2" style="width: 78%"></div>
                                </div>
                            </div>

                            <div class="p-4 rounded-lg bg-green-50 border border-green-100">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-green-800">Peralatan</span>
                                    <span class="text-xs text-green-600">85%</span>
                                </div>
                                <div class="w-full bg-green-200 rounded-full h-2">
                                    <div class="bg-green-600 rounded-full h-2" style="width: 85%"></div>
                                </div>
                            </div>

                            <div class="p-4 rounded-lg bg-purple-50 border border-purple-100">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-purple-800">Dana</span>
                                    <span class="text-xs text-purple-600">2.5M/3M</span>
                                </div>
                                <div class="w-full bg-purple-200 rounded-full h-2">
                                    <div class="bg-purple-600 rounded-full h-2" style="width: 83%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <h3 class="font-heading font-semibold text-lg text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-2">
                            <button class="w-full px-4 py-2 text-sm text-white bg-bpbd-primary rounded-lg hover:bg-bpbd-primary/90">
                                Input Kejadian Baru
                            </button>
                            <button class="w-full px-4 py-2 text-sm text-bpbd-primary bg-white border border-bpbd-primary rounded-lg hover:bg-bpbd-primary/5">
                                Deployment Tim
                            </button>
                            <button class="w-full px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Generate Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>