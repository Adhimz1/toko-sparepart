<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Pesanan Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Contoh Pesanan dengan Status "Pengantaran" --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-bold">Pesanan #12345</h3>
                    <p class="text-sm text-gray-500">Tanggal: 20 Juli 2024 - Total: Rp 1.050.000</p>
                </div>
                
                {{-- Progress Bar Status --}}
                <div class="flex items-center justify-between text-center text-sm">
                    {{-- Langkah 1: Diproses --}}
                    <div class="flex-1">
                        <div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div>
                        <p class="mt-2 font-semibold">Diproses</p>
                    </div>
                    <div class="flex-1 h-1 bg-blue-600"></div> {{-- Garis Penghubung --}}
                    
                    {{-- Langkah 2: Pengantaran --}}
                    <div class="flex-1">
                        <div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div>
                        <p class="mt-2 font-semibold">Pengantaran</p>
                    </div>
                    <div class="flex-1 h-1 bg-gray-300"></div> {{-- Garis Penghubung --}}
                    
                    {{-- Langkah 3: Selesai --}}
                    <div class="flex-1 text-gray-400">
                        <div class="mx-auto w-10 h-10 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center"></div>
                        <p class="mt-2">Selesai</p>
                    </div>
                </div>
            </div>

            {{-- Contoh Pesanan dengan Status "Selesai" --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-bold">Pesanan #12300</h3>
                    <p class="text-sm text-gray-500">Tanggal: 15 Juli 2024 - Total: Rp 500.000</p>
                </div>
                <div class="flex items-center justify-between text-center text-sm">
                    <div class="flex-1">
                        <div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div>
                        <p class="mt-2 font-semibold">Diproses</p>
                    </div>
                    <div class="flex-1 h-1 bg-blue-600"></div>
                    <div class="flex-1">
                        <div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div>
                        <p class="mt-2 font-semibold">Pengantaran</p>
                    </div>
                    <div class="flex-1 h-1 bg-blue-600"></div>
                    <div class="flex-1">
                        <div class="mx-auto w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">✔</div>
                        <p class="mt-2 font-semibold">Selesai</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>