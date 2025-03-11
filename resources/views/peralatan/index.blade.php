<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Peralatan - BPBD</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
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

        /* Enhanced Scrollbar Styling */
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 4px;
            border: 2px solid #f8fafc;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

        /* Table Container Shadow Effect */
        .overflow-x-auto {
            background: 
                linear-gradient(to right, white 30%, rgba(255, 255, 255, 0)),
                linear-gradient(to right, rgba(255, 255, 255, 0), white 70%) 100% 0,
                radial-gradient(farthest-side at 0 50%, rgba(0, 0, 0, .2), rgba(0, 0, 0, 0)),
                radial-gradient(farthest-side at 100% 50%, rgba(0, 0, 0, .2), rgba(0, 0, 0, 0)) 100% 0;
            background-repeat: no-repeat;
            background-size: 40px 100%, 40px 100%, 14px 100%, 14px 100%;
            background-position: 0 0, 100% 0, 0 0, 100% 0;
            background-attachment: local, local, scroll, scroll;
        }

        /* Smooth Table Hover Animation */
        tr {
            transition: all 0.2s ease;
        }

        /* Sticky Header */
        thead {
            position: sticky;
            top: 0;
            z-index: 10;
            background: #f8fafc;
        }

        /* Enhanced Table Styling */
        .custom-scrollbar {
            margin: 0;
            padding: 0;
            overflow-x: auto;
            border-radius: 0.75rem;
        }

        /* Improved Scrollbar Styling */
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            margin: 0 0.75rem;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 100vh;
            border: none;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Table Container Shadow Effects */
        .overflow-x-auto {
            position: relative;
            background: 
                linear-gradient(to right, white 30%, rgba(255, 255, 255, 0)),
                linear-gradient(to right, rgba(255, 255, 255, 0), white 70%) 100% 0,
                radial-gradient(farthest-side at 0 50%, rgba(0, 0, 0, .1), rgba(0, 0, 0, 0)),
                radial-gradient(farthest-side at 100% 50%, rgba(0, 0, 0, .1), rgba(0, 0, 0, 0)) 100% 0;
            background-repeat: no-repeat;
            background-size: 50px 100%, 50px 100%, 20px 100%, 20px 100%;
            background-position: 0 0, 100% 0, 0 0, 100% 0;
            background-attachment: local, local, scroll, scroll;
        }

        /* Enhanced Table Header */
        thead {
            position: sticky;
            top: 0;
            z-index: 10;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        thead th {
            background: #f8fafc;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-transform: uppercase;
            color: #475569;
            padding: 0.875rem 1.5rem;
            white-space: nowrap;
        }

        /* Table Body Styling */
        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        tbody td {
            padding: 1rem 1.5rem;
            color: #1f2937;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        /* Status Badge Enhancement */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
            align-items: center;
        }

        /* Responsive Design */
        @media (max-width: 1280px) {
            .custom-scrollbar {
                margin: 0;
            }
            
            thead th {
                padding: 0.75rem 1rem;
            }
            
            tbody td {
                padding: 0.75rem 1rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')

        <div class="lg:pl-64">
            <main>
                <!-- Page Content -->
                <div x-data="{ 
                    searchQuery: '',
                    filterKondisi: '',
                    filterKategori: '',
                }" class="py-8 px-4 sm:px-8">

                    <div x-data="{
                        focusType: 'all',
                        searchQuery: '',
                        filterKondisi: '',
                        filterKategori: '',
                        getFilteredPeralatan() {
                            return this.peralatan.filter(item => {
                                const matchSearch = item.nama_alat.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                                  item.kode_alat.toLowerCase().includes(this.searchQuery.toLowerCase());
                                const matchKondisi = this.filterKondisi === '' || item.kondisi === this.filterKondisi;
                                const matchKategori = this.filterKategori === '' || item.kategori === this.filterKategori;
                                return matchSearch && matchKondisi && matchKategori;
                            });
                        }
                    }" class="py-8 px-8">
                        <div class="max-w-7xl mx-auto">
                            <!-- Success Message -->
                            @if(session('success'))
                                <div x-data="{ show: true }" 
                                     x-show="show" 
                                     x-init="setTimeout(() => show = false, 5000)"
                                     class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="font-medium">{{ session('success') }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Replace existing header content and stats section -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-bpbd-secondary via-blue-800 to-bpbd-accent">
                                <!-- Animated Background Pattern -->
                                <div class="absolute inset-0 opacity-10">
                                    <div class="absolute inset-0 transform translate-y-1/2">
                                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                                    </div>
                                    <div class="absolute inset-0 transform -translate-y-1/2">
                                        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 32px 32px; animation: patternMove 60s linear infinite;"></div>
                                    </div>
                                </div>

                                <!-- Content Container -->
                                <div class="relative py-12 px-8">
                                    <div class="max-w-7xl mx-auto">
                                        <!-- Main Header Section -->
                                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-12">
                                            <!-- Left Section -->
                                            <div class="flex items-start gap-8">
                                                <!-- Icon Container with Glow Effect -->
                                                <div class="relative flex-shrink-0">
                                                    <div class="absolute inset-0 bg-blue-500 opacity-20 blur-xl rounded-full"></div>
                                                    <div class="relative p-5 bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-xl rounded-2xl border border-white/10 shadow-lg">
                                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                                        </svg>
                                                    </div>
                                                </div>

                                                <!-- Title and Metadata -->
                                                <div class="space-y-4">
                                                    <div>
                                                        <h1 class="text-4xl font-bold text-white tracking-tight mb-2">
                                                            Manajemen Peralatan
                                                        </h1>
                                                        <p class="text-blue-100/80 text-lg">
                                                            Sistem Pengelolaan Data Peralatan dan Inventaris
                                                        </p>
                                                    </div>
                                                    
                                                    <!-- Metadata Pills -->
                                                    <div class="flex flex-wrap items-center gap-4">
                                                        <div class="flex items-center px-4 py-2 bg-white/10 rounded-full backdrop-blur-lg">
                                                            <svg class="w-5 h-5 text-blue-200 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                            </svg>
                                                            <span class="text-sm font-medium text-blue-100">Total: {{ $peralatan->count() }} Unit</span>
                                                        </div>
                                                        <div class="flex items-center px-4 py-2 bg-white/10 rounded-full backdrop-blur-lg">
                                                            <svg class="w-5 h-5 text-blue-200 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                            <span class="text-sm font-medium text-blue-100">
                                                                Update: {{ now()->format('d M Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Right Section - Action Buttons -->
                                            <div class="flex items-center gap-4">
                                                <a href="{{ route('peralatan.create') }}" 
                                                class="group relative inline-flex items-center px-8 py-3 bg-white/10 hover:bg-white/20 
                                                        backdrop-blur-lg border border-white/10 hover:border-white/20 rounded-xl 
                                                        text-white transition-all duration-200 hover:scale-105 focus:outline-none 
                                                        focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-blue-800">
                                                    <span class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 
                                                            group-hover:opacity-100 rounded-xl transition-opacity"></span>
                                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                    </svg>
                                                    <span class="font-semibold relative z-10">Tambah Peralatan</span>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Stats Cards -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                            <!-- Card templates here (your existing stats cards) -->
                                            <!-- Total Peralatan -->
                                            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h3 class="text-lg font-semibold text-white">Total Peralatan</h3>
                                                    <span class="p-2 bg-white/10 rounded-lg">
                                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="flex items-baseline">
                                                    <span class="text-3xl font-bold text-white">{{ $peralatan->count() }}</span>
                                                    <span class="ml-2 text-sm text-blue-100">Unit</span>
                                                </div>
                                            </div>

                                            <!-- Kondisi Baik -->
                                            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h3 class="text-lg font-semibold text-white">Kondisi Baik</h3>
                                                    <span class="p-2 bg-emerald-400/20 rounded-lg">
                                                        <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="flex items-baseline">
                                                    <span class="text-3xl font-bold text-white">{{ $peralatan->where('kondisi', 'Baik')->count() }}</span>
                                                    <span class="ml-2 text-sm text-blue-100">Unit</span>
                                                </div>
                                            </div>

                                            <!-- Rusak Ringan -->
                                            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h3 class="text-lg font-semibold text-white">Rusak Ringan</h3>
                                                    <span class="p-2 bg-yellow-400/20 rounded-lg">
                                                        <svg class="w-6 h-6 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="flex items-baseline">
                                                    <span class="text-3xl font-bold text-white">{{ $peralatan->where('kondisi', 'Rusak Ringan')->count() }}</span>
                                                    <span class="ml-2 text-sm text-blue-100">Unit</span>
                                                </div>
                                            </div>

                                            <!-- Rusak Berat -->
                                            <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h3 class="text-lg font-semibold text-white">Rusak Berat</h3>
                                                    <span class="p-2 bg-red-400/20 rounded-lg">
                                                        <svg class="w-6 h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="flex items-baseline">
                                                    <span class="text-3xl font-bold text-white">{{ $peralatan->where('kondisi', 'Rusak Berat')->count() }}</span>
                                                    <span class="ml-2 text-sm text-blue-100">Unit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enhanced Wave Pattern -->
                                <div class="absolute bottom-0 left-0 right-0">
                                    <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-gray-50/80 to-transparent"></div>
                                    <svg class="relative w-full h-12 text-gray-50/80" preserveAspectRatio="none" viewBox="0 0 1440 120">
                                        <path d="M0,0 C240,120 720,-120 1440,0 L1440,120 L0,120 Z" fill="currentColor"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Informasi Alat
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Lokasi & Jumlah
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Spesifikasi & Keterangan
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($peralatan as $alat)
                                            <tr class="hover:bg-gray-50/50 transition-colors">
                                                <!-- Informasi Alat -->
                                                <td class="px-6 py-4">
                                                    <div class="flex flex-col">
                                                        <div class="flex items-center gap-3">
                                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                          d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <div class="text-sm font-medium text-gray-900">{{ $alat->nama_alat }}</div>
                                                                <div class="text-sm text-gray-500">{{ $alat->kode_alat }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                                {{ $alat->kategori }}
                                                            </span>
                                                            <span class="text-xs text-gray-500 ml-2">
                                                                Pengadaan: {{ \Carbon\Carbon::parse($alat->tanggal_pengadaan)->format('d M Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Status -->
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full 
                                                        {{ $alat->kondisi === 'Baik' ? 'bg-green-100 text-green-800' : 
                                                        ($alat->kondisi === 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 
                                                            'bg-red-100 text-red-800') }}">
                                                        {{ $alat->kondisi }}
                                                    </span>
                                                </td>

                                                <!-- Lokasi & Jumlah -->
                                                <td class="px-6 py-4">
                                                    <div class="flex flex-col">
                                                        <div class="flex items-center text-sm text-gray-900">
                                                            <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            </svg>
                                                            {{ $alat->lokasi_penyimpanan }}
                                                        </div>
                                                        <div class="mt-1 flex items-center text-sm text-gray-500">
                                                            <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                                            </svg>
                                                            {{ $alat->jumlah }} Unit
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Spesifikasi & Keterangan -->
                                                <td class="px-6 py-4">
                                                    <div class="flex flex-col">
                                                        @if($alat->spesifikasi)
                                                            <div class="text-sm text-gray-900 line-clamp-2">
                                                                {{ $alat->spesifikasi }}
                                                            </div>
                                                        @endif
                                                        @if($alat->keterangan)
                                                            <div class="mt-1 text-sm text-gray-500 line-clamp-1">
                                                                {{ $alat->keterangan }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>

                                                <!-- Aksi -->
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex items-center justify-end gap-2">
                                                        <a href="{{ route('peralatan.show', $alat) }}" 
                                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                        </a>
                                                        <a href="{{ route('peralatan.edit', $alat) }}" 
                                                        class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('peralatan.destroy', $alat) }}" 
                                                            method="POST" 
                                                            class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                    Belum ada data peralatan yang tersedia
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
            </main>
        </div>
    </div>
</body>
</html>