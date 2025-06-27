<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Data Pesanan (Order)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Menampilkan pesan sukses setelah update atau delete --}}
                    @if (session('success'))
                        <div class="mb-4 bg-green-500 text-white p-4 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ID Order</th>
                                    <th scope="col" class="px-6 py-3">Nama Pelanggan</th>
                                    <th scope="col" class="px-6 py-3">Alamat Pengiriman</th>
                                    <th scope="col" class="px-6 py-3">Total Harga</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            #{{ $order->id }}
                                        </th>
                                        <td class="px-6 py-4">{{ $order->customer_name }}</td>
                                        <td class="px-6 py-4 text-xs">{{ $order->shipping_address }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($order->status == 'processing') bg-blue-100 text-blue-800 @endif
                                                @if($order->status == 'completed') bg-green-100 text-green-800 @endif
                                                @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            {{-- BLOK AKSI YANG BARU --}}
                                            <div class="flex justify-end items-center space-x-2">
                                                {{-- Tombol Detail --}}
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 font-medium">Detail</a>
                                                
                                                <span class="text-gray-300 dark:text-gray-600">|</span>
                                                
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 font-medium">Edit</a>
                                                
                                                <span class="text-gray-300 dark:text-gray-600">|</span>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini secara permanen?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 font-medium">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="6" class="px-6 py-4 text-center">
                                            Belum ada data pesanan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     {{-- Link Paginasi --}}
                     <div class="mt-6">
                        {{ $orders->links() }}
                     </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>