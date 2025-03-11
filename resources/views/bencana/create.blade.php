<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Bencana - BPBD Deli Serdang</title>
    
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
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* Custom Styles */
        :root {
            --font-plus-jakarta: 'Plus Jakarta Sans', sans-serif;
            --font-inter: 'Inter', sans-serif;
        }

        body {
            font-family: var(--font-inter);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-plus-jakarta);
        }

        /* Form Styles */
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-1.5;
        }

        .form-input {
            @apply mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                   focus:border-bpbd-primary focus:ring focus:ring-bpbd-primary/20 
                   transition-all duration-200;
        }

        .form-error {
            @apply mt-1.5 text-sm text-red-600 flex items-center gap-1;
        }

        .form-card {
            @apply bg-white rounded-xl shadow-sm border border-gray-200/60 p-8 
                   hover:border-gray-300/60 transition-all duration-200;
        }

        .form-section-title {
            @apply text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2;
        }

        /* Card Effects */
        .card-hover {
            @apply transition-all duration-300 ease-in-out;
        }

        .card-hover:hover {
            @apply shadow-lg transform -translate-y-0.5;
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header Pattern */
        .header-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E</svg>");
        }

        /* Input Focus Effects */
        .input-focus-effect {
            @apply transition-all duration-200;
        }

        .input-focus-effect:focus {
            @apply ring-2 ring-offset-2 ring-bpbd-primary/30;
        }

        /* Button Styles */
        .btn-primary {
            @apply px-6 py-2.5 bg-bpbd-primary text-white rounded-lg 
                   hover:bg-bpbd-primary/90 active:bg-bpbd-primary/95 
                   transition-all duration-200 focus:outline-none 
                   focus:ring-2 focus:ring-offset-2 focus:ring-bpbd-primary 
                   flex items-center gap-2 hover:scale-105;
        }

        .btn-secondary {
            @apply px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 
                   hover:bg-gray-50 transition-all duration-200 
                   focus:outline-none focus:ring-2 focus:ring-offset-2 
                   focus:ring-gray-500;
        }
    </style>
</head>

<body class="bg-gray-50/80">
    <div class="min-h-screen bg-gray-50/80">
        @include('components.sidebar')

        <main class="ml-64 min-h-screen p-6">
            <!-- Header Sederhana -->
            <div class="mb-8">
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('bencana.index') }}" 
                       class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Tambah Data Bencana</h1>
                </div>
                <p class="text-gray-600">Silakan lengkapi informasi kejadian bencana di bawah ini</p>
            </div>

            <!-- Form Card -->
            <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200">
                <form action="{{ route('bencana.store') }}" method="POST">
                    @csrf
                    
                    <!-- Grid Layout untuk Form -->
                    <div class="grid grid-cols-2 gap-6 p-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-6">
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                                
                                <!-- Tanggal -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kejadian</label>
                                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" 
                                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    @error('tanggal')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Jenis Bencana -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bencana</label>
                                    <select name="jenis_bencana" 
                                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                        <option value="">Pilih Jenis Bencana</option>
                                        @foreach(['Banjir', 'Tanah Longsor', 'Angin Puting Beliung', 'Kebakaran', 'Gempa Bumi'] as $jenis)
                                            <option value="{{ $jenis }}" {{ old('jenis_bencana') == $jenis ? 'selected' : '' }}>
                                                {{ $jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_bencana')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Lokasi Kejadian</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Detail</label>
                                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                               placeholder="Contoh: Jl. Sudirman No. 123">
                                        @error('lokasi')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}"
                                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                               placeholder="Masukkan nama kecamatan">
                                        @error('kecamatan')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-6">
                            <!-- Deskripsi & Dampak -->
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Deskripsi & Dampak</h3>
                                
                                <div class="space-y-4">
                                    <!-- Deskripsi Kejadian -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Deskripsi Kejadian
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="deskripsi" rows="3"
                                                  class="w-full rounded-lg border-gray-300 focus:border-bpbd-primary focus:ring focus:ring-bpbd-primary/20"
                                                  placeholder="Jelaskan kronologi kejadian secara detail">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Dampak Bencana dengan Format yang Sama seperti Index -->
                                    <div class="space-y-4">
    <label class="block text-sm font-medium text-gray-700">
        Dampak Bencana
        <span class="text-red-500">*</span>
    </label>
    
    <!-- Dampak Korban -->
    <div class="p-4 bg-orange-50 rounded-lg border border-orange-100">
        <div class="flex items-start gap-2 mb-3">
            <svg class="w-5 h-5 text-orange-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-gray-900">Korban Terdampak</p>
                <p class="text-xs text-gray-500">Masukkan jumlah korban jiwa/KK yang terdampak</p>
            </div>
        </div>
        <input type="text" 
               name="dampak_korban" 
               value="{{ old('dampak_korban') }}"
               class="w-full rounded-lg border-orange-200 bg-white focus:border-orange-400 focus:ring focus:ring-orange-200"
               placeholder="Contoh: 5 KK / 20 Jiwa terdampak">
        @error('dampak_korban')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Dampak Kerusakan -->
    <div class="p-4 bg-red-50 rounded-lg border border-red-100">
        <div class="flex items-start gap-2 mb-3">
            <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-gray-900">Kerusakan</p>
                <p class="text-xs text-gray-500">Jelaskan kerusakan infrastruktur/properti</p>
            </div>
        </div>
        <input type="text" 
               name="dampak_kerusakan" 
               value="{{ old('dampak_kerusakan') }}"
               class="w-full rounded-lg border-red-200 bg-white focus:border-red-400 focus:ring focus:ring-red-200"
               placeholder="Contoh: 3 Rumah rusak berat, 1 Sekolah terendam">
        @error('dampak_kerusakan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Dampak Lainnya -->
    <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
        <div class="flex items-start gap-2 mb-3">
            <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-gray-900">Dampak Lainnya</p>
                <p class="text-xs text-gray-500">Tambahkan informasi dampak lainnya jika ada</p>
            </div>
        </div>
        <textarea name="dampak" 
                  rows="2"
                  class="w-full rounded-lg border-blue-200 bg-white focus:border-blue-400 focus:ring focus:ring-blue-200"
                  placeholder="Contoh: Akses jalan terputus, aktivitas warga terganggu">{{ old('dampak') }}</textarea>
        @error('dampak')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

                                </div>
                            </div>

                            <!-- Status dan Kerugian -->
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-4">Status & Kerugian</h3>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select name="status" 
                                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                            <option value="">Pilih Status</option>
                                            @foreach(['Proses', 'Selesai'] as $status)
                                                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Kerugian (Rp)</label>
                                        <input type="number" name="kerugian" value="{{ old('kerugian', 0) }}"
                                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 p-6 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('bencana.index') }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Add Alpine.js for enhanced interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>