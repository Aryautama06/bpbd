<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Dana - {{ $dana->nama_kegiatan }} - BPBD</title>

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
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('dana.index') }}" 
                                       class="p-2 text-white/70 hover:text-white rounded-lg transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </a>
                                    <div>
                                        <h1 class="text-2xl font-bold text-white">{{ $dana->nama_kegiatan }}</h1>
                                        <p class="text-blue-100">Kode: {{ $dana->kode_anggaran }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('dana.edit', $dana) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('dana.destroy', $dana) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-white rounded-lg transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Main Info Card -->
                            <div class="lg:col-span-2 space-y-6">
                                <!-- Detail Dana -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dana</h2>
                                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Jenis Dana</dt>
                                                <dd class="mt-1">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                        {{ $dana->jenis_dana === 'APBD' ? 'bg-blue-100 text-blue-800' : 
                                                           ($dana->jenis_dana === 'APBN' ? 'bg-purple-100 text-purple-800' : 
                                                            'bg-green-100 text-green-800') }}">
                                                        {{ $dana->jenis_dana }}
                                                    </span>
                                                </dd>
                                            </div>

                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                                <dd class="mt-1">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                        {{ $dana->status === 'Diterima' ? 'bg-green-100 text-green-800' : 
                                                           ($dana->status === 'Digunakan' ? 'bg-yellow-100 text-yellow-800' : 
                                                            'bg-gray-100 text-gray-800') }}">
                                                        {{ $dana->status }}
                                                    </span>
                                                </dd>
                                            </div>

                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Jumlah Dana</dt>
                                                <dd class="mt-1 text-sm font-semibold text-gray-900">
                                                    Rp {{ number_format($dana->jumlah, 0, ',', '.') }}
                                                </dd>
                                            </div>

                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Tanggal Terima</dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    {{ $dana->tanggal_terima->format('d F Y') }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                @if($dana->keterangan)
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Keterangan</h2>
                                        <div class="prose prose-sm max-w-none text-gray-500">
                                            {!! nl2br(e($dana->keterangan)) !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Side Info -->
                            <div class="space-y-6">
                                <!-- Dokumen -->
                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Dokumen Pendukung</h2>
                                        @if($dana->dokumen)
                                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                <div class="flex items-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900">Dokumen</p>
                                                        <p class="text-sm text-gray-500">{{ basename($dana->dokumen) }}</p>
                                                    </div>
                                                </div>
                                                <a href="{{ Storage::url($dana->dokumen) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                    Download
                                                </a>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-500">Tidak ada dokumen yang tersedia</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Meta Info -->
                                <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
                                    <div class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            <div class="flex items-center gap-2 mb-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Dibuat: {{ $dana->created_at->format('d F Y H:i') }}
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Terakhir diperbarui: {{ $dana->updated_at->diffForHumans() }}
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
    </div>
</body>
</html>