<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Sparepart Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Tampilkan error validasi -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="list-disc ms-4">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif {{-- Ini adalah penutup yang hilang --}}

                    <!-- PENTING: enctype untuk upload file -->
                    <form method="POST" action="{{ route('admin.spareparts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Barang -->
                        <div class="mb-4">
                            <label for="nama_barang" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nama Barang:</label>
                            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label for="harga" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Harga:</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Stok -->
                        <div class="mb-4">
                            <label for="stok" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Stok:</label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Deskripsi:</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="gambar" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Gambar:</label>
                            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>