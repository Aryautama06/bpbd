<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Detail Bencana - BPBD Deli Serdang</title>
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

</head>
<body class="bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')

        <main class="ml-64 p-8">
            <!-- Header dengan Breadcrumb -->
            <div class="mb-8">
                <nav class="flex items-center space-x-3 text-sm mb-4" aria-label="Breadcrumb">
                    <a href="{{ route('bencana.index') }}" 
                       class="text-gray-500 hover:text-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Data Bencana
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600 font-medium">Detail Kejadian</span>
                </nav>

                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Detail Kejadian Bencana
                    </h1>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('bencana.edit', $bencana) }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            Edit Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Detail Card -->
            <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Header Card dengan Status -->
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-blue-500/10 rounded-lg">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Jenis Bencana</p>
                                <h2 class="text-xl font-bold text-gray-900">{{ $bencana->jenis_bencana }}</h2>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $bencana->status === 'Selesai' 
                                    ? 'bg-green-100 text-green-800' 
                                    : 'bg-yellow-100 text-yellow-800' }}">
                                @if($bencana->status === 'Selesai')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                                {{ $bencana->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Detail -->
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-6">
                            <!-- Waktu dan Lokasi -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Waktu & Lokasi</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($bencana->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                            </p>
                                            <p class="text-sm text-gray-500">Tanggal Kejadian</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $bencana->lokasi }}</p>
                                            <p class="text-sm text-gray-500">{{ $bencana->kecamatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Deskripsi Kejadian</h3>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    {{ $bencana->deskripsi }}
                                </p>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-6">
                            <!-- Dampak -->
                            <div>
    <h3 class="text-sm font-medium text-gray-500 mb-4">Dampak Bencana</h3>
    <div class="space-y-4 bg-gray-50 rounded-lg p-4 border border-gray-200">
        <!-- Korban -->
        <div class="flex items-start gap-3">
            <div class="p-2 bg-orange-50 rounded-lg">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">Korban Terdampak</p>
                <p class="text-sm text-gray-600">
                    @if($bencana->dampak_korban)
                        {{ $bencana->dampak_korban }}
                    @else
                        <span class="text-gray-400 italic">Tidak ada data korban</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Kerusakan -->
        <div class="flex items-start gap-3">
            <div class="p-2 bg-red-50 rounded-lg">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">Kerusakan Infrastruktur</p>
                <p class="text-sm text-gray-600">
                    @if($bencana->dampak_kerusakan)
                        {{ $bencana->dampak_kerusakan }}
                    @else
                        <span class="text-gray-400 italic">Tidak ada data kerusakan</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Dampak Lainnya -->
        <div class="flex items-start gap-3">
            <div class="p-2 bg-blue-50 rounded-lg">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">Dampak Lainnya</p>
                <p class="text-sm text-gray-600">
                    @if($bencana->dampak)
                        {{ $bencana->dampak }}
                    @else
                        <span class="text-gray-400 italic">Tidak ada data dampak lainnya</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Kerugian Materiil -->
        <div class="flex items-start gap-3">
            <div class="p-2 bg-green-50 rounded-lg">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">Estimasi Kerugian</p>
                <p class="text-sm text-gray-600">
                    Rp {{ number_format($bencana->kerugian, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
</div>
                        </div>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <p>Dibuat pada {{ $bencana->created_at->isoFormat('D MMMM Y, HH:mm') }}</p>
                        <p>Terakhir diupdate {{ $bencana->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>