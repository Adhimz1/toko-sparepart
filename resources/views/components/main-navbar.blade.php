<header class="w-full px-4 sm:px-6 lg:px-8 py-3 bg-transparent fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-screen-xl mx-auto flex justify-between items-center h-16">
        <a href="/" class="text-2xl font-extrabold text-white drop-shadow-md font-sora tracking-tight transition-colors duration-300" id="navbar-logo">
            Sinar Jaya
        </a>

        {{-- Navigasi untuk Desktop --}}
        <nav class="hidden md:flex items-center space-x-8">
            <ul class="flex items-center space-x-8">
                <li><a href="/" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="hero-section">Beranda</a></li>
                <li><a href="/#about-us" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="about-us">Tentang Kami</a></li>
                <li><a href="{{ route('products.index') }}" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="products-page-link">Produk</a></li>
                <li><a href="/#contact-us" class="text-white font-medium transition-colors nav-item-animated-underline" data-target-section="contact-us">Hubungi Kami</a></li>
            </ul>
        </nav>
        
        <div class="flex items-center gap-4" id="auth-cart-section">
            @guest
                <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center gap-2" id="login-button">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hidden sm:flex px-5 py-2.5 rounded-full text-sm font-semibold border border-white text-white hover:bg-white hover:text-blue-600 transition-all duration-300 items-center gap-2" id="register-button">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        Register
                    </a>
                @endif
            @endguest

            @auth
                {{-- PERBAIKAN 1: Link keranjang sekarang mengarah ke route('cart.index') --}}
                <a href="{{ route('cart.index') }}" class="relative text-white hover:text-blue-200 transition-colors cart-icon-link" aria-label="Keranjang Belanja">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5.4M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center border-2 border-white dark:border-gray-800">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Dropdown Profil Pengguna --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="flex items-center gap-2 px-2 py-1.5 lg:px-3 lg:py-2 rounded-full bg-white/10 backdrop-blur-sm text-white font-semibold shadow hover:bg-white/20 transition-colors duration-200" id="user-name-button">
                        {{-- PERBAIKAN 2: Avatar dinamis menggunakan ui-avatars.com --}}
                        <img class="w-8 h-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0284c7&color=fff&font-size=0.5&bold=true" alt="{{ Auth::user()->name }}">
                        <span class="hidden lg:inline">{{ Str::limit(Auth::user()->name, 10) }}</span>
                        <svg class="w-4 h-4 hidden lg:inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>

                    <div x-show="open" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5" style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-semibold text-gray-900">Hi, {{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('dashboard') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" ...></svg>
                                Dashboard
                            </a>
                            {{-- PERBAIKAN 3: Menambahkan link Riwayat Pesanan --}}
                            <a href="{{ route('user.orders.index') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                Riwayat Pesanan
                            </a>
                            <a href="{{ route('profile.edit') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" ...></svg>
                                Profil
                            </a>
                            @if(Auth::user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" ...></svg>
                                    Admin Panel
                                </a>
                            @endif
                        </div>
                        <div class="border-t border-gray-200 py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" ...></svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>