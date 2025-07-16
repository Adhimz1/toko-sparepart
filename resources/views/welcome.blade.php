<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Jaya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-bg {
            background-image: url("{{ asset('img/bg-Temukan.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .font-sora { font-family: 'Sora', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* Animasi kustom untuk Hero Section (page load) */
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-25px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fade-in-down 1s ease-out forwards; }

        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(25px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 1s ease-out forwards; }

        /* AOS-like setup (untuk elemen yang muncul saat scroll) */
        [data-aos] {
            opacity: 0;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        [data-aos="fade-up"] { transform: translateY(25px); }
        [data-aos="fade-down"] { transform: translateY(-25px); }
        [data-aos="fade-left"] { transform: translateX(25px); }
        [data-aos="fade-right"] { transform: translateX(-25px); }

        [data-aos="scale-x"] {
            transform: scaleX(0);
            opacity: 0;
        }

        [data-aos].aos-animate {
            opacity: 1;
            transform: translate(0, 0);
        }
        [data-aos="scale-x"].aos-animate {
            transform: scaleX(1);
            opacity: 1;
        }

        /* CSS untuk Garis Bawah Navigasi yang Beranimasi */
        .nav-item-animated-underline {
            position: relative;
            display: inline-block;
            padding-bottom: 4px;
            transition: color 0.3s ease-out;
        }

        .nav-item-animated-underline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background: #0004FF;
            border-radius: 9999px;
            transition: width 0.3s ease-out;
        }
        
        .nav-item-animated-underline.active-underline::after {
            width: 100%;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    <div class="relative min-h-screen flex flex-col">
        
        <header class="w-full px-4 sm:px-6 lg:px-8 py-4 bg-transparent fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
            <div class="max-w-7xl mx-auto flex justify-between items-center h-16">
                <a href="/" class="text-2xl font-extrabold text-white drop-shadow-md font-sora tracking-tight" id="navbar-logo">
                    Sinar Jaya
                </a>

                <nav class="flex items-center space-x-6">
                    <ul class="flex space-x-6">
                        <li><a href="/" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="hero-section">Beranda</a></li>
                        <li><a href="#about-us" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="about-us">Tentang Kami</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="products-page-link">Produk</a></li>
                        <li><a href="#contact-us" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="contact-us">Hubungi Kami</a></li>
                    </ul>
                    
                    <div class="ml-auto flex items-center gap-3" id="auth-cart-section">
                        @guest
                            <a href="{{ route('login') }}" class="px-5 py-2 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 shadow-lg transition-all duration-200 flex items-center gap-2" id="login-button">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10v1" /></svg>
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 rounded-full text-sm font-semibold border border-white text-white hover:bg-white hover:text-blue-600 transition-all duration-200 flex items-center gap-2" id="register-button">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v6m3-3h-6m-6 8a4 4 0 100-8 4 4 0 000 8zm0-8V9a4 4 0 018 0v1" /></svg>
                                    Register
                                </a>
                            @endif
                        @endguest

                        @auth
                            {{-- PERUBAHAN: Ikon Keranjang Belanja dipindah ke sini (posisi pertama) --}}
                            <a href="#" class="text-white hover:text-blue-200 transition-colors cart-icon-link" aria-label="Keranjang Belanja">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5.4M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </a>
                            
                            {{-- PERUBAHAN: Dropdown Profil Pengguna sekarang di posisi kedua --}}
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false" @mouseover="open = true" @mouseleave="open = false">
                                <button class="flex items-center gap-2 px-3 py-2 rounded-full bg-white/90 text-blue-700 font-semibold shadow hover:bg-blue-50 transition-colors duration-200" id="user-name-button">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ Str::limit(Auth::user()->name, 10) }}
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200" style="display: none;">
                                    <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-100">
                                        <div class="font-medium">Hi, {{ Auth::user()->name }}</div>
                                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                    </div>
                                    <a href="{{ route('dashboard') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                        Dashboard
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Profile
                                    </a>
                                    @if(Auth::user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            Admin Panel
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-2 border-t border-gray-100 mt-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1h7a1 1 0 011 1v1"/></svg>
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>

        {{-- Sisa kode tidak ada perubahan --}}
        <div class="relative h-screen w-full flex items-center justify-center pt-16 hero-bg" id="hero-section">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
            <div class="relative z-10 flex flex-col items-center justify-center text-center text-white px-6">
                <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold leading-tight mb-4 drop-shadow-xl font-sora animate-fade-in-down" style="letter-spacing: -0.025em;">
                    Temukan Sparepart Motor <br class="hidden sm:inline">Berkualitas & Terpercaya
                </h1>
                <p class="text-sm md:text-base lg:text-lg max-w-3xl mb-8 drop-shadow-lg text-gray-200 animate-fade-in-up" style="animation-delay: 0.3s;">
                    Suku Cadang Asli | Harga Terbaik | Pengiriman Cepat
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                    <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-10 py-4 bg-transparent backdrop-blur-sm border border-white text-white rounded-full font-bold uppercase tracking-wider transition duration-300 ease-in-out transform hover:scale-105 shadow-xl">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>

        <main class="relative z-30 bg-white pb-16">
            <section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        
        {{-- PERUBAHAN: Desain Judul Baru --}}
        <div class="mb-12">
            <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full mb-3"
                  data-aos="fade-up" data-aos-delay="100">
                Kualitas Terjamin
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-poppins text-gray-900 tracking-tight"
                data-aos="fade-up" data-aos-delay="200">
                Top Brand Kami
            </h2>
            <p class="mt-4 text-gray-600 text-base sm:text-lg max-w-2xl mx-auto"
               data-aos="fade-up" data-aos-delay="300">
                Kami bermitra dengan brand-brand ternama untuk memastikan kualitas dan keaslian setiap produk yang kami jual.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-10 gap-y-10 place-items-center">
            <div class="group bg-gray-100 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400"><img src="{{ asset('img/yamaha.png') }}" alt="Yamaha" class="max-h-16 max-w-[9rem] object-contain mx-auto grayscale group-hover:grayscale-0 transition duration-300" /><div class="mt-3 text-sm font-semibold text-gray-800 tracking-wide">Yamaha</div></div>
            <div class="group bg-gray-100 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="500"><img src="{{ asset('img/honda.png') }}" alt="Honda" class="max-h-16 max-w-[9rem] object-contain mx-auto grayscale group-hover:grayscale-0 transition duration-300" /><div class="mt-3 text-sm font-semibold text-gray-800 tracking-wide">Honda</div></div>
            <div class="group bg-gray-100 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="600"><img src="{{ asset('img/RCB-fixed.png') }}" alt="RCB" class="max-h-16 max-w-[9rem] object-contain mx-auto grayscale group-hover:grayscale-0 transition duration-300" /><div class="mt-3 text-sm font-semibold text-gray-800 tracking-wide">RCB</div></div>
            <div class="group bg-gray-100 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="700"><img src="{{ asset('img/ktm.png') }}" alt="KTM" class="max-h-16 max-w-[9rem] object-contain mx-auto grayscale group-hover:grayscale-0 transition duration-300" /><div class="mt-3 text-sm font-semibold text-gray-800 tracking-wide">KTM</div></div>
        </div>
    </div>
</section>

            <section id="about-us" class="relative bg-cover bg-center bg-no-repeat py-16" style="background-image: url('{{ asset('img/bg-ttg-kami.png') }}');">
                <div class="absolute inset-0 bg-black bg-opacity-60"></div>
                <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 sm:py-24 lg:px-8" data-aos="fade-right">
                    <div class="max-w-2xl">
                        <p class="text-sm text-white mb-2">Sekilas SinarJaya</p>
                        <h2 class="text-3xl sm:text-4xl font-extrabold font-poppins text-white mb-6">
                            Tentang Kami
                        </h2>
                        <p class="text-white text-base sm:text-lg leading-relaxed mb-6">
                            Sinar Jaya Sparepart Motor adalah toko yang menyediakan berbagai jenis suku cadang motor berkualitas, baik original maupun aftermarket, untuk berbagai merek motor seperti Honda, Yamaha, Suzuki, dan lainnya. Kami berkomitmen memberikan produk terbaik dengan harga terjangkau dan pelayanan yang ramah.
                        </p>
                        <a href="#" class="inline-flex items-center px-6 py-3 border border-white text-white text-sm font-semibold rounded-lg hover:bg-white hover:text-gray-900 transition">
                            Selengkapnya
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </section>

            <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        
        {{-- PERUBAHAN: Desain Judul Baru --}}
        <div class="text-center mb-12">
            <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full mb-3"
                  data-aos="fade-up" data-aos-delay="100">
                Keunggulan Kami
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-poppins text-gray-800 tracking-tight"
                data-aos="fade-up" data-aos-delay="200">
                Kenapa Memilih Kami?
            </h2>
            <p class="mt-4 text-gray-600 text-base sm:text-lg max-w-2xl mx-auto"
               data-aos="fade-up" data-aos-delay="300">
                Kami berkomitmen memberikan pengalaman terbaik, dari produk berkualitas hingga pelayanan yang responsif.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mx-auto max-w-5xl">
            <div class="flex flex-col items-center text-center bg-white p-6 rounded-lg shadow transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400"><div class="shrink-0 p-3 rounded-full bg-blue-100 mb-4"><img src="{{ asset('img/Check Mark.png') }}" alt="Check Mark" class="w-8 h-8"></div><h3 class="text-xl font-semibold text-gray-900 mb-2">Produk Beragam & Berkualitas</h3><p class="text-gray-600 text-sm">Temukan berbagai sparepart motor berkualitas tinggi untuk segala kebutuhan.</p></div>
            <div class="flex flex-col items-center text-center bg-white p-6 rounded-lg shadow transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="500"><div class="shrink-0 p-3 rounded-full bg-blue-100 mb-4"><img src="{{ asset('img/Check Mark.png') }}" alt="Check Mark" class="w-8 h-8"></div><h3 class="text-xl font-semibold text-gray-900 mb-2">Pelayanan Cepat & Ramah</h3><p class="text-gray-600 text-sm">Tim kami siap membantu Anda dengan respons cepat dan ramah.</p></div>
            <div class="flex flex-col items-center text-center bg-white p-6 rounded-lg shadow transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="600"><div class="shrink-0 p-3 rounded-full bg-blue-100 mb-4"><img src="{{ asset('img/Check Mark.png') }}" alt="Check Mark" class="w-8 h-8"></div><h3 class="text-xl font-semibold text-gray-900 mb-2">Harga Bersaing</h3><p class="text-gray-600 text-sm">Dapatkan sparepart terbaik dengan harga yang kompetitif.</p></div>
        </div>
    </div>
</section>
        </main>

              
<footer id="contact-us" class="bg-gray-900 text-white mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        {{-- Grid Utama Footer --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 xl:gap-12">
            
            {{-- Kolom 1: Tentang Sinar Jaya --}}
            <div class="space-y-4 md:col-span-2 lg:col-span-1">
                <a href="/" class="text-2xl font-bold font-sora tracking-tight text-white">Sinar Jaya</a>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Spesialis suku cadang motor berkualitas dengan layanan terbaik sejak 2010. Solusi terpercaya untuk semua kebutuhan motor Anda.
                </p>
            </div>

            {{-- Kolom 2: Navigasi Cepat --}}
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Navigasi</h3>
                <ul class="space-y-3">
                    <li><a href="/" class="text-gray-300 hover:text-white transition-colors duration-200">Beranda</a></li>
                    <li><a href="#about-us" class="text-gray-300 hover:text-white transition-colors duration-200">Tentang Kami</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Produk</a></li>
                    <li><a href="#contact-us" class="text-gray-300 hover:text-white transition-colors duration-200">Hubungi Kami</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Kontak Kami --}}
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Kontak Kami</h3>
                <address class="not-italic space-y-3 text-gray-300 text-sm">
                    <p>Jl. Jend. Sudirman No.29, Kuningan, Jawa Barat 45511</p>
                    <p><a href="tel:089630152631" class="hover:text-white transition-colors">0896-3015-2631</a></p>
                    <p><a href="mailto:sinarjaya@gmail.com" class="hover:text-white transition-colors">sinarjaya@gmail.com</a></p>
                </address>
            </div>

            {{-- Kolom 4: Ikuti Kami --}}
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Ikuti Kami</h3>
                <div class="flex items-center space-x-4">
                    <a href="#" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full hover:bg-blue-600 transition-all duration-200 transform hover:scale-110" aria-label="Instagram">
                        <img src="{{ asset('img/Instagram.png') }}" alt="Instagram" class="w-5 h-5" />
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full hover:bg-blue-600 transition-all duration-200 transform hover:scale-110" aria-label="Facebook">
                        <img src="{{ asset('img/Facebook.png') }}" alt="Facebook" class="w-5 h-5" />
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full hover:bg-blue-600 transition-all duration-200 transform hover:scale-110" aria-label="WhatsApp">
                        <img src="{{ asset('img/WhatsApp.png') }}" alt="WhatsApp" class="w-5 h-5" />
                    </a>
                </div>
            </div>

        </div>

        {{-- Bagian Copyright --}}
        <div class="mt-12 pt-8 border-t border-gray-800 text-center">
            <p class="text-sm text-gray-500">© {{ date('Y') }} Sinar Jaya. All rights reserved.</p>
        </div>
    </div>
