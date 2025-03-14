<aside class="fixed top-0 left-0 w-64 h-screen bg-white border-r border-gray-200 z-40 flex flex-col">
    <!-- Logo & Title - Fixed -->
    <div class="flex-shrink-0 flex items-center gap-3 px-6 py-5 border-b border-gray-200">
        <img src="{{ asset('images/logo_bpbd.png') }}" alt="BPBD Logo" class="h-10">
        <div>
            <h1 class="font-heading font-bold text-lg text-bpbd-primary leading-tight">BPBD</h1>
            <p class="text-xs text-gray-600">Deli Serdang</p>
        </div>
    </div>

    <!-- Navigation - Scrollable -->
    <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        <!-- Dashboard -->
        <div>
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-bpbd-primary text-gray' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
            </a>
        </div>

        <!-- Manajemen Bencana -->
        <div>
            <h2 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Manajemen Bencana
            </h2>
            <div class="space-y-1">
                <a href="{{ route('bencana.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('bencana.*') ? 'bg-bpbd-primary hover:bg-bpbd-primary/90' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('bencana.*') ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="{{ request()->routeIs('bencana.*') ? 'text-white' : 'text-gray-700' }}">Data Bencana</span>
                </a>
            </div>
        </div>

        <!-- Manajemen Sumber Daya -->
        <div>
            <h2 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Manajemen Sumber Daya
            </h2>
            <div class="space-y-1">
                <!-- Personel -->
                <a href="{{ route('personel.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('personel.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Personel</span>
                </a>

                <!-- Peralatan -->
                <a href="{{ route('peralatan.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('peralatan.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span>Peralatan</span>
                </a>

                <!-- Dana -->
                <a href="{{ route('dana.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dana.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Dana</span>
                </a>
            </div>
        </div>

        <!-- Sistem Pendukung Keputusan -->
        <div>
            <h2 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Sistem Pendukung Keputusan
            </h2>
            <div class="space-y-1">
                <!-- Kriteria -->
                <a href="{{ route('kriteria.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('kriteria.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Kriteria</span>
                </a>

                <!-- Alternatif -->
                <a href="{{ route('alternatif.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('alternatif.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    <span>Alternatif</span>
                </a>

                <!-- Perhitungan AHP-TOPSIS -->
                <a href="{{ route('perhitungan.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('perhitungan.*') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <span>Perhitungan AHP-TOPSIS</span>
                </a>

                <a href="{{ route('analisis.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('hasil.analisis') ? 'bg-bpbd-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Hasil Analisis</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- User Profile - Fixed -->
    <div class="flex-shrink-0 border-t border-gray-200">
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