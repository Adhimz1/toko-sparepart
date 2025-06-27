<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Berhasil - Sinar Jaya</title>
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
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 text-center p-8 md:p-12">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    
                    <h1 class="mt-6 text-3xl font-extrabold font-sora text-gray-900">Pesanan Anda Berhasil Dibuat!</h1>
                    <p class="mt-2 text-lg text-gray-600">Terima kasih telah berbelanja. Pesanan Anda dengan ID <span class="font-bold">#{{ $order->id }}</span> sedang kami proses.</p>

                    <div class="mt-10 mb-8">
                        @php
                            $statuses = ['pending', 'processing', 'completed', 'cancelled'];
                            $currentStatusIndex = array_search($order->status, $statuses);
                        @endphp
                        <div class="flex items-center">
                            @foreach(['Dikemas', 'Dikirim', 'Selesai'] as $index => $label)
                                @php
                                    $isCompleted = $currentStatusIndex >= $index;
                                @endphp
                                <div class="flex flex-col items-center text-center relative z-10">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                                        {{ $isCompleted ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500 border-2' }}">
                                        @if($isCompleted)
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-sm font-semibold {{ $isCompleted ? 'text-gray-800' : 'text-gray-400' }}">{{ $label }}</p>
                                </div>
                                @if (!$loop->last)
                                    <div class="flex-grow h-1 {{ $isCompleted && $currentStatusIndex > $index ? 'bg-blue-600' : 'bg-gray-200' }}"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('user.orders.index') }}" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                            Lihat Riwayat Pesanan
                        </a>
                        <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 border">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </main>
        @include('layouts.partials.footer')
    </div>
</body>
</html>