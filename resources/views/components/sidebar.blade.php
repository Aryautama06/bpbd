<aside class="fixed top-0 left-0 w-64 h-screen bg-white border-r border-gray-200 z-40">
    <!-- Logo & Title -->
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-200">
        <img src="{{ asset('images/logo_bpbd.png') }}" alt="BPBD Logo" class="h-10">
        <div>
            <h1 class="font-heading font-bold text-lg text-bpbd-primary leading-tight">BPBD</h1>
            <p class="text-xs text-gray-600">Deli Serdang</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4">
        <!-- Dashboard -->
        <div class="mb-2">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Manajemen Bencana -->
        <div class="mb-4">
            <h2 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Manajemen Bencana
            </h2>
            <div class="space-y-1">
                <a href="{{ route('bencana.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('bencana.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Data Bencana</span>
                </a>
            </div>
        </div>

        <!-- Sistem Pendukung Keputusan -->
        <div class="mb-4">
            <h2 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Sistem Pendukung Keputusan
            </h2>
            <div class="space-y-1">
                <a href="{{ route('kriteria.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('kriteria.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Kriteria</span>
                </a>

                <a href="{{ route('alternatif.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('alternatif.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    <span>Alternatif</span>
                </a>

                <a href="{{ route('perhitungan.ahp') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('perhitungan.ahp') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                    </svg>
                    <span>Perhitungan AHP</span>
                </a>

                <a href="{{ route('perhitungan.topsis') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('perhitungan.topsis') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Perhitungan TOPSIS</span>
                </a>

                <a href="{{ route('hasil.analisis') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('hasil.analisis') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Hasil Analisis</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- User Profile -->
    <div class="absolute bottom-0 w-full border-t border-gray-200">
        <div class="p-4">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=E63946&color=fff" 
                     alt="Profile" 
                     class="w-10 h-10 rounded-full">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>