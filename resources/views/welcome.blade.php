<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Sparepart Sinar Jaya - Solusi Sparepart Anda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@700;800&display=swap" rel="stylesheet">

    <!-- Styles (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-bg {
            background-image: url("{{ asset('img/SINAR-JAYA.png') }}");
        }
        .font-sora { font-family: 'Sora', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 font-inter text-gray-800 dark:text-gray-200">
    <div class="relative min-h-screen">
        
        <!-- ================== HEADER NAVIGASI ================== -->
        <header class="w-full px-4 sm:px-6 lg:px-8 py-4 bg-transparent fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo / Nama Toko -->
        <a href="/" class="text-xl font-bold text-white drop-shadow-md font-sora tracking-tight">
            Toko Sinar Jaya
        </a>

        <!-- Navigasi Kanan (Login/Register atau Menu User) -->
        <nav class="flex items-center space-x-2 sm:space-x-4">
            @if (Route::has('login'))
                @auth
                    <!-- Menu Dropdown untuk User yang Sudah Login -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center space-x-2 text-white/90 hover:text-white transition-colors">
                            <!-- Ikon User -->
                            <svg class="w-8 h-8 p-1 bg-white/20 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <!-- Nama User -->
                            <span class="hidden sm:inline font-medium">{{ Auth::user()->name }}</span>
                            <!-- Ikon Panah Dropdown -->
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>

                        <!-- Konten Dropdown -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg py-1 z-50"
                             style="display: none;">
                            
                            {{-- Cek jika user adalah admin, beri link ke Panel Admin --}}
                            @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Panel Admin</a>
                            @endif
                            
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Profile</a>
                            
                            <!-- Tombol Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Tombol untuk Pengguna yang Belum Login -->
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-white/80 hover:text-white transition-colors">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-white text-blue-600 text-sm font-semibold rounded-lg shadow-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                           Register
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
    </div>
</header>

        <!-- ================== HERO SECTION & FOOTER WRAPPER ================== -->
        <main class="absolute inset-0">
            <div class="relative h-full w-full bg-cover bg-center bg-fixed hero-bg">
                <!-- Overlay Gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                
                <!-- Konten Tengah -->
                <div class="relative z-10 flex flex-col justify-center items-center h-full text-center text-white p-6">
                    <h1 class="text-5xl sm:text-6xl md:text-8xl font-extrabold leading-tight mb-4 drop-shadow-xl font-sora animate-fade-in-down" style="letter-spacing: -0.025em;">
                        Cari Sparepart Terbaik Ada di Sini!
                    </h1>
                    <p class="text-lg md:text-xl max-w-3xl mb-10 drop-shadow-lg text-gray-200 animate-fade-in-up" style="animation-delay: 0.3s;">
                        Solusi lengkap untuk semua kebutuhan sparepart motor Anda, dari original hingga aftermarket berkualitas dengan pelayanan terbaik.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                        <a href="#" class="w-full sm:w-auto px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-bold uppercase tracking-wider transition duration-300 ease-in-out transform hover:scale-105 shadow-xl">
                            Lihat Semua Produk
                        </a>
                        <a href="https://maps.app.goo.gl/uGipCs5smCDVmsBT7" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-10 py-4 bg-white/20 backdrop-blur-sm border border-white/30 hover:bg-white/30 text-white rounded-full font-bold uppercase tracking-wider transition duration-300 ease-in-out transform hover:scale-105">
                            Lihat Lokasi
                        </a>
                    </div>
                </div>

                <!-- ================== FOOTER TRANSPARAN DENGAN IKON GAMBAR ================== -->
                <footer class="absolute bottom-0 left-0 right-0 w-full py-6 z-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 text-white">
                        <p class="text-sm opacity-70">© {{ date('Y') }} Toko Sparepart Sinar Jaya</p>
                        <div class="flex space-x-5">
                            <!-- Ganti # dengan link sosial media Anda -->
                            <a href="#" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity duration-300 transform hover:scale-110" aria-label="Instagram">
                                <img src="{{ asset('img/Instagram.png') }}" alt="Instagram" class="w-6 h-6">
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity duration-300 transform hover:scale-110" aria-label="Facebook">
                                <img src="{{ asset('img/Facebook.png') }}" alt="Facebook" class="w-6 h-6">
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity duration-300 transform hover:scale-110" aria-label="WhatsApp">
                                <img src="{{ asset('img/WhatsApp.png') }}" alt="WhatsApp" class="w-6 h-6">
                            </a>
                        </div>
                    </div>
                </footer>
                <!-- ========================================================================= -->
            </div>
        </main>
    </div>

    <script>
        // Script untuk mengubah background header saat scroll
        const navbar = document.getElementById('navbar');
        window.onscroll = function() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                navbar.classList.add('bg-white/90', 'dark:bg-gray-800/90', 'shadow-md');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-white/90', 'dark:bg-gray-800/90', 'shadow-md');
                navbar.classList.add('bg-transparent');
            }
        };
    </script>
</body>
</html>