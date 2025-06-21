<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- ================== KARTU PENYAMBUT PENGGUNA ================== -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 flex items-center space-x-6">
                    <!-- Ikon User -->
                    <div class="shrink-0">
                        <svg class="h-16 w-16 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <!-- Teks Sapaan -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h3>
                        <p class="mt-1 text-gray-600 dark:text-gray-400">
                            Senang melihat Anda kembali. Siap untuk mencari sparepart terbaik?
                        </p>
                    </div>
                </div>
            </div>
            <!-- ============================================================= -->


            <!-- ================== BAGIAN AKSI SELANJUTNYA ================== -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tombol Lihat Produk -->
                <a href="#" class="block p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="shrink-0 p-3 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.823a.75.75 0 00-.674-.928H5.61a.75.75 0 00-.674.928L4.882 12M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg text-gray-900 dark:text-white">Lihat Semua Produk</h4>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Jelajahi katalog lengkap kami.</p>
                        </div>
                    </div>
                </a>

                <!-- Tombol Riwayat Pesanan -->
                <a href="#" class="block p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="shrink-0 p-3 bg-green-100 dark:bg-green-900/50 rounded-lg">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.25 2.25 0 015.25 6H6.75a.75.75 0 01.75.75v3.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V6.75a.75.75 0 01.75-.75H17.25a2.25 2.25 0 012.25 2.25v12.75A2.25 2.25 0 0117.25 21H6.75a2.25 2.25 0 01-2.25-2.25V6.75a2.25 2.25 0 012.25-2.25h.612m-5.801 0A2.25 2.25 0 015.25 6H6.75a.75.75 0 01.75.75v3.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V6.75a.75.75 0 01.75-.75H17.25a2.25 2.25 0 012.25 2.25v12.75A2.25 2.25 0 0117.25 21H6.75a2.25 2.25 0 01-2.25-2.25V6.75a2.25 2.25 0 012.25-2.25h.612" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg text-gray-900 dark:text-white">Riwayat Pesanan</h4>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Lacak dan lihat pesanan Anda.</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ============================================================= -->

        </div>
    </div>
</x-app-layout>