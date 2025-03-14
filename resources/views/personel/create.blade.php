<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Tambah Personel - BPBD Deli Serdang</title>
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
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .heading { font-family: 'Plus Jakarta Sans', sans-serif; }
        .header-gradient {
            background: linear-gradient(135deg, #1D3557 0%, #457B9D 100%);
        }
        .form-section {
            transition: all 0.3s ease;
        }
        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
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
                                    <a href="{{ route('dashboard') }}" class="text-blue-100 hover:text-white transition-colors">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <a href="{{ route('personel.index') }}" class="text-blue-100 hover:text-white transition-colors">
                                        Data Personel
                                    </a>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <span class="text-blue-100">Tambah Personel</span>
                                </li>
                            </ol>
                        </nav>

                        <h1 class="text-2xl font-bold mb-2">Tambah Personel Baru</h1>
                        <p class="text-blue-100">Lengkapi informasi personel BPBD Kabupaten Deli Serdang</p>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="py-8 px-8">
                <div class="max-w-5xl mx-auto">
                    <form action="{{ route('personel.store') }}" method="POST" enctype="multipart/form-data" 
                          class="grid grid-cols-3 gap-6">
                        @csrf
                        
                        <!-- Left Column (2 columns wide) -->
                        <div class="col-span-2 space-y-6">
                            <!-- Informasi Pribadi -->
                            <div class="bg-white rounded-xl border border-gray-200 form-section">
                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="p-2 bg-blue-50 rounded-lg">
                                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <h2 class="text-lg font-semibold text-gray-800">Informasi Pribadi</h2>
                                    </div>

                                    <div class="space-y-5">
                                        <!-- Nama -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Nama Lengkap
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="nama" value="{{ old('nama') }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Masukkan nama lengkap"
                                                   required>
                                            @error('nama')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NIP & Status Grid -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    NIP
                                                </label>
                                                <input type="text" name="nip" value="{{ old('nip') }}"
                                                       class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                       placeholder="Masukkan NIP jika ada">
                                                @error('nip')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Status
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <select name="status" 
                                                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                        required>
                                                    <option value="">Pilih Status</option>
                                                    @foreach(['PNS', 'Kontrak', 'Sukarela'] as $status)
                                                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                                            {{ $status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Personal Info Grid -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Tanggal Lahir
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                                       class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                       required>
                                                @error('tanggal_lahir')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Jenis Kelamin
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <select name="jenis_kelamin" 
                                                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                        required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kepegawaian -->
                            <div class="bg-white rounded-xl border border-gray-200 form-section">
                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="p-2 bg-yellow-50 rounded-lg">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <h2 class="text-lg font-semibold text-gray-800">Informasi Kepegawaian</h2>
                                    </div>

                                    <div class="space-y-5">
                                        <!-- Jabatan -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Jabatan
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Masukkan jabatan"
                                                   required>
                                            @error('jabatan')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Foto Upload -->
                            <div class="bg-white rounded-xl border border-gray-200 form-section">
                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="p-2 bg-purple-50 rounded-lg">
                                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <h2 class="text-lg font-semibold text-gray-800">Foto Profil</h2>
                                    </div>

                                    <div x-data="{ imageUrl: null }" class="space-y-4">
                                        <!-- Image Preview -->
                                        <div x-show="imageUrl" 
                                             class="relative w-full aspect-square rounded-lg overflow-hidden bg-gray-50">
                                            <img :src="imageUrl" 
                                                 class="w-full h-full object-cover" 
                                                 alt="Preview">
                                            <button type="button"
                                                    @click="imageUrl = null; $refs.fileInput.value = ''"
                                                    class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Upload Area -->
                                        <div x-show="!imageUrl"
                                             class="text-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-gray-300 transition-colors">
                                            <div class="mb-4">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <input type="file" 
                                                   name="foto" 
                                                   accept="image/*" 
                                                   class="hidden" 
                                                   id="foto"
                                                   x-ref="fileInput"
                                                   @change="const file = $event.target.files[0]; 
                                                            if(file){ 
                                                                const reader = new FileReader();
                                                                reader.onload = (e) => imageUrl = e.target.result;
                                                                reader.readAsDataURL(file);
                                                            }">
                                            <label for="foto" class="cursor-pointer">
                                                <span class="mt-2 block text-sm font-medium text-gray-900">
                                                    Klik untuk upload foto
                                                </span>
                                                <span class="mt-1 block text-xs text-gray-500">
                                                    PNG, JPG atau JPEG (Maks. 2MB)
                                                </span>
                                            </label>
                                        </div>

                                        @error('foto')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div class="bg-white rounded-xl border border-gray-200 form-section">
                                <div class="p-6">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="p-2 bg-green-50 rounded-lg">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <h2 class="text-lg font-semibold text-gray-800">Kontak & Alamat</h2>
                                    </div>

                                    <div class="space-y-5">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Nomor HP
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                                   class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                   placeholder="Contoh: 081234567890"
                                                   required>
                                            @error('no_hp')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Alamat Lengkap
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <textarea name="alamat" rows="3"
                                                      class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500"
                                                      placeholder="Masukkan alamat lengkap"
                                                      required>{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-span-3 flex items-center justify-end gap-4 mt-6">
                            <a href="{{ route('personel.index') }}" 
                               class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-800">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-bpbd-primary text-white text-sm font-medium rounded-lg 
                                           hover:bg-bpbd-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bpbd-primary">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- AlpineJS for interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>