<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>
        <title>Data Bencana</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo_bpbd.png') }}">
    </head>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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

    <style>
        /* Base Typography */
        :root {
            --font-heading: 'Plus Jakarta Sans', system-ui, sans-serif;
            --font-body: 'Inter', system-ui, sans-serif;
        }

        body {
            font-family: var(--font-body);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
        }

        /* Custom Header Background */
        .header-gradient {
            background: linear-gradient(135deg, #1D3557 0%, #457B9D 100%);
            position: relative;
            overflow: hidden;
        }

        .header-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zM37.656 0l8.485 8.485-1.414 1.414L36.242 1.414 37.656 0zm-15.313 0L13.858 8.485l1.414 1.414L23.757 1.414 22.343 0zM32.8 0l10.657 10.657-1.414 1.414L30.385 0H32.8zm-5.6 0L16.544 10.657l1.414 1.414L29.615 0H27.2zM22.343 0L12.93 9.414l1.414 1.414L25.93 0h-3.586zm5.657 0L17.544 10.456 19 11.9l11.657-11.9h-2.657zm3.657 0l-6.485 6.485 1.414 1.414L36.242 0h-4.585zM20.343 0L13.858 6.485l1.414 1.414L22.757 0h-2.414zm-5.657 0L6.485 8.485l1.414 1.414L15.414 1.414 14 0H8.686zM36.242 0L26.83 9.414l1.414 1.414L39.657 0h-3.415zM7.372 0L0 7.372l1.414 1.414L9.414 0H7.372zm5.657 0L6.485 6.485 7.9 7.9l5.657-5.657L12.93 0h.1zM0 0l.828.828L2.243.343 1.414 0H0zm5.657.828L6.485 0h2.828L6.485 2.828 5.657.828zm3.415 3.415l4.242-4.243 1.414 1.414-4.242 4.243-1.414-1.414z' fill='%23ffffff' fill-opacity='0.1'/%3E%3C/svg%3E");
            opacity: 0.1;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Table Styles */
        .table-row {
            transition: background-color 0.15s ease;
        }

        .table-row:hover {
            background-color: rgba(243, 244, 246, 0.5);
        }

        /* Button Styles */
        .btn-primary {
            background-color: #E63946;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #dc2c3a;
            transform: translateY(-1px);
        }

        /* Status Badge Styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.025em;
        }

        .status-badge-success {
            background-color: #DEF7EC;
            color: #03543F;
            border: 1px solid rgba(3, 84, 63, 0.2);
        }

        .status-badge-warning {
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid rgba(146, 64, 14, 0.2);
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Form Elements */
        .form-input {
            border: 1px solid #E5E7EB;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 100%;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            border-color: #457B9D;
            box-shadow: 0 0 0 3px rgba(69, 123, 157, 0.1);
            outline: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .money-format {
            font-variant-numeric: tabular-nums;
            font-feature-settings: "tnum";
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        @include('components.sidebar')

        <main class="ml-64 min-h-screen">
            <!-- Enhanced Header Section -->
            <div class="header-gradient relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-pattern opacity-10"></div>
                
                <!-- Decorative Elements -->
                <div class="absolute right-0 top-0 w-64 h-64 transform translate-x-1/3 -translate-y-1/2">
                    <div class="absolute inset-0 bg-white opacity-10 rounded-full"></div>
                </div>
                
                <!-- Content Container -->
                <div class="relative z-10 px-8 py-16 max-w-5xl mx-auto">
                    <div class="flex items-start justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-3 font-heading tracking-tight">
                                Data Bencana
                            </h1>
                            <p class="text-blue-50/90 text-lg max-w-2xl leading-relaxed">
                                Kelola informasi kejadian bencana di wilayah Deli Serdang untuk penanganan yang lebih efektif
                            </p>
                            <!-- Quick Stats -->
                            <div class="mt-8 flex gap-6">
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3">
                                    <p class="text-blue-50/70 text-sm">Total Kejadian</p>
                                    <p class="text-white text-2xl font-bold mt-1">{{ $bencanas->count() }}</p>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3">
                                    <p class="text-blue-50/70 text-sm">Dalam Proses</p>
                                    <p class="text-white text-2xl font-bold mt-1">
                                        {{ $bencanas->where('status', 'Proses')->count() }}
                                    </p>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3">
                                    <p class="text-blue-50/70 text-sm">Selesai Ditangani</p>
                                    <p class="text-white text-2xl font-bold mt-1">
                                        {{ $bencanas->where('status', 'Selesai')->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Icon -->
                        <div class="hidden lg:block">
                            <svg class="w-32 h-32 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 21.626 12.5 21.126C12.4 20.626 12.8 20.026 13.3 19.926C13.8 19.826 14.4 20.226 14.5 20.7259ZM8.8 19.7259C8.9 20.2259 8.5 20.826 8 20.926C7.5 21.026 6.9 20.626 6.8 20.126C6.7 19.626 7.1 19.026 7.6 18.926C8.1 18.826 8.7 19.226 8.8 19.7259ZM5.2 18.7259C5.3 19.2259 4.9 19.826 4.4 19.926C3.9 20.026 3.3 19.626 3.2 19.126C3.1 18.626 3.5 18.026 4 17.926C4.5 17.826 5.1 18.226 5.2 18.7259ZM23 17.126V20.126C23 21.226 22.1 22.126 21 22.126H3C1.9 22.126 1 21.226 1 20.126V17.126C1 16.026 1.9 15.126 3 15.126H21C22.1 15.126 23 16.026 23 17.126ZM8 6.12598C8 6.67598 7.5 7.12598 7 7.12598C6.5 7.12598 6 6.67598 6 6.12598C6 5.57598 6.5 5.12598 7 5.12598C7.5 5.12598 8 5.57598 8 6.12598ZM17 7.12598C17.5 7.12598 18 6.67598 18 6.12598C18 5.57598 17.5 5.12598 17 5.12598C16.5 5.12598 16 5.57598 16 6.12598C16 6.67598 16.5 7.12598 17 7.12598ZM12 8.12598C12.5523 8.12598 13 7.67826 13 7.12598C13 6.57369 12.5523 6.12598 12 6.12598C11.4477 6.12598 11 6.57369 11 7.12598C11 7.67826 11.4477 8.12598 12 8.12598Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Bottom Gradient -->
                <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-gray-50"></div>
            </div>

            <!-- Rest of the content -->
            <div class="px-8 pb-8 -mt-6 relative z-20">
                <!-- Action Bar -->
                <div class="card p-4 mb-6">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-4">
                            <div class="relative">
                                <input type="text" 
                                       class="form-input pl-10" 
                                       placeholder="Cari lokasi atau jenis bencana...">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <select class="form-input">
                                <option value="">Semua Status</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <a href="{{ route('bencana.create') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Data Bencana
                        </a>
                    </div>
                </div>

                <!-- Tambahkan di bagian atas konten utama -->
                @if(session('success'))
                <div class="mb-8 fade-in" x-data="{ show: true }" x-show="show">
                    <div class="rounded-lg bg-green-50 p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                            <button @click="show = false" 
                                    class="ml-auto text-green-600 hover:text-green-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Data Table -->
                <div class="card">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Bencana</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dampak</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kerugian</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($bencanas as $bencana)
                                <tr class="{{ $bencana->created_at->isToday() ? 'bg-green-50/50' : '' }} hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $bencana->tanggal->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $bencana->jenis_bencana }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-medium">{{ $bencana->lokasi }}</div>
                                        <div class="text-gray-500 text-xs">Kec. {{ $bencana->kecamatan }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 text-xs font-medium rounded-md">
                                                {{ $bencana->korban_jiwa }} Korban
                                            </span>
                                            <span class="text-gray-500">|</span>
                                            <span class="text-gray-900">{{ $bencana->kerusakan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 money-format">
                                        Rp {{ number_format($bencana->kerugian, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge {{ $bencana->status === 'Selesai' ? 'status-badge-success' : 'status-badge-warning' }}">
                                            @if($bencana->status === 'Selesai')
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @endif
                                            {{ $bencana->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Detail button -->
                                            <a href="{{ route('bencana.show', $bencana->id) }}"
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
                                            <a href="{{ route('bencana.edit', $bencana->id) }}"
                                               class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                               title="Edit Data Bencana">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            <!-- Delete button -->
                                            <button onclick="konfirmasiHapus('{{ $bencana->id }}', '{{ $bencana->nama_bencana }}')"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Hapus Data Bencana">
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
                                    <td colspan="7" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <span class="text-gray-500 text-sm">Belum ada data bencana</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($bencanas->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $bencanas->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Form -->
    <form id="form-hapus" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
    function konfirmasiHapus(id, nama) {
        Swal.fire({
            title: 'Hapus Data Bencana?',
            html: `
                <div class="text-center">
                    <div class="mb-3">
                        <div class="mx-auto flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-2">Anda akan menghapus data bencana:</p>
                        <p class="text-lg font-semibold text-gray-800">${nama}</p>
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
                form.action = `{{ route('bencana.destroy', '') }}/${id}`;
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