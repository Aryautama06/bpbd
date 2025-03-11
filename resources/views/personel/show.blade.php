<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Personel - BPBD Deli Serdang</title>
    
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
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .heading { font-family: 'Plus Jakarta Sans', sans-serif; }
        .header-gradient { background: linear-gradient(135deg, #1D3557 0%, #457B9D 100%); }
        .header-gradient { 
            position: relative;
            overflow: hidden;
        }
        .header-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')

        <main class="ml-64 min-h-screen">
            <!-- Enhanced Header -->
            <div class="header-gradient text-white">
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Breadcrumb -->
                        <nav class="mb-6 text-sm" aria-label="Breadcrumb">
                            <ol class="flex items-center space-x-2">
                                <li>
                                    <a href="{{ route('dashboard') }}" class="text-blue-100 hover:text-white transition-colors">Dashboard</a>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <a href="{{ route('personel.index') }}" class="text-blue-100 hover:text-white transition-colors">Data Personel</a>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <span class="text-blue-100">Detail Personel</span>
                                </li>
                            </ol>
                        </nav>

                        <!-- Header Content with Profile Preview -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-6">
                                <!-- Profile Image -->
                                <div class="relative group">
                                    @if($personel->foto)
                                        <div class="w-32 h-32 rounded-xl overflow-hidden ring-4 ring-white/50 shadow-lg transition-transform group-hover:scale-105">
                                            <img src="{{ Storage::url($personel->foto) }}" 
                                                 alt="{{ $personel->nama }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-32 h-32 rounded-xl ring-4 ring-white/50 shadow-lg bg-gradient-to-br from-gray-100/20 to-gray-100/10 flex items-center justify-center transition-transform group-hover:scale-105">
                                            <svg class="w-16 h-16 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Status Badge -->
                                    <div class="absolute -bottom-3 -right-3">
                                        <span class="px-4 py-1.5 rounded-full text-sm font-medium shadow-lg
                                            {{ $personel->status === 'PNS' ? 'bg-gradient-to-r from-green-500 to-green-600' : 
                                               ($personel->status === 'Kontrak' ? 'bg-gradient-to-r from-blue-500 to-blue-600' : 
                                                'bg-gradient-to-r from-yellow-500 to-yellow-600') }} text-white">
                                            {{ $personel->status }}
                                        </span>
                                    </div>

                                    <!-- Hover Effect Glow -->
                                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl blur opacity-0 group-hover:opacity-20 transition-opacity"></div>
                                </div>

                                <!-- Basic Info -->
                                <div>
                                    <h1 class="text-2xl font-bold mb-1">{{ $personel->nama }}</h1>
                                    <p class="text-blue-100 flex items-center gap-2">
                                        <span>{{ $personel->jabatan }}</span>
                                        @if($personel->nip)
                                            <span class="text-blue-200">•</span>
                                            <span>NIP. {{ $personel->nip }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3">
                                <a href="{{ route('personel.edit', $personel) }}" 
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white rounded-lg 
                                          hover:bg-white/20 transition-colors focus:outline-none focus:ring-2 focus:ring-white/50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    <span class="cursor-pointer">Edit Data</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="py-8 px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-3 gap-6">
                        <!-- Left Column -->
                        <div class="col-span-2 space-y-6">
                            <!-- Informasi Pribadi -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pribadi</h2>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</h3>
                                            <p class="text-gray-900">{{ $personel->nama }}</p>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">NIP</h3>
                                            <p class="text-gray-900">{{ $personel->nip ?? 'Tidak ada NIP' }}</p>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Jenis Kelamin</h3>
                                            <p class="text-gray-900">
                                                {{ $personel->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</h3>
                                            <p class="text-gray-900">
                                                {{ \Carbon\Carbon::parse($personel->tanggal_lahir)->isoFormat('D MMMM Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kepegawaian -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kepegawaian</h2>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Jabatan</h3>
                                            <p class="text-gray-900">{{ $personel->jabatan }}</p>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Status</h3>
                                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-sm font-medium
                                                {{ $personel->status === 'PNS' ? 'bg-green-100 text-green-800' : 
                                                   ($personel->status === 'Kontrak' ? 'bg-blue-100 text-blue-800' : 
                                                    'bg-yellow-100 text-yellow-800') }}">
                                                {{ $personel->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Kontak -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Kontak & Alamat</h2>
                                    <div class="space-y-4">
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Nomor HP</h3>
                                            <p class="text-gray-900 flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $personel->no_hp }}
                                            </p>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500 mb-1">Alamat</h3>
                                            <p class="text-gray-900">{{ $personel->alamat }}</p>
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
</body>
</html>