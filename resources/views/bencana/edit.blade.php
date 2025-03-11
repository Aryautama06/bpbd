<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Bencana - BPBD Deli Serdang</title>
    
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
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, .heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        @include('components.sidebar')

        <main class="ml-64 p-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <a href="{{ route('bencana.index') }}" 
                       class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-semibold text-gray-800">Edit Data Bencana</h1>
                </div>
                <p class="text-gray-600">Perbarui informasi kejadian bencana di bawah ini</p>
            </div>

            <!-- Form -->
            <div class="max-w-5xl">
                <form action="{{ route('bencana.update', $bencana) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-12 gap-6">
                        <!-- Kolom Kiri (7 kolom) -->
                        <div class="col-span-7 space-y-6">
                            <!-- Card Informasi Dasar -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h2>
                                    <div class="space-y-4">
                                        <!-- Tanggal -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kejadian</label>
                                            <input type="date" name="tanggal" value="{{ old('tanggal', $bencana->tanggal) }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500 transition duration-200">
                                            @error('tanggal')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Jenis Bencana -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bencana</label>
                                            <select name="jenis_bencana" 
                                                    class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500">
                                                <option value="">Pilih Jenis Bencana</option>
                                                @foreach(['Banjir', 'Tanah Longsor', 'Angin Puting Beliung', 'Kebakaran', 'Gempa Bumi'] as $jenis)
                                                    <option value="{{ $jenis }}" 
                                                            {{ old('jenis_bencana', $bencana->jenis_bencana) == $jenis ? 'selected' : '' }}>
                                                        {{ $jenis }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jenis_bencana')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Penanganan</label>
                                            <select name="status" 
                                                    class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500">
                                                <option value="">Pilih Status</option>
                                                @foreach(['Proses', 'Selesai'] as $status)
                                                    <option value="{{ $status }}" 
                                                            {{ old('status', $bencana->status) == $status ? 'selected' : '' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Lokasi -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Lokasi Kejadian</h2>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                            <input type="text" name="lokasi" value="{{ old('lokasi', $bencana->lokasi) }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Masukkan alamat detail lokasi kejadian">
                                            @error('lokasi')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                            <input type="text" name="kecamatan" value="{{ old('kecamatan', $bencana->kecamatan) }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Masukkan nama kecamatan">
                                            @error('kecamatan')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan (5 kolom) -->
                        <div class="col-span-5 space-y-6">
                            <!-- Card Deskripsi -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Deskripsi Kejadian</h2>
                                    <div>
                                        <textarea name="deskripsi" rows="4"
                                                  class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                  placeholder="Jelaskan kronologi kejadian bencana">{{ old('deskripsi', $bencana->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Card Dampak -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Dampak Bencana</h2>
                                    <div class="space-y-4">
                                        <!-- Korban -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Korban Terdampak</label>
                                            <input type="text" name="dampak_korban" 
                                                   value="{{ old('dampak_korban', $bencana->dampak_korban) }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Contoh: 5 KK / 20 Jiwa">
                                        </div>

                                        <!-- Kerusakan -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Kerusakan</label>
                                            <input type="text" name="dampak_kerusakan" 
                                                   value="{{ old('dampak_kerusakan', $bencana->dampak_kerusakan) }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Contoh: 3 Rumah rusak berat">
                                        </div>

                                        <!-- Dampak Lain -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Dampak Lainnya</label>
                                            <textarea name="dampak" rows="2"
                                                      class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                      placeholder="Dampak lain yang ditimbulkan">{{ old('dampak', $bencana->dampak) }}</textarea>
                                        </div>

                                        <!-- Kerugian -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Kerugian (Rp)</label>
                                            <input type="number" name="kerugian" 
                                                   value="{{ old('kerugian', $bencana->kerugian) }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   step="1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('bencana.index') }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-800">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>