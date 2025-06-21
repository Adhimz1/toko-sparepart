<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Kelola Produk Sparepart
            </h2>
            <a href="{{ route('admin.spareparts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Produk Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="mb-4 bg-green-500 text-white p-4 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Fitur Pencarian -->
                    <form method="GET" action="{{ route('admin.spareparts.index') }}" class="mb-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="search" id="search-input" value="{{ request('search') }}" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari berdasarkan nama atau deskripsi...">
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                        </div>
                    </form>


                    <!-- Tabel Data -->
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">#</th>
                                    <th scope="col" class="px-6 py-3">Gambar</th>
                                    <th scope="col" class="px-6 py-3">Nama Produk</th>
                                    <th scope="col" class="px-6 py-3">Harga</th>
                                    <th scope="col" class="px-6 py-3">Stok</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($spareparts as $sparepart)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">
                                            @if($sparepart->gambar)
                                                <img src="{{ asset('img/' . $sparepart->gambar) }}" alt="{{ $sparepart->nama_barang }}" class="w-16 h-16 object-cover rounded-md">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center text-xs">No Img</div>
                                            @endif
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $sparepart->nama_barang }}
                                        </th>
                                        <td class="px-6 py-4">Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $sparepart->stok }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.spareparts.edit', $sparepart->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                <form action="{{ route('admin.spareparts.destroy', $sparepart->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="6" class="px-6 py-4 text-center">Tidak ada data produk ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $spareparts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>