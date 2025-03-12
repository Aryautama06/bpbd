<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Peralatan - BPBD</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
<body class="min-h-screen bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')

        <div class="lg:pl-64">
            <main>
                <!-- Header -->
                <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary to-bpbd-accent">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 80 80" fill="none">
                            <pattern id="grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <rect x="9" y="0" width="2" height="2" fill="currentColor"/>
                            </pattern>
                            <rect width="100%" height="100%" fill="url(#grid)"/>
                        </svg>
                    </div>

                    <div class="relative py-8 px-8">
                        <div class="max-w-7xl mx-auto">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('peralatan.index') }}" 
                                   class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                                <h1 class="text-2xl font-bold text-white">Tambah Peralatan Baru</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <form action="{{ route('peralatan.store') }}" method="POST" class="p-8">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Nama Alat -->
                                    <div>
                                        <label for="nama_alat" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Alat <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="nama_alat" 
                                               id="nama_alat" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('nama_alat') }}"
                                               required>
                                        @error('nama_alat')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kode Alat -->
                                    <div>
                                        <label for="kode_alat" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kode Alat <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="kode_alat" 
                                               id="kode_alat" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('kode_alat') }}"
                                               required>
                                        @error('kode_alat')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kategori -->
                                    <div>
                                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kategori <span class="text-red-500">*</span>
                                        </label>
                                        <select name="kategori" 
                                                id="kategori" 
                                                class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Kendaraan" {{ old('kategori') == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                                            <option value="Alat Berat" {{ old('kategori') == 'Alat Berat' ? 'selected' : '' }}>Alat Berat</option>
                                            <option value="Alat Komunikasi" {{ old('kategori') == 'Alat Komunikasi' ? 'selected' : '' }}>Alat Komunikasi</option>
                                            <option value="Peralatan Rescue" {{ old('kategori') == 'Peralatan Rescue' ? 'selected' : '' }}>Peralatan Rescue</option>
                                        </select>
                                        @error('kategori')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jumlah -->
                                    <div>
                                        <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jumlah <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" 
                                               name="jumlah" 
                                               id="jumlah" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('jumlah') }}"
                                               min="0"
                                               required>
                                        @error('jumlah')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Kondisi -->
                                    <div>
                                        <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kondisi <span class="text-red-500">*</span>
                                        </label>
                                        <select name="kondisi" 
                                                id="kondisi" 
                                                class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Kondisi</option>
                                            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                            <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                            <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                        </select>
                                        @error('kondisi')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Lokasi Penyimpanan -->
                                    <div>
                                        <label for="lokasi_penyimpanan" class="block text-sm font-medium text-gray-700 mb-2">
                                            Lokasi Penyimpanan <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="lokasi_penyimpanan" 
                                               id="lokasi_penyimpanan" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('lokasi_penyimpanan') }}"
                                               required>
                                        @error('lokasi_penyimpanan')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Pengadaan -->
                                    <div>
                                        <label for="tanggal_pengadaan" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Pengadaan <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" 
                                               name="tanggal_pengadaan" 
                                               id="tanggal_pengadaan" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('tanggal_pengadaan') }}"
                                               required>
                                        @error('tanggal_pengadaan')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Spesifikasi -->
                                    <div class="md:col-span-2">
                                        <label for="spesifikasi" class="block text-sm font-medium text-gray-700 mb-2">
                                            Spesifikasi
                                        </label>
                                        <textarea name="spesifikasi" 
                                                  id="spesifikasi" 
                                                  rows="3" 
                                                  class="form-textarea w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('spesifikasi') }}</textarea>
                                        @error('spesifikasi')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="md:col-span-2">
                                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                            Keterangan
                                        </label>
                                        <textarea name="keterangan" 
                                                  id="keterangan" 
                                                  rows="3" 
                                                  class="form-textarea w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="mt-6 flex items-center justify-end gap-4">
                                    <a href="{{ route('peralatan.index') }}" 
                                       class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Simpan Peralatan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>