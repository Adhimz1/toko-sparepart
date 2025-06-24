<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk Kami - Sinar Jaya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-sora { font-family: 'Sora', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .nav-item-animated-underline { position: relative; padding-bottom: 6px; }
        .nav-item-animated-underline::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background-color: #3b82f6; transition: width 0.3s ease-in-out; }
        .nav-item-animated-underline.active-underline::after, .nav-item-animated-underline:hover::after { width: 100%; }
        .pagination { display: flex; justify-content: center; align-items: center; gap: 0.5rem; }
        .pagination a, .pagination span { display: flex; align-items: center; justify-content: center; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; font-size: 0.875rem; transition: all 0.2s ease-in-out; }
        .pagination a { color: #4b5563; background-color: #fff; border: 1px solid #d1d5db; }
        .pagination a:hover { background-color: #f3f4f6; border-color: #9ca3af; }
        .pagination .active span { color: #fff; background-color: #2563eb; border: 1px solid #2563eb; }
        .pagination .disabled span { color: #9ca3af; background-color: #f3f4f6; cursor: not-allowed; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-inter has-light-background">
    <div class="min-h-screen flex flex-col">

        <x-main-navbar />

        <main class="flex-grow pt-24">
            <div class="bg-white">
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <nav class="text-sm font-medium text-gray-500 mb-4" aria-label="Breadcrumb">
                        <ol class="list-none p-0 inline-flex">
                            <li class="flex items-center">
                                <a href="/" class="hover:text-blue-600">Beranda</a>
                                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                            </li>
                            <li><span class="text-gray-700">Produk</span></li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-extrabold font-sora text-gray-900 tracking-tight">Jelajahi Produk Kami</h1>
                    <p class="mt-2 text-lg text-gray-600">Temukan semua suku cadang yang Anda butuhkan untuk motor Anda.</p>
                </div>
            </div>

            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <aside class="lg:col-span-1">
                        <div class="sticky top-28 space-y-8">
                            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                                <h3 class="text-lg font-sora font-bold text-gray-900 mb-4">Cari Produk</h3>
                                <form method="GET" action="{{ route('products.index') }}">
                                    <div class="relative"><input type="search" name="search" value="{{ request('search') }}" class="w-full pl-4 pr-10 py-2.5 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Nama sparepart..."><button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-blue-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button></div>
                                </form>
                            </div>
                            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                                <h3 class="text-lg font-sora font-bold text-gray-900 mb-4">Kategori</h3>
                                <div class="space-y-3">
                                    <label class="flex items-center"><input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><span class="ml-3 text-sm text-gray-600">Mesin</span></label>
                                    <label class="flex items-center"><input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><span class="ml-3 text-sm text-gray-600">Kelistrikan & Aki</span></label>
                                    <label class="flex items-center"><input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><span class="ml-3 text-sm text-gray-600">Ban & Velg</span></label>
                                    <label class="flex items-center"><input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"><span class="ml-3 text-sm text-gray-600">Body & Rangka</span></label>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <div class="lg:col-span-3">
                        @if ($spareparts->isEmpty())
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 text-center py-20">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                                <h3 class="mt-2 text-xl font-sora font-bold text-gray-900">Produk Tidak Ditemukan</h3>
                                <p class="mt-1 text-base text-gray-500">Coba gunakan kata kunci lain atau hapus filter.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @foreach ($spareparts as $sparepart)
                                    {{-- PERUBAHAN 1: Tambahkan 'flex flex-col' pada kartu utama --}}
                                    <div class="group relative bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col">
                                        <div class="aspect-w-1 aspect-h-1 bg-gray-100">
                                            @if($sparepart->gambar)
                                            <img src="{{ asset('img/' . $sparepart->gambar) }}" alt="{{ $sparepart->nama_barang }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                            @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            @endif
                                        </div>
                                        {{-- PERUBAHAN 2: Tambahkan 'flex flex-col flex-grow' pada area konten --}}
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h3 class="text-base font-bold font-sora text-gray-800 truncate group-hover:text-blue-600 transition-colors"><a href="#">{{ $sparepart->nama_barang }}</a></h3>
                                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $sparepart->deskripsi }}</p>
                                            <div class="mt-4 flex justify-between items-center">
                                                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</p>
                                                <span class="text-xs font-medium px-2 py-1 rounded-full {{ $sparepart->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">Stok: {{ $sparepart->stok }}</span>
                                            </div>
                                            {{-- PERUBAHAN 3: Tambahkan 'mt-auto' pada wadah tombol --}}
                                            <div class="mt-4 mt-auto">
                                                <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-50 border-2 border-blue-200 text-blue-700 text-sm font-semibold rounded-lg transition-all duration-300 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                                                    Tambah Keranjang
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-12">{{ $spareparts->links('pagination::tailwind') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
        
        <footer id="contact-us" class="bg-gray-900 text-white mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 xl:gap-12"><div class="space-y-4 md:col-span-2 lg:col-span-1"><a href="/" class="text-2xl font-bold font-sora tracking-tight text-white">Sinar Jaya</a><p class="text-gray-400 text-sm leading-relaxed">Spesialis suku cadang motor berkualitas dengan layanan terbaik sejak 2010. Solusi terpercaya untuk semua kebutuhan motor Anda.</p></div><div class="space-y-4"><h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Navigasi</h3><ul class="space-y-3"><li><a href="/" class="text-gray-300 hover:text-white transition-colors duration-200">Beranda</a></li><li><a href="/#about-us" class="text-gray-300 hover:text-white transition-colors duration-200">Tentang Kami</a></li><li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Produk</a></li><li><a href="/#contact-us" class="text-gray-300 hover:text-white transition-colors duration-200">Hubungi Kami</a></li></ul></div><div class="space-y-4"><h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Kontak Kami</h3><address class="not-italic space-y-3 text-gray-300 text-sm"><p>Jl. Jend. Sudirman No.29, Kuningan, Jawa Barat 45511</p><p><a href="tel:089630152631" class="hover:text-white transition-colors">0896-3015-2631</a></p><p><a href="mailto:sinarjaya@gmail.com" class="hover:text-white transition-colors">sinarjaya@gmail.com</a></p></address></div><div class="space-y-4"><h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Ikuti Kami</h3><div class="flex items-center space-x-4"><a href="#" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full hover:bg-blue-600 transition-all duration-200 transform hover:scale-110" aria-label="Instagram"><img src="{{ asset('img/Instagram.png') }}" alt="Instagram" class="w-5 h-5" /></a><a href="#" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full hover:bg-blue-600 transition-all duration-200 transform hover:scale-110" aria-label="Facebook"><img src="{{ asset('img/Facebook.png') }}" alt="Facebook" class="w-5 h-5" /></a><a href="#" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full hover:bg-blue-600 transition-all duration-200 transform hover:scale-110" aria-label="WhatsApp"><img src="{{ asset('img/WhatsApp.png') }}" alt="WhatsApp" class="w-5 h-5" /></a></div></div></div>
                <div class="mt-12 pt-8 border-t border-gray-800 text-center"><p class="text-sm text-gray-500">© {{ date('Y') }} Sinar Jaya. All rights reserved.</p></div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('navbar');
            const isLightPage = document.body.classList.contains('has-light-background');

            const setNavbarAppearance = (isLight) => {
                const navbarLogo = document.getElementById('navbar-logo');
                const navLinks = navbar.querySelectorAll('.nav-item-animated-underline');
                const authSection = document.getElementById('auth-cart-section');
                
                navbar.classList.toggle('bg-white/95', isLight);
                navbar.classList.toggle('backdrop-blur-sm', isLight);
                navbar.classList.toggle('shadow-lg', isLight);
                navbar.classList.toggle('bg-transparent', !isLight);
                navbarLogo.classList.toggle('text-white', !isLight);
                navbarLogo.classList.toggle('text-gray-900', isLight);
                navLinks.forEach(link => { link.classList.toggle('text-white', !isLight); link.classList.toggle('text-gray-700', isLight); });
                if (authSection) {
                    const registerBtn = authSection.querySelector('#register-button');
                    const userBtn = authSection.querySelector('#user-name-button');
                    const cartLink = authSection.querySelector('.cart-icon-link');
                    if (cartLink) { cartLink.classList.toggle('text-white', !isLight); cartLink.classList.toggle('text-gray-700', isLight); }
                    if (registerBtn) { registerBtn.classList.toggle('border-white', !isLight); registerBtn.classList.toggle('text-white', !isLight); registerBtn.classList.toggle('border-gray-300', isLight); registerBtn.classList.toggle('text-blue-600', isLight); }
                    if (userBtn) { userBtn.classList.toggle('bg-white/10', !isLight); userBtn.classList.toggle('text-white', !isLight); userBtn.classList.toggle('bg-gray-100', isLight); userBtn.classList.toggle('text-gray-800', isLight); }
                }
            };
            const updateNavbar = () => { setNavbarAppearance(isLightPage || window.scrollY > 50); };
            const setActiveUnderline = () => {
                const productLink = document.querySelector('a[href="{{ route('products.index') }}"]');
                if (productLink && window.location.pathname.startsWith('/products')) { productLink.classList.add('active-underline'); }
            };
            updateNavbar();
            setActiveUnderline();
            window.addEventListener('scroll', updateNavbar);
        });
    </script>
</body>
</html>