</footer>

    
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        // Script untuk mengubah background header saat scroll
        const navbar = document.getElementById('navbar');
        window.onscroll = function() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                navbar.classList.add('bg-white/90', 'backdrop-blur-sm', 'shadow-md');
                navbar.classList.remove('bg-transparent');
                
                const navbarLogo = document.getElementById('navbar-logo');
                if (navbarLogo) {
                    navbarLogo.classList.remove('text-white');
                    navbarLogo.classList.add('text-gray-800');
                }
                navbar.querySelectorAll('.nav-item-animated-underline').forEach(link => {
                    link.classList.remove('text-white');
                    link.classList.add('text-gray-800');
                });
                const registerButton = document.getElementById('register-button');
                if (registerButton) {
                    registerButton.classList.remove('border-white', 'text-white');
                    registerButton.classList.add('border-gray-300', 'text-blue-600');
                }
                const cartIconLink = document.querySelector('.cart-icon-link');
                if (cartIconLink) {
                    cartIconLink.classList.remove('text-white');
                    cartIconLink.classList.add('text-gray-800');
                }
            } else {
                navbar.classList.remove('bg-white/90', 'backdrop-blur-sm', 'shadow-md');
                navbar.classList.add('bg-transparent');
                const navbarLogo = document.getElementById('navbar-logo');
                if (navbarLogo) {
                    navbarLogo.classList.remove('text-gray-800');
                    navbarLogo.classList.add('text-white');
                }
                navbar.querySelectorAll('.nav-item-animated-underline').forEach(link => {
                    link.classList.remove('text-gray-800');
                    link.classList.add('text-white');
                });
                const registerButton = document.getElementById('register-button');
                if (registerButton) {
                    registerButton.classList.remove('border-gray-300', 'text-blue-600');
                    registerButton.classList.add('border-white', 'text-white');
                }
                const cartIconLink = document.querySelector('.cart-icon-link');
                if (cartIconLink) {
                    cartIconLink.classList.remove('text-gray-800');
                    cartIconLink.classList.add('text-white');
                }
            }
        };

        // Script untuk animasi saat elemen muncul di viewport (AOS-like)
        document.addEventListener('DOMContentLoaded', function() {
            const aosElements = document.querySelectorAll('[data-aos]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const animationType = entry.target.dataset.aos;
                        const animationDelay = entry.target.dataset.aosDelay ? parseInt(entry.target.dataset.aosDelay) : 0;
                        
                        if (animationType === 'scale-x') {
                            entry.target.style.transformOrigin = entry.target.dataset.aosOrigin || 'center';
                        }
                        setTimeout(() => {
                            entry.target.classList.add('aos-animate');
                            observer.unobserve(entry.target);
                        }, animationDelay);
                    }
                });
            }, {
                threshold: 0.1
            });
            aosElements.forEach(element => {
                observer.observe(element);
            });

            // Script untuk Garis Bawah Navbar Aktif (Scroll-Spy)
            const navbarHeight = navbar.offsetHeight;
            const navLinks = document.querySelectorAll('.nav-item-animated-underline');

            function setActiveUnderline() {
                let currentActiveSectionId = '';
                const scrollY = window.scrollY;
                document.querySelectorAll('section[id], #hero-section').forEach(section => {
                    const sectionTop = section.offsetTop - navbarHeight - 1;
                    const sectionBottom = sectionTop + section.offsetHeight;
                    if (scrollY >= sectionTop && scrollY < sectionBottom) {
                        currentActiveSectionId = section.id;
                    }
                });
                navLinks.forEach(link => {
                    link.classList.remove('active-underline');
                    const href = link.getAttribute('href');
                    if (link.dataset.targetSection === currentActiveSectionId) {
                        link.classList.add('active-underline');
                    } else if (href === "{{ route('products.index') }}" && window.location.pathname.startsWith('/products')) {
                        link.classList.add('active-underline');
                    }
                });
            }
            setActiveUnderline();
            window.addEventListener('scroll', setActiveUnderline);

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    if (window.location.pathname === '/' || window.location.pathname === '/home') {
                        e.preventDefault();
                        const targetId = this.getAttribute('href').substring(1);
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            const offsetTop = targetElement.offsetTop - navbar.offsetHeight;
                            window.scrollTo({
                                top: offsetTop,
                                behavior: 'smooth'
                            });
                            history.pushState(null, null, this.getAttribute('href'));
                        }
                    }
                });
            });
            window.addEventListener('hashchange', setActiveUnderline);
        });
    </script>
</body>
</html>