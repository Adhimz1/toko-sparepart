<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Sinar Jaya</title>
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
                    <h1 class="text-4xl font-extrabold font-sora text-gray-900 tracking-tight">Checkout</h1>
                    <p class="mt-2 text-lg text-gray-600">Selesaikan pesanan Anda dengan mengisi detail di bawah ini.</p>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                        
                        {{-- Kolom Kiri: Form Detail Pengiriman --}}
                        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h2 class="text-xl font-bold mb-6">Detail Pengiriman</h2>
                            
                            @if ($errors->any())
                                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">Oops!</strong>
                                    <ul class="mt-2 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="space-y-4">
                                {{-- Nama dan Telepon --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    </div>
                                </div>
                                {{-- Alamat Lengkap (Textarea) --}}
                                <div>
                                    <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap Pengiriman</label>
                                    <textarea name="shipping_address" id="shipping_address" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 02, Kelurahan, Kecamatan, Kota/Kab, Provinsi, Kode Pos 12345" required>{{ old('shipping_address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Ringkasan Pesanan --}}
                        <div class="lg:col-span-1 sticky top-28">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                @php
                                    $cart = session('cart', []);
                                    $total = 0;
                                    foreach ($cart as $details) {
                                        $total += $details['price'] * $details['quantity'];
                                    }
                                @endphp
                                <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Subtotal</span>
                                        <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Pengiriman</span>
                                        <span class="font-semibold">Gratis</span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4 flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="w-full flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                                        Buat Pesanan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        @include('layouts.partials.footer')
    </div>
    {{-- Tidak perlu skrip AJAX lagi --}}
</body>
</html>