<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Tambah Produk Baru
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.spareparts.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
            </div>
            <div>
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                <input type="number" name="harga" id="harga" value="{{ old('harga') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
            </div>
            <div>
                <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                <input type="number" name="stok" id="stok" value="{{ old('stok') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600" required>
            </div>
        </div>
        
        <div>
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Gambar Produk</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600" id="gambar" type="file" name="gambar">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Tipe file: PNG, JPG, GIF (MAX. 2MB).</p>
        </div>
        
        @if ($errors->any())
            <div class="text-sm text-red-600 dark:text-red-400">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.spareparts.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">Batal</a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">Simpan</button>
        </div>
    </form>
</x-admin-layout>