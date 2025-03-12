<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Dana - {{ $dana->nama_kegiatan }} - BPBD</title>

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
                                <a href="{{ route('dana.show', $dana) }}" 
                                   class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                                <div>
                                    <h1 class="text-2xl font-bold text-white">Edit Dana</h1>
                                    <p class="text-blue-100">{{ $dana->nama_kegiatan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <form action="{{ route('dana.update', $dana) }}" method="POST" enctype="multipart/form-data" class="p-8">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kode Anggaran -->
                                    <div>
                                        <label for="kode_anggaran" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kode Anggaran <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="kode_anggaran" 
                                               id="kode_anggaran" 
                                               value="{{ old('kode_anggaran', $dana->kode_anggaran) }}"
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
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
                                               value="{{ old('nama_kegiatan', $dana->nama_kegiatan) }}"
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
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
                                            @foreach(['APBD', 'APBN', 'Bantuan'] as $jenis)
                                                <option value="{{ $jenis }}" {{ old('jenis_dana', $dana->jenis_dana) == $jenis ? 'selected' : '' }}>
                                                    {{ $jenis }}
                                                </option>
                                            @endforeach
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
                                                   value="{{ old('jumlah', $dana->jumlah) }}"
                                                   class="form-input w-full pl-12 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
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
                                               value="{{ old('tanggal_terima', $dana->tanggal_terima->format('Y-m-d')) }}"
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
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
                                            @foreach(['Diterima', 'Digunakan', 'Sisa'] as $status)
                                                <option value="{{ $status }}" {{ old('status', $dana->status) == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
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
                                        @if($dana->dokumen)
                                            <div class="mb-3 flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Dokumen Saat Ini</p>
                                                    <p class="text-sm text-gray-500">{{ basename($dana->dokumen) }}</p>
                                                </div>
                                                <a href="{{ Storage::url($dana->dokumen) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 hover:text-gray-900">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                    Download
                                                </a>
                                            </div>
                                        @endif
                                        <input type="file" 
                                               name="dokumen" 
                                               id="dokumen" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               accept=".pdf,.doc,.docx">
                                        <p class="mt-1 text-sm text-gray-500">
                                            Format yang diterima: PDF, DOC, DOCX (Maks. 2MB)
                                            @if($dana->dokumen)
                                                - Unggah file baru untuk mengganti dokumen yang ada
                                            @endif
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
                                                  class="form-textarea w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $dana->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="mt-6 flex items-center justify-end gap-4">
                                    <a href="{{ route('dana.show', $dana) }}" 
                                       class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Simpan Perubahan
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