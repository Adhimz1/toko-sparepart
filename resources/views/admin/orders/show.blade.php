<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-500 text-white p-4 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Kolom Kiri: Detail Item dan Pelanggan --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Detail Item --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200 mb-4">Item yang Dipesan</h3>
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-700 dark:text-gray-400 uppercase bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">Produk</th>
                                    <th class="px-4 py-2 text-center">Jumlah</th>
                                    <th class="px-4 py-2 text-right">Harga</th>
                                    <th class="px-4 py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900 dark:text-gray-200">
                                @foreach($order->items as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 flex items-center space-x-3">
                                        <img src="{{ asset('img/' . $item->sparepart->gambar) }}" alt="{{ $item->sparepart->nama_barang }}" class="w-12 h-12 object-cover rounded">
                                        <span>{{ $item->sparepart->nama_barang }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Detail Pelanggan & Pengiriman --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200 mb-4">Detail Pelanggan & Pengiriman</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-gray-200">
                            <div><strong>Nama:</strong> {{ $order->customer_name }}</div>
                            <div><strong>Telepon:</strong> {{ $order->phone }}</div>
                            <div class="md:col-span-2"><strong>Alamat:</strong> {{ $order->shipping_address }}</div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Update Status & Ringkasan --}}
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200 mb-4">Update Status</h3>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Pesanan</label>
                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                    <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
                                    <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
                                    <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-200">
                         <h3 class="text-lg font-bold mb-4">Ringkasan Total</h3>
                         <div class="flex justify-between"><span>Total Harga:</span> <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></div>
                         <div class="flex justify-between"><span>Metode Bayar:</span> <strong>{{ $order->payment_method }}</strong></div>
                         <div class="flex justify-between"><span>Status Bayar:</span> <strong>{{ ucfirst($order->payment_status) }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>