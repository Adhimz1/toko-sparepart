<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    
                    {{-- Detail Pelanggan & Pengiriman --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-bold border-b pb-2 mb-2">Detail Pelanggan</h3>
                            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Telepon:</strong> {{ $order->phone }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold border-b pb-2 mb-2">Alamat Pengiriman</h3>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    {{-- Detail Pesanan --}}
                    <div>
                        <h3 class="font-bold border-b pb-2 mb-2">Ringkasan Pesanan</h3>
                        <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p><strong>Status:</strong> <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
                        <p><strong>Total Pembayaran:</strong> <span class="font-bold text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                    </div>

                    {{-- Rincian Item --}}
                    <div>
                        <h3 class="font-bold border-b pb-2 mb-2">Item yang Dipesan</h3>
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="p-2">Produk</th>
                                    <th class="p-2 text-center">Jumlah</th>
                                    <th class="p-2 text-right">Harga</th>
                                    <th class="p-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="p-2">{{ $item->sparepart->nama_barang }}</td>
                                    <td class="p-2 text-center">{{ $item->quantity }}</td>
                                    <td class="p-2 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="p-2 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300">Kembali</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>