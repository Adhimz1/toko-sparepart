<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Produk: {{ $sparepart->nama_barang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-500 text-white p-4 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.spareparts.update', $sparepart->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- PENTING untuk form edit --}}

                        <!-- Nama Produk -->
                        <div>
                            <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $sparepart->nama_barang) }}" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                   placeholder="Contoh: Velg Racing" required>
                        </div>

                        <!-- Grid untuk Harga dan Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Harga -->
                            <div>
                                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                <input type="number" name="harga" id="harga" value="{{ old('harga', $sparepart->harga) }}" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                       placeholder="100000" required>
                            </div>
                            <!-- Stok -->
                            <div>
                                <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok', $sparepart->stok) }}" 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                       placeholder="10" required>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" 
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                      placeholder="Tulis deskripsi produk di sini...">{{ old('deskripsi', $sparepart->deskripsi) }}</textarea>
                        </div>

                        <!-- Gambar Produk -->
                        <div>
                            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ganti Gambar Produk (Opsional)</label>
                            
                            <!-- Preview Gambar Lama -->
                            @if ($sparepart->gambar)
                                <div class="my-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Gambar Saat Ini:</p>
                                    <img src="{{ asset('img/' . $sparepart->gambar) }}" alt="Gambar {{ $sparepart->nama_barang }}" class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif

                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                   id="gambar" name="gambar" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Kosongkan jika tidak ingin mengganti gambar. (MAX. 2MB)</p>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.spareparts.index') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Batal
                            </a>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>