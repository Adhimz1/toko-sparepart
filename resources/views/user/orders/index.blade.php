<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pesanan - Sinar Jaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-sora { font-family: 'Sora', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-100 text-gray-800 font-inter has-light-background">
    <div class="min-h-screen flex flex-col">
        <x-main-navbar />

        <main class="flex-grow pt-24">
            <div class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <h1 class="text-4xl font-extrabold font-sora text-gray-900 tracking-tight">Riwayat Pesanan</h1>
                    <p class="mt-2 text-lg text-gray-600">Lacak semua pesanan yang pernah Anda buat.</p>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                {{-- Notifikasi Sukses/Error --}}
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                        <p class="font-bold">Sukses!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert">
                        <p class="font-bold">Gagal!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                @if($orders->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 text-center py-20">
                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5v-1.875a3.375 3.375 0 003.375-3.375h1.5a1.125 1.125 0 011.125 1.125v-1.5a3.375 3.375 0 00-3.375-3.375H3.375m15.75 9V12a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 12v6.75m15.75 0V12" /></svg>
                        <h3 class="mt-4 text-xl font-sora font-bold text-gray-900">Anda Belum Memiliki Pesanan</h3>
                        <p class="mt-2 text-base text-gray-500">Semua pesanan Anda akan muncul di sini setelah Anda melakukan pembelian.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                                Mulai Belanja
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200" x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                                <div class="p-6 cursor-pointer" @click="open = !open">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900">Pesanan #{{ $order->id }}</h3>
                                            <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d F Y') }}</p>
                                        </div>
                                        <div class="mt-3 sm:mt-0 text-left sm:text-right">
                                            <p class="text-xl font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($order->status == 'processing') bg-blue-100 text-blue-800 @endif
                                                @if($order->status == 'completed') bg-green-100 text-green-800 @endif
                                                @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 p-6" x-show="open" x-transition>
                                    <div class="mb-6">
                                        @php
                                            $statuses = ['pending', 'processing', 'completed'];
                                            $currentStatusIndex = array_search($order->status, $statuses);
                                        @endphp
                                        @if($order->status != 'cancelled')
                                            <div class="flex items-center">
                                                @foreach(['Diproses', 'Dikirim', 'Selesai'] as $index => $label)
                                                    @php $isCompleted = $currentStatusIndex !== false && $currentStatusIndex >= $index; @endphp
                                                    <div class="flex flex-col items-center text-center relative z-10 w-1/3">
                                                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500 border-2' }}">
                                                            @if($isCompleted)
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                            @endif
                                                        </div>
                                                        <p class="mt-2 text-xs font-semibold {{ $isCompleted ? 'text-gray-800' : 'text-gray-400' }}">{{ $label }}</p>
                                                    </div>
                                                    @if (!$loop->last)
                                                        <div class="flex-grow h-1 {{ $isCompleted && $currentStatusIndex > $index ? 'bg-blue-600' : 'bg-gray-200' }}"></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center p-4 bg-red-50 rounded-lg"><p class="font-bold text-red-600">Pesanan Dibatalkan</p></div>
                                        @endif
                                    </div>
                                    
                                    <h4 class="font-bold mb-2">Item Pesanan:</h4>
                                    <ul class="space-y-3 mb-6">
                                        @foreach($order->items as $item)
                                        <li class="flex items-center justify-between text-sm">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ asset('img/' . ($item->sparepart->gambar ?? 'default-image.png')) }}" alt="{{ $item->sparepart->nama_barang ?? 'Produk Dihapus' }}" class="w-12 h-12 object-cover rounded-md border">
                                                <div>
                                                    <span class="font-semibold">{{ $item->sparepart->nama_barang ?? 'Produk Dihapus' }}</span>
                                                    <p class="text-gray-500">Jumlah: {{ $item->quantity }}</p>
                                                </div>
                                            </div>
                                            <span class="text-gray-700 font-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                        </li>
                                        @endforeach
                                    </ul>

                                    @if($order->status == 'pending')
                                        <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-center px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200">
                                                Batalkan Pesanan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </main>
        
        @include('layouts.partials.footer')
    </div>
</body>
</html>