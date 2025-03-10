<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <head>
            <title> BPBD Deli Serdang</title>
            <link rel="icon" type="image/png" href="{{ asset('images/logo_bpbd.png') }}">
        </head>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Additional CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

        <style>
            [x-cloak] { display: none !important; }
            
            .hero-pattern {
                background-color: #ffffff;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23e63946' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            :root {
                --bpbd-primary: #E63946;     /* Merah BPBD */
                --bpbd-secondary: #1D3557;    /* Biru Gelap */
                --bpbd-accent: #457B9D;       /* Biru Muda */
                --bpbd-light: #F1FAEE;        /* Putih Cream */
                --bpbd-dark: #1D3557;         /* Biru Gelap */
            }

            /* Custom Typography */
            body {
                background-color: var(--bpbd-light);
                color: var(--bpbd-dark);
            }

            /* Custom Button Styles */
            .btn-primary {
                background-color: var(--bpbd-primary);
                color: white;
                transition: all 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #d62836;
                transform: translateY(-2px);
            }

            .btn-outline {
                border: 2px solid var(--bpbd-primary);
                color: var(--bpbd-primary);
                transition: all 0.3s ease;
            }
            .btn-outline:hover {
                background-color: var(--bpbd-primary);
                color: white;
            }

            /* Custom Section Backgrounds */
            .bg-gradient {
                background: linear-gradient(135deg, var(--bpbd-primary) 0%, var(--bpbd-secondary) 100%);
            }

            /* Card Styles */
            .card-hover {
                transition: all 0.3s ease;
            }
            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            /* Custom Navigation */
            .nav-link {
                color: var(--bpbd-dark);
                transition: color 0.3s ease;
            }
            .nav-link:hover {
                color: var(--bpbd-primary);
            }

            /* Hero Section Enhancement */
            .hero-gradient {
                background: linear-gradient(45deg, rgba(230,57,70,0.05) 0%, rgba(29,53,87,0.05) 100%);
            }

            /* Feature Icons */
            .feature-icon {
                background-color: rgba(230,57,70,0.1);
                color: var(--bpbd-primary);
            }

            /* Animation Classes */
            .hover-scale {
                transition: transform 0.3s ease;
            }
            .hover-scale:hover {
                transform: scale(1.05);
            }

            /* Custom Shadows */
            .bpbd-shadow {
                box-shadow: 0 4px 6px -1px rgba(230,57,70,0.1), 0 2px 4px -1px rgba(230,57,70,0.06);
            }

            /* Section Transitions */
            .section-transition {
                position: relative;
                overflow: hidden;
            }
            .section-transition::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 50px;
                background: linear-gradient(to bottom, transparent, var(--bpbd-light));
            }

            /* Custom List Styles */
            .bpbd-list li {
                position: relative;
                padding-left: 1.5rem;
            }
            .bpbd-list li::before {
                content: '•';
                color: var(--bpbd-primary);
                position: absolute;
                left: 0;
            }

            /* Alert Styles */
            .alert-bpbd {
                background-color: rgba(230,57,70,0.1);
                border-left: 4px solid var(--bpbd-primary);
                padding: 1rem;
                margin: 1rem 0;
            }

            /* Progress Bar */
            .progress-bar {
                height: 0.5rem;
                background: linear-gradient(90deg, var(--bpbd-primary) 0%, var(--bpbd-accent) 100%);
                border-radius: 1rem;
            }

            /* Custom Border Accents */
            .border-accent {
                border-color: var(--bpbd-primary);
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: var(--bpbd-light);
            }
            ::-webkit-scrollbar-thumb {
                background: var(--bpbd-primary);
                border-radius: 4px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #d62836;
            }
        </style>
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
    </head>
    <body class="antialiased font-sans">
        <!-- Navigation -->
        <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <img class="h-8 w-auto" src="{{ asset('images/logo_bpbd.png') }}" alt="BPBD Logo">
                                <span class="ml-3 font-semibold text-gray-900">BPBD Deli Serdang</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-8">
                        <!-- Menu items -->
                        <a href="{{ url('/') }}" 
                           class="nav-link {{ request()->is('/') ? 'text-bpbd-primary font-semibold' : 'text-gray-700' }} hover:text-bpbd-primary transition-colors">
                            Beranda
                        </a>
                        <a href="{{ url('/berita') }}" 
                           class="nav-link {{ request()->is('berita*') ? 'text-bpbd-primary font-semibold' : 'text-gray-700' }} hover:text-bpbd-primary transition-colors">
                            Berita
                        </a>
                        <a href="{{ url('/data-bencana') }}" 
                           class="nav-link {{ request()->is('data-bencana*') ? 'text-bpbd-primary font-semibold' : 'text-gray-700' }} hover:text-bpbd-primary transition-colors">
                            Data Bencana
                        </a>
                        <a href="{{ url('/tentang') }}" 
                           class="nav-link {{ request()->is('tentang*') ? 'text-bpbd-primary font-semibold' : 'text-gray-700' }} hover:text-bpbd-primary transition-colors">
                            Tentang
                        </a>
                        
                        <!-- Login/Dashboard Button -->
                        <div class="flex items-center ml-4">
                            <a href="{{ route('login') }}" 
                               class="btn-primary px-6 py-2 rounded-lg font-medium hover:scale-105 transform transition-all duration-200">
                                Login
                            </a>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button type="button" 
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-bpbd-primary hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-bpbd-primary"
                                onclick="document.querySelector('.mobile-menu').classList.toggle('hidden')">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="hidden mobile-menu sm:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ url('/') }}" 
                       class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'text-bpbd-primary bg-gray-50' : 'text-gray-700' }} hover:text-bpbd-primary hover:bg-gray-50">
                        Beranda
                    </a>
                    <a href="{{ url('/berita') }}" 
                       class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('berita*') ? 'text-bpbd-primary bg-gray-50' : 'text-gray-700' }} hover:text-bpbd-primary hover:bg-gray-50">
                        Berita
                    </a>
                    <a href="{{ url('/data-bencana') }}" 
                       class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('data-bencana*') ? 'text-bpbd-primary bg-gray-50' : 'text-gray-700' }} hover:text-bpbd-primary hover:bg-gray-50">
                        Data Bencana
                    </a>
                    <a href="{{ url('/tentang') }}" 
                       class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('tentang*') ? 'text-bpbd-primary bg-gray-50' : 'text-gray-700' }} hover:text-bpbd-primary hover:bg-gray-50">
                        Tentang
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="block px-3 py-2 rounded-md text-base font-medium text-white bg-bpbd-primary hover:bg-bpbd-primary/90">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="block px-3 py-2 rounded-md text-base font-medium text-white bg-bpbd-primary hover:bg-bpbd-primary/90">
                                Login
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center pt-16 overflow-hidden">
            <!-- Background Video/Image Layer -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-bpbd-primary/90 to-bpbd-secondary/90 mix-blend-multiply z-10"></div>
                <video class="w-full h-full object-cover" autoplay loop muted playsinline>
                    <source src="{{ asset('videos/emergency-response.mp4') }}" type="video/mp4">
                </video>
                <!-- Fallback image if video doesn't load -->
                <img src="{{ asset('images/hero-bg.jpg') }}" alt="Emergency Response" class="w-full h-full object-cover">
            </div>

            <!-- Animated Particles -->
            <div class="absolute inset-0 z-10">
                <div id="particles-js"></div>
            </div>

            <!-- Content Layer -->
            <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Column -->
                    <div data-aos="fade-right" class="text-white">
                        <div class="inline-flex items-center px-4 py-2 rounded-full border border-white/30 backdrop-blur-sm mb-6">
                            <span class="animate-ping w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                            <span class="text-sm">Siaga 24/7 Penanganan Bencana</span>
                        </div>
                        
                        <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-6">
                            Sistem Pendukung Keputusan
                            <span class="block mt-2 text-transparent bg-clip-text bg-gradient-to-r from-red-300 to-red-100">
                                Multi-Bencana
                            </span>
                        </h1>
                        
                        <p class="text-xl text-gray-100 mb-8 leading-relaxed">
                            Optimalisasi alokasi sumber daya dalam penanganan bencana untuk respon yang lebih cepat dan efektif dengan dukungan teknologi terdepan.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="#features" 
                               class="group relative inline-flex items-center px-8 py-3 overflow-hidden rounded-lg bg-white text-bpbd-primary font-semibold hover:bg-white/90 transition-all duration-300">
                                <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                                <span class="relative flex items-center">
                                    Pelajari Lebih Lanjut
                                    <svg class="ml-2 w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </span>
                            </a>
                            
                            <a href="#contact" 
                               class="group relative inline-flex items-center px-8 py-3 overflow-hidden rounded-lg border-2 border-white text-white hover:bg-white/10 transition-all duration-300">
                                <span class="relative flex items-center">
                                    Hubungi Kami
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </span>
                            </a>
                        </div>

                        <!-- Emergency Stats -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-12">
                            <div class="text-center p-4 rounded-lg backdrop-blur-sm bg-white/10">
                                <div class="text-2xl font-bold">24/7</div>
                                <div class="text-sm text-gray-200">Siaga</div>
                            </div>
                            <div class="text-center p-4 rounded-lg backdrop-blur-sm bg-white/10">
                                <div class="text-2xl font-bold">500+</div>
                                <div class="text-sm text-gray-200">Tim Siap</div>
                            </div>
                            <div class="text-center p-4 rounded-lg backdrop-blur-sm bg-white/10">
                                <div class="text-2xl font-bold">15+</div>
                                <div class="text-sm text-gray-200">Pos Siaga</div>
                            </div>
                            <div class="text-center p-4 rounded-lg backdrop-blur-sm bg-white/10">
                                <div class="text-2xl font-bold">100%</div>
                                <div class="text-sm text-gray-200">Komitmen</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Emergency Status -->
                    <div data-aos="fade-left" class="hidden lg:block">
                        <div class="relative">
                            <!-- Decorative Elements -->
                            <div class="absolute -top-4 -right-4 w-72 h-72 bg-gradient-to-r from-red-500/30 to-blue-500/30 rounded-full blur-3xl"></div>
                            <div class="absolute -bottom-4 -left-4 w-72 h-72 bg-gradient-to-r from-blue-500/30 to-red-500/30 rounded-full blur-3xl"></div>
                            
                            <!-- Card Content -->
                            <div class="relative rounded-2xl backdrop-blur-sm bg-white/10 p-8 border border-white/20">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-semibold text-white">Status Siaga</h3>
                                    <span class="px-3 py-1 rounded-full bg-red-500/20 text-red-100 text-sm">Live Updates</span>
                                </div>

                                <!-- Emergency Status List -->
                                <div class="space-y-4">
                                    <div class="flex items-center p-4 rounded-lg bg-white/5 border border-white/10">
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-red-500/20 flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-red-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-white">Peringatan Dini</h4>
                                            <p class="text-xs text-gray-300">Potensi banjir di wilayah pesisir</p>
                                        </div>
                                        <div class="text-xs text-gray-400">5m ago</div>
                                    </div>

                                    <div class="flex items-center p-4 rounded-lg bg-white/5 border border-white/10">
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-yellow-500/20 flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-yellow-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-white">Status Siaga</h4>
                                            <p class="text-xs text-gray-300">Tim tanggap darurat dikerahkan</p>
                                        </div>
                                        <div class="text-xs text-gray-400">15m ago</div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <button class="p-4 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                                        <svg class="w-6 h-6 text-white mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        Notifikasi
                                    </button>
                                    <button class="p-4 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                                        <svg class="w-6 h-6 text-white mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Lokasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Utama</h2>
                    <p class="text-lg text-gray-600">Solusi komprehensif untuk penanganan bencana yang lebih efektif</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Analisis Data Real-time</h3>
                        <p class="text-gray-600">Pemantauan dan analisis data bencana secara real-time untuk pengambilan keputusan yang cepat.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Respons Cepat</h3>
                        <p class="text-gray-600">Sistem penanganan bencana yang teroptimasi untuk respons yang lebih cepat dan efektif.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Koordinasi Tim</h3>
                        <p class="text-gray-600">Koordinasi yang efektif antar tim penanganan bencana dengan sistem komunikasi terintegrasi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- News Section Enhancement -->
        <section class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita Terkini</h2>
                    <p class="text-lg text-gray-600">Informasi terbaru seputar penanganan bencana</p>
                </div>

                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- News 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative">
                            <img src="/images/banjir.jpg" alt="Banjir" class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 mt-4 mr-4">
                                <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm">Breaking News</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="text-red-600 text-sm font-semibold">Bencana Alam</span>
                                <span class="mx-2 text-gray-300">•</span>
                                <span class="text-gray-500 text-sm">2 jam yang lalu</span>
                            </div>
                            <h3 class="text-xl font-semibold mt-2 mb-3">Penanganan Banjir di Wilayah Pesisir</h3>
                            <p class="text-gray-600 mb-4">Tim BPBD berhasil mengevakuasi ratusan warga terdampak banjir...</p>
                            <a href="#" class="text-red-600 font-medium hover:text-red-700 flex items-center">
                                Baca selengkapnya 
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- News 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="200">
                        <div class="relative">
                            <img src="/images/gempa.jpeg" alt="Gempa" class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 mt-4 mr-4">
                                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">Update</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="text-red-600 text-sm font-semibold">Gempa Bumi</span>
                                <span class="mx-2 text-gray-300">•</span>
                                <span class="text-gray-500 text-sm">5 jam yang lalu</span>
                            </div>
                            <h3 class="text-xl font-semibold mt-2 mb-3">Gempa M5.2 Guncang Wilayah Timur</h3>
                            <p class="text-gray-600 mb-4">BPBD melaporkan tidak ada kerusakan signifikan pasca gempa...</p>
                            <a href="#" class="text-red-600 font-medium hover:text-red-700 flex items-center">
                                Baca selengkapnya 
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- News 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="300">
                        <div class="relative">
                            <img src="/images/training.jpg" alt="Training" class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 mt-4 mr-4">
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">Event</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="text-red-600 text-sm font-semibold">Pelatihan</span>
                                <span class="mx-2 text-gray-300">•</span>
                                <span class="text-gray-500 text-sm">1 hari yang lalu</span>
                            </div>
                            <h3 class="text-xl font-semibold mt-2 mb-3">Pelatihan Tanggap Bencana 2025</h3>
                            <p class="text-gray-600 mb-4">BPBD mengadakan pelatihan tanggap bencana untuk relawan...</p>
                            <a href="#" class="text-red-600 font-medium hover:text-red-700 flex items-center">
                                Baca selengkapnya 
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- View All News Button -->
                <div class="text-center mt-12">
                    <a href="/berita" class="inline-flex items-center px-8 py-3 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                        Lihat Semua Berita
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="relative py-24 overflow-hidden">
    <!-- Background with gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-bpbd-primary/90 to-bpbd-secondary/90">
        <div class="absolute inset-0 bg-[url('/images/pattern-grid.png')] opacity-10"></div>
    </div>

    <!-- Animated particles background -->
    <div class="absolute inset-0" id="stats-particles"></div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-white mb-4">Statistik Penanganan Bencana</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-white/40 to-white/10 mx-auto rounded-full"></div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Stat 1 -->
            <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-white/5 rounded-2xl transform group-hover:scale-105 transition-transform duration-500"></div>
                <div class="relative p-8 text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-white mb-2 tracking-tight">
                        <span class="inline-block" data-count="2500">0</span>+
                    </div>
                    <div class="text-lg text-white/80">Bencana Tertangani</div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="relative group" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute inset-0 bg-white/5 rounded-2xl transform group-hover:scale-105 transition-transform duration-500"></div>
                <div class="relative p-8 text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-white mb-2 tracking-tight">
                        <span class="inline-block" data-count="500">0</span>+
                    </div>
                    <div class="text-lg text-white/80">Relawan Aktif</div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="relative group" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute inset-0 bg-white/5 rounded-2xl transform group-hover:scale-105 transition-transform duration-500"></div>
                <div class="relative p-8 text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-white mb-2 tracking-tight">
                        <span class="inline-block" data-count="50000">0</span>+
                    </div>
                    <div class="text-lg text-white/80">Warga Terbantu</div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="relative group" data-aos="fade-up" data-aos-delay="400">
                <div class="absolute inset-0 bg-white/5 rounded-2xl transform group-hover:scale-105 transition-transform duration-500"></div>
                <div class="relative p-8 text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-white mb-2 tracking-tight">24/7</div>
                    <div class="text-lg text-white/80">Dukungan Siaga</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add this script before </body> -->
