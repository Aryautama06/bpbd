<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Detail Peralatan - {{ $peralatan->nama_alat }} - BPBD</title>
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

                    <div class="relative py-8 px-8">
                        <div class="max-w-7xl mx-auto">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('peralatan.index') }}" 
                                       class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </a>
                                    <div>
                                        <h1 class="text-2xl font-bold text-white">{{ $peralatan->nama_alat }}</h1>
                                        <p class="text-blue-100">Kode: {{ $peralatan->kode_alat }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('peralatan.edit', $peralatan) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('peralatan.destroy', $peralatan) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-white rounded-lg transition-colors">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Main Info Card -->
                            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Peralatan</h2>
                                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                                            <dd class="mt-1">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $peralatan->kategori }}
                                                </span>
                                            </dd>
                                        </div>

                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Kondisi</dt>
                                            <dd class="mt-1">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                    {{ $peralatan->kondisi === 'Baik' ? 'bg-green-100 text-green-800' : 
                                                       ($peralatan->kondisi === 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 
                                                        'bg-red-100 text-red-800') }}">
                                                    {{ $peralatan->kondisi }}
                                                </span>
                                            </dd>
                                        </div>

                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Jumlah</dt>
                                            <dd class="mt-1 text-sm text-gray-900">{{ $peralatan->jumlah }} Unit</dd>
                                        </div>

                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Lokasi Penyimpanan</dt>
                                            <dd class="mt-1 text-sm text-gray-900">{{ $peralatan->lokasi_penyimpanan }}</dd>
                                        </div>

                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Tanggal Pengadaan</dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($peralatan->tanggal_pengadaan)->format('d F Y') }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <!-- Side Info Card -->
                            <div class="space-y-6">
                                <!-- Spesifikasi -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Spesifikasi</h2>
                                        <div class="prose prose-sm max-w-none text-gray-500">
                                            {!! nl2br(e($peralatan->spesifikasi)) ?: '<span class="text-gray-400">Tidak ada spesifikasi</span>' !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Keterangan</h2>
                                        <div class="prose prose-sm max-w-none text-gray-500">
                                            {!! nl2br(e($peralatan->keterangan)) ?: '<span class="text-gray-400">Tidak ada keterangan</span>' !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Meta Info -->
                                <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
                                    <div class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Terakhir diperbarui: {{ $peralatan->updated_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>