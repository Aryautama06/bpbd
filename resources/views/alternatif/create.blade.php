<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Tambah Alternatif - BPBD</title>
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
                            <div class="flex items-center gap-4">
                                <a href="{{ route('alternatif.index') }}" 
                                   class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                                <h1 class="text-2xl font-bold text-white">Tambah Alternatif Baru</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <form action="{{ route('alternatif.store') }}" method="POST" class="p-8">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kode Alternatif -->
                                    <div>
                                        <label for="kode_alternatif" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kode Alternatif <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="kode_alternatif" 
                                               id="kode_alternatif" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('kode_alternatif') }}"
                                               required>
                                        @error('kode_alternatif')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nama Alternatif -->
                                    <div>
                                        <label for="nama_alternatif" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Alternatif <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="nama_alternatif" 
                                               id="nama_alternatif" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('nama_alternatif') }}"
                                               required>
                                        @error('nama_alternatif')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="md:col-span-2">
                                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                            Deskripsi
                                        </label>
                                        <textarea name="deskripsi" 
                                                  id="deskripsi" 
                                                  rows="3" 
                                                  class="form-textarea w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="mt-6 flex items-center justify-end gap-4">
                                    <a href="{{ route('alternatif.index') }}" 
                                       class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Simpan Alternatif
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