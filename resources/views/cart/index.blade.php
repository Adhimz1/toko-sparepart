<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja - Sinar Jaya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-sora { font-family: 'Sora', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        /* CSS untuk menghilangkan spinner pada input angka */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
    </style>
</head>
{{-- PERBAIKAN DI SINI: Menambahkan 'has-light-background' --}}
<body class="antialiased bg-gray-100 text-gray-800 font-inter has-light-background">
    <div class="min-h-screen flex flex-col">

        {{-- Menggunakan navbar utama yang konsisten --}}
        <x-main-navbar />

        <main class="flex-grow pt-24">
            <div class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <h1 class="text-4xl font-extrabold font-sora text-gray-900 tracking-tight">Keranjang Belanja</h1>
                    <p class="mt-2 text-lg text-gray-600">Periksa kembali item Anda sebelum melanjutkan ke pembayaran.</p>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                @if(session('cart') && count(session('cart')) > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                        
                        {{-- Kolom Kiri: Daftar Item Keranjang --}}
                        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6">
                                <h2 class="text-xl font-bold mb-4">Item di Keranjang ({{ $cartCount }})</h2>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 text-left text-sm text-gray-500 uppercase">
                                        <tr>
                                            <th class="px-6 py-3 font-medium">Produk</th>
                                            <th class="px-6 py-3 font-medium">Harga</th>
                                            <th class="px-6 py-3 font-medium text-center">Jumlah</th>
                                            <th class="px-6 py-3 font-medium text-right">Subtotal</th>
                                            <th class="px-6 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0 @endphp
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            <tr data-id="{{ $id }}" class="border-t border-gray-200">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <img src="{{ asset('img/' . ($details['image'] ?? 'default.png')) }}" alt="{{ $details['name'] }}" class="w-20 h-20 object-cover rounded-lg">
                                                        <div>
                                                            <p class="font-semibold">{{ $details['name'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    <input type="number" value="{{ $details['quantity'] }}" min="1" class="w-20 text-center border-gray-300 rounded-md shadow-sm cart_update" />
                                                </td>
                                                <td class="px-6 py-4 text-right font-semibold">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    <button class="cart_remove text-red-500 hover:text-red-700">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Ringkasan Pesanan --}}
                        <div class="lg:col-span-1 sticky top-28">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Subtotal</span>
                                        <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Pengiriman</span>
                                        <span class="font-semibold">Rp 0</span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-4 flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <a href="#" class="w-full flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                                        Lanjutkan ke Pembayaran
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 text-center py-20">
                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.823a.75.75 0 00-.674-.928H5.61a.75.75 0 00-.674.928L4.882 12M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218" /></svg>
                        <h3 class="mt-4 text-xl font-sora font-bold text-gray-900">Keranjang Anda Kosong</h3>
                        <p class="mt-2 text-base text-gray-500">Sepertinya Anda belum menambahkan produk apapun.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                                Mulai Belanja
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </main>
        
        {{-- Footer yang konsisten --}}
        @include('layouts.partials.footer')
    </div>

    {{-- Script untuk AJAX Update & Remove --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(".cart_update").change(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id"), 
                    quantity: ele.parents("tr").find(".cart_update").val()
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });

        $(".cart_remove").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Apakah Anda yakin ingin menghapus item ini?")) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
</body>
</html>