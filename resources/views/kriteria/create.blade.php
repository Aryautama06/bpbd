<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Kriteria - BPBD</title>

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
                                <a href="{{ route('kriteria.index') }}" 
                                   class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                                <h1 class="text-2xl font-bold text-white">Tambah Kriteria Baru</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <form action="{{ route('kriteria.store') }}" method="POST" class="p-8">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kode Kriteria -->
                                    <div>
                                        <label for="kode_kriteria" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kode Kriteria <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="kode_kriteria" 
                                               id="kode_kriteria" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('kode_kriteria') }}"
                                               required>
                                        @error('kode_kriteria')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nama Kriteria -->
                                    <div>
                                        <label for="nama_kriteria" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Kriteria <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               name="nama_kriteria" 
                                               id="nama_kriteria" 
                                               class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('nama_kriteria') }}"
                                               required>
                                        @error('nama_kriteria')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Bobot -->
                                    <div>
                                        <label for="bobot" class="block text-sm font-medium text-gray-700 mb-2">
                                            Bobot (%) <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="number" 
                                                   name="bobot" 
                                                   id="bobot" 
                                                   class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                   value="{{ old('bobot') }}"
                                                   min="1"
                                                   max="100"
                                                   required>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500">%</span>
                                            </div>
                                        </div>
                                        @error('bobot')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jenis -->
                                    <div>
                                        <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jenis Kriteria <span class="text-red-500">*</span>
                                        </label>
                                        <select name="jenis" 
                                                id="jenis" 
                                                class="form-select w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Jenis Kriteria</option>
                                            <option value="Benefit" {{ old('jenis') == 'Benefit' ? 'selected' : '' }}>Benefit (Keuntungan)</option>
                                            <option value="Cost" {{ old('jenis') == 'Cost' ? 'selected' : '' }}>Cost (Biaya)</option>
                                        </select>
                                        @error('jenis')
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
                                    <a href="{{ route('kriteria.index') }}" 
                                       class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Simpan Kriteria
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