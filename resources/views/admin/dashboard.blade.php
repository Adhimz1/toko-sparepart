<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Pesan Selamat Datang yang Lebih Personal -->
            <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Berikut adalah ringkasan untuk Toko Sparepart Bah Hasan.
                    </p>
                </div>
            </div>

            <!-- Grid untuk kartu statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Kartu 1: Total Sparepart -->
                <a href="{{ route('admin.spareparts.index') }}" class="block p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Sparepart</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalSpareparts }}</p>
                        </div>
                    </div>
                </a>

                <!-- Kartu 2: Total User -->
                <a href="{{ route('admin.users.index') }}" class="block p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.995 5.995 0 0012 12a5.995 5.995 0 00-3-5.197M15 21a6 6 0 00-9-5.197"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total User</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </a>

                <!-- Kartu 3: Tambah Sparepart Baru -->
                <a href="{{ route('admin.spareparts.create') }}" class="block p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-500 bg-opacity-20">
                            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Aksi Cepat</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">Tambah Sparepart</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- ================== TAMBAHAN: TABEL SPAREPART TERBARU ================== -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Sparepart Baru Ditambahkan
                    </h3>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gambar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Barang</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stok</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($latestSpareparts as $sparepart)
                                    <tr>
                                        <td class="px-6 py-4">
                                            @if($sparepart->gambar)
                                                <img src="{{ asset('img/' . $sparepart->gambar) }}" alt="{{ $sparepart->nama_barang }}" class="w-12 h-12 object-cover rounded">
                                            @else
                                                <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                                    <span class="text-xs text-gray-500">No Img</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $sparepart->nama_barang }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            Rp {{ number_format($sparepart->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $sparepart->stok }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Belum ada data sparepart.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ======================================================================= -->
            
        </div>
    </div>
</x-admin-layout>