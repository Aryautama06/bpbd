<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
            <title> LOGIN</title>
            <link rel="icon" type="image/png" href="{{ asset('images/logo_bpbd.png') }}">
        </head>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Additional CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                        'heading': ['Poppins', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Animated Background -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-bpbd-primary/5 to-bpbd-secondary/5"></div>
        <div class="absolute inset-0" id="particles-bg"></div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-6xl grid md:grid-cols-2 gap-8 items-center">
            <!-- Left Side - Information -->
            <div class="hidden md:block p-8">
                <div class="animate__animated animate__fadeInLeft">
                    <a href="{{ url('/') }}" class="inline-flex items-center space-x-2 text-bpbd-primary hover:text-bpbd-primary/80 transition-colors mb-8">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>
                    
                    <img src="{{ asset('images/logo_bpbd.png') }}" alt="BPBD Logo" class="h-16 mb-8">
                    <h1 class="auth-title text-4xl lg:text-5xl text-bpbd-secondary mb-4">Selamat Datang di BPBD Deli Serdang</h1>
                    <p class="text-gray-600 mb-8">Sistem Pendukung Keputusan Alokasi Sumber Daya Penanganan Multi-Bencana</p>
                    
                    <!-- Features List -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-bpbd-primary/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="feature-title text-bpbd-secondary">Keamanan Terjamin</h3>
                                <p class="text-sm text-gray-500">Data Anda dilindungi dengan enkripsi tingkat tinggi</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-bpbd-primary/10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="feature-title text-bpbd-secondary">Respons Cepat</h3>
                                <p class="text-sm text-gray-500">Akses cepat ke data dan informasi penting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Auth Forms -->
            <div class="w-full max-w-md mx-auto">
                <div class="bg-white/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden animate__animated animate__fadeInRight border border-white/20">
                    <!-- Tab Navigation -->
                    <div class="flex text-sm font-medium bg-gray-50/50 p-1 m-3 rounded-xl">
                        <button onclick="switchTab('login')" 
                                class="flex-1 p-3 text-center tab-btn active-tab transition-all duration-300 rounded-lg flex items-center justify-center space-x-2" 
                                id="login-tab">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Masuk</span>
                        </button>
                        <button onclick="switchTab('register')" 
                                class="flex-1 p-3 text-center tab-btn transition-all duration-300 rounded-lg flex items-center justify-center space-x-2" 
                                id="register-tab">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>Daftar</span>
                        </button>
                    </div>

                    <!-- Login Form -->
                    <div id="login-form" class="p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-heading font-bold text-bpbd-secondary">Selamat Datang Kembali</h3>
                            <p class="text-gray-600 mt-2">Silakan masuk ke akun Anda</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                    Email
                                </label>
                                <div class="relative group">
                                    <input type="email" 
                                           name="email" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-sm text-bpbd-primary hidden group-focus-within:block">@bpbd.go.id</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Password
                                </label>
                                <div class="relative group">
                                    <input type="password" 
                                           name="password" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-bpbd-primary"
                                            onclick="togglePassword(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" 
                                           id="remember_me" 
                                           name="remember" 
                                           class="w-4 h-4 text-bpbd-primary focus:ring-bpbd-primary/20 border-gray-300 rounded transition-all">
                                    <label for="remember_me" class="text-sm text-gray-600 hover:text-gray-700 transition-colors">
                                        Ingat Saya
                                    </label>
                                </div>

                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-bpbd-primary hover:text-bpbd-primary/80 transition-colors font-medium">
                                    Lupa Password?
                                </a>
                            </div>

                            <button type="submit" 
                                    class="button-text w-full bg-gradient-to-r from-bpbd-primary to-bpbd-secondary text-white py-3 rounded-xl hover:from-bpbd-primary/90 hover:to-bpbd-secondary/90 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                                <span class="flex items-center justify-center">
                                    <span>Login</span>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </span>
                            </button>

                            <!-- Social Login -->
                            <div class="relative my-8">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 py-1 bg-white text-gray-500 rounded-full border">atau masuk dengan</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <button type="button" 
                                        class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5 mr-2" alt="Google">
                                    <span class="text-sm font-medium text-gray-700">Google</span>
                                </button>
                                <button type="button" 
                                        class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Octicons-mark-github.svg" class="w-5 h-5 mr-2" alt="GitHub">
                                    <span class="text-sm font-medium text-gray-700">GitHub</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Register Form -->
                    <div id="register-form" class="hidden p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-heading font-bold text-bpbd-secondary">Buat Akun Baru</h3>
                            <p class="text-gray-600 mt-2">Daftar untuk mengakses dashboard</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf
                            <!-- Name Input -->
                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Nama Lengkap
                                </label>
                                <div class="relative group">
                                    <input type="text" 
                                           name="name" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                    Email
                                </label>
                                <div class="relative group">
                                    <input type="email" 
                                           name="email" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-sm text-bpbd-primary hidden group-focus-within:block">@bpbd.go.id</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    Nomor Telepon
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="text-gray-500">+62</span>
                                    </div>
                                    <input type="tel" 
                                           name="phone" 
                                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Password
                                </label>
                                <div class="relative group">
                                    <input type="password" 
                                           name="password" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-bpbd-primary"
                                            onclick="togglePassword(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Confirmation -->
                            <div class="space-y-2">
                                <label class="form-label flex items-center text-sm font-medium text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-bpbd-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Konfirmasi Password
                                </label>
                                <div class="relative group">
                                    <input type="password" 
                                           name="password_confirmation" 
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-bpbd-primary/20 focus:border-bpbd-primary transition-all bg-white/50 backdrop-blur-sm group-hover:bg-white/80"
                                           required>
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-bpbd-primary"
                                            onclick="togglePassword(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" 
                                           id="terms" 
                                           name="terms" 
                                           class="w-4 h-4 text-bpbd-primary focus:ring-bpbd-primary/20 border-gray-300 rounded transition-all"
                                           required>
                                </div>
                                <label for="terms" class="ml-2 text-sm text-gray-600">
                                    Saya setuju dengan 
                                    <a href="#" class="text-bpbd-primary hover:text-bpbd-primary/80 font-medium">Syarat & Ketentuan</a>
                                    dan 
                                    <a href="#" class="text-bpbd-primary hover:text-bpbd-primary/80 font-medium">Kebijakan Privasi</a>
                                </label>
                            </div>

                            <!-- Register Button -->
                            <button type="submit" 
                                    class="button-text w-full bg-gradient-to-r from-bpbd-primary to-bpbd-secondary text-white py-3 rounded-xl hover:from-bpbd-primary/90 hover:to-bpbd-secondary/90 transform hover:scale-[1.02] transition-all duration-300 shadow-lg hover:shadow-xl">
                                <span class="flex items-center justify-center">
                                    <span>Daftar Sekarang</span>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Tab switching functionality
        function switchTab(tab) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginTab.classList.add('active-tab');
                registerTab.classList.remove('active-tab');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                loginTab.classList.remove('active-tab');
                registerTab.classList.add('active-tab');
            }
        }

        // Initialize particles background
        particlesJS('particles-bg', {
            particles: {
                number: { value: 40, density: { enable: true, value_area: 800 } },
                color: { value: '#e63946' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: '#e63946', opacity: 0.2, width: 1 },
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

        // Password toggle functionality
        function togglePassword(button) {
            const input = button.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            const svg = button.querySelector('svg');
            if (type === 'text') {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }
    </script>

    <style>
        .tab-btn {
            @apply text-gray-500 border-b-2 border-transparent transition-all duration-300;
        }
        .active-tab {
            @apply text-bpbd-primary border-bpbd-primary font-semibold;
        }
        .form-input:focus {
            @apply ring-2 ring-bpbd-primary border-transparent;
        }
        
        /* Gradient Animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .gradient-animate {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        h1, h2, h3, h4, h5, h6 {
            @apply font-heading;
        }
        
        .auth-title {
            @apply font-display font-bold tracking-tight;
        }
        
        .form-label {
            @apply font-sans font-medium tracking-wide;
        }
        
        .button-text {
            @apply font-display font-semibold tracking-wide;
        }
        
        /* Update specific elements */
        #login-tab, #register-tab {
            @apply font-display font-medium;
        }
        
        .feature-title {
            @apply font-heading font-semibold;
        }
    </style>
</body>
</html>