<script>
    // Counter animation function
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            element.textContent = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Initialize counter animations when section is in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('[data-count]').forEach(counter => {
                    animateValue(counter, 0, parseInt(counter.dataset.count), 2000);
                });
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    // Observe statistics section
    observer.observe(document.querySelector('.statistics-section'));

    // Initialize particles for statistics section
    particlesJS('stats-particles', {
        particles: {
            number: { value: 40, density: { enable: true, value_area: 800 } },
            color: { value: '#ffffff' },
            shape: { type: 'circle' },
            opacity: { value: 0.2, random: true },
            size: { value: 3, random: true },
            line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.2, width: 1 },
            move: { enable: true, speed: 2, direction: 'none', random: true, straight: false, out_mode: 'out', bounce: false }
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: { enable: true, mode: 'bubble' },
                resize: true
            },
            modes: {
                bubble: { distance: 200, size: 4, duration: 2, opacity: 0.8, speed: 3 }
            }
        },
        retina_detect: true
    });
</script>

        <!-- Emergency Contact Section -->
        <section class="py-16 bg-red-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-8 md:p-12">
                            <div class="text-red-600 font-semibold mb-4">Kontak Darurat</div>
                            <h3 class="text-2xl font-bold mb-4">Butuh Bantuan Darurat?</h3>
                            <p class="text-gray-600 mb-6">Tim kami siap 24/7 untuk membantu Anda dalam situasi darurat</p>
                            
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">Nomor Darurat</div>
                                        <div class="text-lg font-semibold">112</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">Email</div>
                                        <div class="text-lg font-semibold">darurat@bpbd.go.id</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-8 md:p-12 bg-red-600">
                            <form class="space-y-6">
                                <div>
                                    <label class="block text-white text-sm font-medium mb-2">Nama Lengkap</label>
                                    <input type="text" class="w-full px-4 py-2 rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                </div>
                                <div>
                                    <label class="block text-white text-sm font-medium mb-2">Nomor Telepon</label>
                                    <input type="tel" class="w-full px-4 py-2 rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                </div>
                                <div>
                                    <label class="block text-white text-sm font-medium mb-2">Deskripsi Kejadian</label>
                                    <textarea rows="4" class="w-full px-4 py-2 rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-red-500"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-white text-red-600 py-2 px-4 rounded-lg hover:bg-red-50 transition-colors">
                                    Kirim Laporan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">BPBD</h3>
                        <p class="text-gray-400">Badan Penanggulangan Bencana Daerah</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Tautan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Beranda</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Berita</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Data Bencana</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Tentang</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>Jl. Example Street No. 123</li>
                            <li>Phone: (123) 456-7890</li>
                            <li>Email: info@bpbd.go.id</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Media Sosial</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                    <p class="text-gray-400">&copy; {{ date('Y') }} BPBD. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Initialize AOS with more options
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false,
                anchorPlacement: 'center-bottom'
            });
        </script>
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script>
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80, density: { enable: true, value_area: 800 } },
                    color: { value: '#ffffff' },
                    shape: { type: 'circle' },
                    opacity: { value: 0.5, random: true },
                    size: { value: 3, random: true },
                    line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.4, width: 1 },
                    move: { enable: true, speed: 6, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'repulse' },
                        onclick: { enable: true, mode: 'push' },
                        resize: true
                    }
                },
                retina_detect: true
            });
        </script>
    </body>
</html>