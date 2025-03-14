<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Manajemen Dana - BPBD</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="min-h-screen bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')

        <div class="lg:pl-64">
            <main>
                <!-- Header Section -->
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="text-3xl font-bold text-white">Manajemen Dana</h1>
                                        <p class="text-blue-100 mt-1">Pengelolaan Dana BPBD</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <a href="{{ route('dana.create') }}" 
                                       class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah Dana
                                    </a>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Total Dana -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Total Dana</h3>
                                        <span class="p-2 bg-emerald-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">Rp {{ number_format($totalDana, 0, ',', '.') }}</p>
                                </div>

                                <!-- APBD -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Dana APBD</h3>
                                        <span class="p-2 bg-blue-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">Rp {{ number_format($totalAPBD, 0, ',', '.') }}</p>
                                </div>

                                <!-- APBN -->
                                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-white">Dana APBN</h3>
                                        <span class="p-2 bg-purple-400/20 rounded-lg">
                                            <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <p class="text-2xl font-bold text-white">Rp {{ number_format($totalAPBN, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Filters -->
                        <div class="mb-6 p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="flex-1 min-w-0">
                                    <input type="text" 
                                           placeholder="Cari dana atau kegiatan..." 
                                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div class="flex flex-wrap items-center gap-4">
                                    <select class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Semua Jenis Dana</option>
                                        <option value="APBD">APBD</option>
                                        <option value="APBN">APBN</option>
                                        <option value="Bantuan">Bantuan</option>
                                    </select>
                                    <select class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Semua Status</option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Digunakan">Digunakan</option>
                                        <option value="Sisa">Sisa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kode & Kegiatan
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis Dana
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Terima
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($danas as $dana)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-medium text-gray-900">{{ $dana->nama_kegiatan }}</span>
                                                <span class="text-sm text-gray-500">{{ $dana->kode_anggaran }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $dana->jenis_dana === 'APBD' ? 'bg-blue-100 text-blue-800' : 
                                                   ($dana->jenis_dana === 'APBN' ? 'bg-purple-100 text-purple-800' : 
                                                    'bg-green-100 text-green-800') }}">
                                                {{ $dana->jenis_dana }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-900">
                                                Rp {{ number_format($dana->jumlah, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $dana->status === 'Diterima' ? 'bg-green-100 text-green-800' : 
                                                   ($dana->status === 'Digunakan' ? 'bg-yellow-100 text-yellow-800' : 
                                                    'bg-gray-100 text-gray-800') }}">
                                                {{ $dana->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-900">
                                                {{ $dana->tanggal_terima->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Detail button -->
                                                <button onclick="showDetail('{{ $dana->id }}')"
                                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                                        title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>

                                                <!-- Edit button -->
                                                <a href="{{ route('dana.edit', $dana->id) }}"
                                                   class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                                   title="Edit Dana">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>

                                                <!-- Delete button -->
                                                <button onclick="konfirmasiHapus('{{ $dana->id }}', '{{ $dana->kode_dana }}')"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                        title="Hapus Dana">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada data dana yang tersedia
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="form-hapus" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
    function konfirmasiHapus(id, kode) {
        Swal.fire({
            title: 'Hapus Dana?',
            html: `
                <div class="text-center">
                    <div class="mb-3">
                        <div class="mx-auto flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-2">Anda akan menghapus dana dengan kode:</p>
                        <p class="text-lg font-semibold text-gray-800">${kode}</p>
                    </div>
                    <p class="text-sm text-red-500">Tindakan ini akan menghapus semua data terkait dan tidak dapat dibatalkan</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-xl shadow-xl',
                confirmButton: 'rounded-lg px-4 py-2',
                cancelButton: 'rounded-lg px-4 py-2',
            },
            reverseButtons: true,
            showClass: {
                popup: 'animate__animated animate__fadeInUp animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutDown animate__faster'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('form-hapus');
                form.action = `{{ route('dana.destroy', '') }}/${id}`;
                form.submit();
            }
        });
    }

    // Success notification
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            customClass: {
                popup: 'rounded-xl shadow-xl',
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown animate__faster'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp animate__faster'
            }
        });
    @endif

    // Error notification
    @if(session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: "{{ session('error') }}",
            icon: 'error',
            showConfirmButton: true,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Tutup',
            customClass: {
                popup: 'rounded-xl shadow-xl',
                confirmButton: 'rounded-lg px-4 py-2'
            }
        });
    @endif
    </script>
</body>
</html>