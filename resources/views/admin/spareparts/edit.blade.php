<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sparepart: ') . $sparepart->nama_barang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.spareparts.update', $sparepart->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- PENTING: Method spoofing untuk UPDATE -->

                        <!-- Nama Barang -->
                        <div class="mb-4">
                            <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang:</label>
                            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $sparepart->nama_barang) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
                            <input type="number" name="harga" id="harga" value="{{ old('harga', $sparepart->harga) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Stok -->
                        <div class="mb-4">
                            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok', $sparepart->stok) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi', $sparepart->deskripsi) }}</textarea>
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Ganti Gambar (Opsional):</label>
                            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @if($sparepart->gambar)
                                <div class="mt-2">
                                    <p>Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $sparepart->gambar) }}" alt="{{ $sparepart->nama_barang }}" class="w-32 h-32 object-cover">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<x-admin-layout>