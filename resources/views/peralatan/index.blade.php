<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Manajemen Peralatan - {{ config('app.name') }}</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                        <div class="flex items-center gap-6">
                            <div class="p-4 bg-white/10 backdrop-blur-lg rounded-2xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white">Manajemen Peralatan</h1>
                                <p class="text-blue-100 mt-1">Kelola data peralatan BPBD</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('peralatan.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-lg rounded-lg text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Peralatan
                            </a>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-white">Total Peralatan</h3>
                                <span class="p-2 bg-emerald-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="text-2xl font-bold text-white mt-2">{{ $peralatan->count() }}</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-white">Kondisi Baik</h3>
                                <span class="p-2 bg-green-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="text-2xl font-bold text-white mt-2">
                                {{ $peralatan->where('kondisi', 'Baik')->count() }}
                            </p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-white">Rusak</h3>
                                <span class="p-2 bg-red-400/20 rounded-lg">
                                    <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                            </div>
                            <p class="text-2xl font-bold text-white mt-2">
                                {{ $peralatan->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat'])->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="py-8 px-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Alat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pengadaan</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($peralatan as $alat)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $alat->kode_alat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $alat->nama_alat }}</div>
                                            @if($alat->keterangan)
                                                <div class="text-sm text-gray-500">{{ Str::limit($alat->keterangan, 50) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $alat->kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $alat->jumlah }} unit
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $alat->kondisi === 'Baik' ? 'bg-green-100 text-green-800' : 
                                                   ($alat->kondisi === 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $alat->kondisi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $alat->lokasi_penyimpanan ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $alat->tanggal_pengadaan ? \Carbon\Carbon::parse($alat->tanggal_pengadaan)->format('d/m/Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Detail button -->
                                                <a href="{{ route('peralatan.update', $alat->id) }}"
                                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                                        title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>

                                                <!-- Edit button -->
                                                <a href="{{ route('peralatan.edit', $alat->id) }}"
                                                   class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                                   title="Edit Peralatan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>

                                                <!-- Delete button -->
                                                <button onclick="konfirmasiHapus('{{ $alat->id }}', '{{ $alat->nama_alat }}')"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                        title="Hapus Peralatan">
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
                                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Tidak ada data peralatan
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

        <!-- Add this modal for showing details -->
        <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div class="relative bg-white rounded-lg max-w-2xl w-full">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900" id="detail-title"></h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Spesifikasi</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="detail-spesifikasi"></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="detail-kategori"></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                                <dd class="mt-1 text-sm text-gray-900" id="detail-keterangan"></dd>
                            </div>
                        </dl>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <button type="button" onclick="hideDetail()"
                                class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add this JavaScript for detail modal -->
        <script>
        function showDetail(id) {
            fetch(`/peralatan/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-title').textContent = data.nama_alat;
                    document.getElementById('detail-spesifikasi').textContent = data.spesifikasi || '-';
                    document.getElementById('detail-kategori').textContent = data.kategori;
                    document.getElementById('detail-keterangan').textContent = data.keterangan || '-';
                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }

        function hideDetail() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function konfirmasiHapus(id, nama) {
            Swal.fire({
                title: 'Hapus Peralatan?',
                html: `
                    <div class="text-center">
                        <div class="mb-3">
                            <div class="mx-auto flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mb-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 mb-2">Anda akan menghapus peralatan:</p>
                            <p class="text-lg font-semibold text-gray-800">${nama}</p>
                        </div>
                        <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
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
                    form.action = `/peralatan/${id}`;  // Update the route
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
                title: 'Oops!',
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
    </div>

    <!-- Add this right after the table or before closing body tag -->
    <form id="form-hapus" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</body>
</html>