<footer id="contact-us" class="bg-gray-900 text-white mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
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