<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Personel - BPBD Deli Serdang</title>
    
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
    
    <!-- Alpine.js -->
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

<body class="bg-gray-50/80">
    <div class="min-h-screen">
        @include('components.sidebar')

        <main class="ml-64 min-h-screen">
            <!-- Enhanced Header Section -->
            <div class="header-gradient relative overflow-hidden bg-bpbd-secondary/95 text-white">
                <div class="absolute inset-0 bg-grid opacity-10"></div>
                <div class="relative py-8 px-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Breadcrumb -->
                        <nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
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
                                    <span class="text-blue-100">Data Personel</span>
                                </li>
                            </ol>
                        </nav>

                        <!-- Header Content -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold mb-2">Data Personel</h1>
                                <p class="text-blue-100">Kelola data personel BPBD Kabupaten Deli Serdang</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <!-- Quick Stats Summary -->
                                <div class="flex gap-6 pr-6 border-r border-white/10">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">{{ $personels->count() }}</div>
                                        <div class="text-sm text-blue-100">Total Personel</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">{{ $personels->where('status', 'PNS')->count() }}</div>
                                        <div class="text-sm text-blue-100">PNS</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">{{ $personels->where('status', 'Kontrak')->count() }}</div>
                                        <div class="text-sm text-blue-100">Kontrak</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">{{ $personels->where('status', 'Sukarela')->count() }}</div>
                                        <div class="text-sm text-blue-100">Sukarela</div>
                                    </div>
                                </div>

                                <!-- Add Button -->
                                <a href="{{ route('personel.create') }}" 
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-white text-bpbd-secondary rounded-lg 
                                          hover:bg-blue-50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <span class="font-medium">Tambah Personel</span>
                                </a>
                            </div>
                        </div>

                        <!-- Filter Tabs -->
                        <div class="mt-8 flex items-center justify-between border-t border-white/10 pt-4">
                            <div class="flex gap-6">
                                <button class="px-4 py-2 text-sm font-medium text-white border-b-2 border-white">
                                    Semua Personel
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-blue-100 border-b-2 border-transparent 
                                             hover:text-white hover:border-white/50 transition-colors">
                                    PNS
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-blue-100 border-b-2 border-transparent 
                                             hover:text-white hover:border-white/50 transition-colors">
                                    Kontrak
                                </button>
                                <button class="px-4 py-2 text-sm font-medium text-blue-100 border-b-2 border-transparent 
                                             hover:text-white hover:border-white/50 transition-colors">
                                    Sukarela
                                </button>
                            </div>

                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Cari personel..." 
                                       class="w-64 px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white 
                                              placeholder-blue-100 focus:outline-none focus:bg-white/20 focus:border-white/30">
                                <svg class="w-5 h-5 text-blue-100 absolute right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Container -->
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
                                    @forelse($personels as $personel)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <!-- Informasi Personel -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="flex-shrink-0 h-12 w-12 relative">
                                                    @if($personel->foto)
                                                        <img class="h-12 w-12 rounded-lg object-cover shadow-sm border-2 border-white" 
                                                            src="{{ Storage::url($personel->foto) }}" 
                                                            alt="{{ $personel->nama }}">
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
                                                                {{ $personel->status === 'PNS' ? 'bg-green-400' : 
                                                                ($personel->status === 'Kontrak' ? 'bg-blue-400' : 'bg-yellow-400') }}">
                                                            </span>
                                                            <span class="relative inline-flex rounded-full h-3 w-3
                                                                {{ $personel->status === 'PNS' ? 'bg-green-500' : 
                                                                ($personel->status === 'Kontrak' ? 'bg-blue-500' : 'bg-yellow-500') }}">
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900">{{ $personel->nama }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        @if($personel->nip)
                                                            <span class="font-medium">NIP.</span> {{ $personel->nip }}
                                                        @else
                                                            <span class="text-gray-400 italic">Tanpa NIP</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Jabatan & Status -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 mb-1">{{ $personel->jabatan }}</div>
                                            <span class="px-2.5 py-1 inline-flex text-xs font-medium rounded-full
                                                {{ $personel->status === 'PNS' ? 'bg-green-100 text-green-800' : 
                                                ($personel->status === 'Kontrak' ? 'bg-blue-100 text-blue-800' : 
                                                    'bg-yellow-100 text-yellow-800') }}">
                                                {{ $personel->status }}
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
                                                    {{ $personel->no_hp }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit($personel->alamat, 30) }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Data Pribadi -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm space-y-1">
                                                <div class="text-gray-900">
                                                    {{ $personel->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                </div>
                                                <div class="text-gray-500">
                                                    {{ \Carbon\Carbon::parse($personel->tanggal_lahir)->isoFormat('D MMMM Y') }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('personel.show', $personel) }}" 
                                                class="p-1.5 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors"
                                                title="Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('personel.edit', $personel) }}" 
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
                                                    <button @click="showDeleteModal = true; personelToDelete = {{ $personel->id }}"
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
        </main>
    </div>
</body>
</html>