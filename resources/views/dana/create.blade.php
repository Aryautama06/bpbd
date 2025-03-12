<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Dana - BPBD</title>

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
                            <div class="flex items-center gap-4">
                                <a href="{{ route('dana.index') }}" 
                                   class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                                <h1 class="text-2xl font-bold text-white">Tambah Dana Baru</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <form action="{{ route('dana.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kode Anggaran -->
                                    <div>
                                        <label for="kode_anggaran" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kode Anggaran <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="kode_anggaran" 
                                               id="kode_anggaran" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('kode_anggaran') }}"
                                               required>
                                        @error('kode_anggaran')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nama Kegiatan -->
                                    <div>
                                        <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Kegiatan <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="nama_kegiatan" 
                                               id="nama_kegiatan" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('nama_kegiatan') }}"
                                               required>
                                        @error('nama_kegiatan')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jenis Dana -->
                                    <div>
                                        <label for="jenis_dana" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jenis Dana <span class="text-red-500">*</span>
                                        </label>
                                        <select name="jenis_dana" 
                                                id="jenis_dana" 
                                                class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Jenis Dana</option>
                                            <option value="APBD" {{ old('jenis_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                                            <option value="APBN" {{ old('jenis_dana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                                            <option value="Bantuan" {{ old('jenis_dana') == 'Bantuan' ? 'selected' : '' }}>Bantuan</option>
                                        </select>
                                        @error('jenis_dana')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jumlah -->
                                    <div>
                                        <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jumlah Dana <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                                Rp
                                            </span>
                                            <input type="number" 
                                                   name="jumlah" 
                                                   id="jumlah" 
                                                   class="form-input w-full pl-12 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                   value="{{ old('jumlah') }}"
                                                   min="0"
                                                   step="0.01"
                                                   required>
                                        </div>
                                        @error('jumlah')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Terima -->
                                    <div>
                                        <label for="tanggal_terima" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Terima <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" 
                                               name="tanggal_terima" 
                                               id="tanggal_terima" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('tanggal_terima') }}"
                                               required>
                                        @error('tanggal_terima')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                            Status <span class="text-red-500">*</span>
                                        </label>
                                        <select name="status" 
                                                id="status" 
                                                class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Status</option>
                                            <option value="Diterima" {{ old('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="Digunakan" {{ old('status') == 'Digunakan' ? 'selected' : '' }}>Digunakan</option>
                                            <option value="Sisa" {{ old('status') == 'Sisa' ? 'selected' : '' }}>Sisa</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Dokumen -->
                                    <div class="md:col-span-2">
                                        <label for="dokumen" class="block text-sm font-medium text-gray-700 mb-2">
                                            Dokumen Pendukung
                                        </label>
                                        <input type="file" 
                                               name="dokumen" 
                                               id="dokumen" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               accept=".pdf,.doc,.docx">
                                        <p class="mt-1 text-sm text-gray-500">
                                            Format yang diterima: PDF, DOC, DOCX (Maks. 2MB)
                                        </p>
                                        @error('dokumen')
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
                                    <a href="{{ route('dana.index') }}" 
                                       class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Simpan Dana
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