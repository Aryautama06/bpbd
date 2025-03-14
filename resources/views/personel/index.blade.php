<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Personel - {{ config('app.name') }}</title>

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
<body class="min-h-screen bg-gray-50">
    @include('components.sidebar')

    <div class="lg:pl-64">
        <!-- Header -->
        <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary to-bpbd-accent">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
            </div>
            <div class="relative py-12 px-8">

                    <!-- Header -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary to-bpbd-accent">
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                        </div>
                        <div class="relative py-12 px-8">
                            <div class="max-w-7xl mx-auto">
                                <!-- Header Content -->
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-8">
                                    <div class="flex items-center gap-6">
                                        <div class="p-4 bg-white/10 backdrop-blur-lg rounded-2xl">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h1 class="text-3xl font-bold text-white">Manajemen Personel</h1>
                                            <p class="text-blue-100 mt-1">Kelola data personel BPBD</p>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('personel.create') }}" 
                                        class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg rounded-lg text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Tambah Personel
                                        </a>
                                    </div>
                                </div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <!-- Total Personel -->
                                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white">Total Personel</h3>
                                            <span class="p-2 bg-emerald-400/20 rounded-lg">
                                                <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="text-2xl font-bold text-white">{{ $personel->count() }}</p>
                                    </div>

                                    <!-- PNS -->
                                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white">PNS</h3>
                                            <span class="p-2 bg-blue-400/20 rounded-lg">
                                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="text-2xl font-bold text-white">{{ $personel->where('status', 'PNS')->count() }}</p>
                                    </div>

                                    <!-- Kontrak -->
                                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white">Kontrak</h3>
                                            <span class="p-2 bg-purple-400/20 rounded-lg">
                                                <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="text-2xl font-bold text-white">{{ $personel->where('status', 'Kontrak')->count() }}</p>
                                    </div>

                                    <!-- Sukarela -->
                                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white">Sukarela</h3>
                                            <span class="p-2 bg-yellow-400/20 rounded-lg">
                                                <svg class="w-6 h-6 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="text-2xl font-bold text-white">{{ $personel->where('status', 'Sukarela')->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Your existing table content here -->
        <div class="py-8 px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Success Message -->
                @if(session('success'))
                <div class="mb-6">
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="rounded-lg bg-green-50 p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Replace the existing Data Table section -->
                <div class="relative bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Personel</h3>
                            
                            <!-- Table Controls -->
                            <div class="flex items-center gap-4">
                                <!-- Status Filter Dropdown -->
                                <select class="form-select rounded-lg border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Kontrak">Kontrak</option>
                                    <option value="Sukarela">Sukarela</option>
                                </select>

                                <!-- Search Input -->
                                <div class="relative">
                                    <input type="text" 
                                        placeholder="Cari personel..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm w-64 focus:border-blue-500 focus:ring-blue-500">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Informasi Personel
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jabatan & Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Kontak
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Data Pribadi
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($list_personel as $p)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <!-- Informasi Personel -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 h-12 w-12 relative">
                                                @if($p->foto)
                                                    <img class="h-12 w-12 rounded-lg object-cover shadow-sm border-2 border-white" 
                                                        src="{{ Storage::url($p->foto) }}" 
                                                        alt="{{ $p->nama }}">
                                                @else
                                                    <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-white shadow-sm">
                                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="absolute -bottom-1 -right-1">
                                                    <span class="flex h-3 w-3">
                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                                            {{ $p->status === 'PNS' ? 'bg-green-400' : 
                                                            ($p->status === 'Kontrak' ? 'bg-blue-400' : 'bg-yellow-400') }}">
                                                        </span>
                                                        <span class="relative inline-flex rounded-full h-3 w-3
                                                            {{ $p->status === 'PNS' ? 'bg-green-500' : 
                                                            ($p->status === 'Kontrak' ? 'bg-blue-500' : 'bg-yellow-500') }}">
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $p->nama }}</div>
                                                <div class="text-xs text-gray-500">
                                                    @if($p->nip)
                                                        <span class="font-medium">NIP.</span> {{ $p->nip }}
                                                    @else
                                                        <span class="text-gray-400 italic">Tanpa NIP</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Jabatan & Status -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 mb-1">{{ $p->jabatan }}</div>
                                        <span class="px-2.5 py-1 inline-flex text-xs font-medium rounded-full
                                            {{ $p->status === 'PNS' ? 'bg-green-100 text-green-800' : 
                                            ($p->status === 'Kontrak' ? 'bg-blue-100 text-blue-800' : 
                                                'bg-yellow-100 text-yellow-800') }}">
                                            {{ $p->status }}
                                        </span>
                                    </td>

                                    <!-- Kontak -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm space-y-1">
                                            <div class="flex items-center gap-1 text-gray-900">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $p->no_hp }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit($p->alamat, 30) }}
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Data Pribadi -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm space-y-1">
                                            <div class="text-gray-900">
                                                {{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </div>
                                            <div class="text-gray-500">
                                                {{ \Carbon\Carbon::parse($p->tanggal_lahir)->isoFormat('D MMMM Y') }}
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('personel.show', $p) }}" 
                                            class="p-1.5 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('personel.edit', $p) }}" 
                                            class="p-1.5 text-yellow-600 hover:text-yellow-900 hover:bg-yellow-50 rounded-lg transition-colors"
                                            title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>
                                            <div x-data="{ showDeleteModal: false, personelToDelete: null }">
                                                <!-- Delete Modal -->
                                                <div x-show="showDeleteModal" 
                                                    class="fixed inset-0 z-50 overflow-y-auto"
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transition ease-in duration-200"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0">
                                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                                                        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" 
                                                            x-show="showDeleteModal"
                                                            @click="showDeleteModal = false">
                                                        </div>

                                                        <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                                                            x-show="showDeleteModal"
                                                            x-transition:enter="transition ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave="transition ease-in duration-200"
                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                                            <div class="sm:flex sm:items-start">
                                                                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                                        Hapus Data Personel
                                                                    </h3>
                                                                    <div class="mt-2">
                                                                        <p class="text-sm text-gray-500">
                                                                            Apakah Anda yakin ingin menghapus data personel ini? 
                                                                            Tindakan ini tidak dapat dibatalkan.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                                                <form :action="`/personel/${personelToDelete}`" 
                                                                    method="POST" 
                                                                    class="inline-flex justify-center w-full sm:ml-3 sm:w-auto">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" 
                                                                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                                <button type="button" 
                                                                        @click="showDeleteModal = false"
                                                                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                                    Batal
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Replace the delete button in your table with this -->
                                                <button @click="showDeleteModal = true; personelToDelete = {{ $p->id }}"
                                                        class="p-1.5 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors"
                                                        title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm">Belum ada data personel</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>