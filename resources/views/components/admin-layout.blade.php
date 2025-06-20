<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name', 'Toko Sparepart') }}</title>
    <!-- Fonts & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white shadow-lg dark:bg-gray-800 lg:translate-x-0 lg:static lg:inset-0"
               :class="{'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen}">
            
            <div class="flex items-center justify-center p-4">
                <a href="{{ route('admin.spareparts.index') }}" class="flex items-center space-x-3">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">Admin Sparepart</span>
                </a>
            </div>

            <nav class="mt-8">
                <div class="px-6 py-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Utama</h3>
                    <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-700 rounded-md dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
                        <span class="mx-3">Dashboard</span>
                    </a>
                </div>

                <div class="px-6 py-2 mt-4">
                     <h3 class="text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Manajemen Konten</h3>
                    <a href="{{ route('admin.spareparts.index') }}" class="flex items-center px-4 py-2 mt-2 rounded-md dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 @if(request()->routeIs('admin.spareparts.*')) bg-blue-600 text-white dark:bg-blue-600 @endif">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v7.5m0-7.5l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v7.5m9-13.5l2.25 1.313M12 4.5l-2.25 1.313M12 4.5v7.5m0-7.5l2.25 1.313M12 4.5l-2.25 1.313M9 16.5l3 1.732M12 18.232l3-1.732M12 18.232v4.5m-3-6.232l-3-1.732M15 16.5l3-1.732M15 16.5l-3 1.732m-3-6.232l-3 1.732" /></svg>
                        <span class="mx-3">Kelola Produk</span>
                    </a>
                </div>

                <div class="px-6 py-2 mt-4">
                     <h3 class="text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">Manajemen Akses</h3>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 mt-2 rounded-md dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 @if(request()->routeIs('admin.users.*')) bg-blue-600 text-white dark:bg-blue-600 @endif">
                       <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-2.253M15 19.128v-3.043m0 3.043a2.25 2.25 0 0 1-2.25 2.25H15M15 19.128a2.25 2.25 0 0 1-2.25-2.25v-3.043m0 0a2.25 2.25 0 0 0-2.25-2.25H6.75m0 0a2.25 2.25 0 0 0-2.25 2.25v3.043m0 0a2.25 2.25 0 0 0 2.25 2.25h2.25m-4.5 0a2.25 2.25 0 0 1-2.25-2.25v-3.043m0 0a2.25 2.25 0 0 1 2.25-2.25H6.75m6.75 0a2.25 2.25 0 0 1 2.25 2.25v3.043m0 0a2.25 2.25 0 0 1-2.25 2.25H9.375m-3.75 0a2.25 2.25 0 0 0-2.25-2.25H1.5V7.5a2.25 2.25 0 0 1 2.25-2.25h1.5" /></svg>
                        <span class="mx-3">Kelola Pengguna</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="flex items-center justify-between p-4 bg-white border-b dark:bg-gray-800">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="flex-1"></div>
                <!-- User Dropdown -->
                <div class="relative">
                     <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-gray-600 dark:text-gray-300">
                                <span>Halo, {{ Auth::user()->name }}</span>
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:text-red-700">Logout</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
                <div class="container mx-auto px-6 py-8">
                     @if (isset($header))
                        <div class="mb-6">{{ $header }}</div>
                    @endif
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="p-4 text-center text-sm text-gray-600 bg-white border-t dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                Admin Panel © {{ date('Y') }} {{ config('app.name', 'Toko Sparepart') }}. All rights reserved.
            </footer>
        </div>
    </div>
</body>
</html>