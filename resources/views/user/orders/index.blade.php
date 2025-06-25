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

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
                {{-- Contoh Pesanan dengan Status "Pengantaran" --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="border-b pb-4 mb-4">
                        <h3 class="font-bold">Pesanan #12345</h3>
                        <p class="text-sm text-gray-500">Tanggal: 20 Juli 2024 - Total: Rp 1.050.000</p>
                    </div>
                    
                    <div class="flex items-center justify-between text-center text-sm">
                        <div class="flex-1"><div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div><p class="mt-2 font-semibold">Diproses</p></div>
                        <div class="flex-1 h-1 bg-blue-600"></div>
                        <div class="flex-1"><div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div><p class="mt-2 font-semibold">Pengantaran</p></div>
                        <div class="flex-1 h-1 bg-gray-300"></div>
                        <div class="flex-1 text-gray-400"><div class="mx-auto w-10 h-10 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center"></div><p class="mt-2">Selesai</p></div>
                    </div>
                </div>
                {{-- ... (pesanan lainnya) ... --}}
            </div>
        </main>
        
        @include('layouts.partials.footer')
    </div>
</body>
</html>