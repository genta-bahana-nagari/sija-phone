<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIJA Phone</title>
    <link rel="icon" href="{{ asset('site-logo.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-2 py-3 flex justify-between">
            <!-- Kiri: Logo + Search -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-6 w-full sm:w-auto">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('site-logo.png') }}" alt="Logo" class="h-10">
                    <span class="text-sm font-semibold">SIJA Phone</span>
                </a>

                <!-- Search Bar -->
                <div class="w-full sm:w-96">
                    <form action="{{ route('phones.see-all') }}" method="GET">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1117 9.5a7.5 7.5 0 01-.35 7.15z"/>
                                </svg>
                            </div>
                            <input type="text" name="q" value="{{ request()->query('q') }}" placeholder="cari di toko ini"
                                class="w-full border border-gray-300 rounded-full py-2 pl-10 pr-4 text-sm focus:ring-orange-500 focus:border-orange-500 focus:outline-none">
                        </div>
                    </form>

                    <!-- Menu navigasi -->
                    <nav class="mt-2 flex space-x-4 text-sm text-gray-600">
                        <a href="{{ route('phones.see-all') }}" class="hover:text-orange-500">Untukmu</a>
                        <a href="{{ route('phones.see-all') }}" class="hover:text-orange-500">Promo</a>
                        <a href="{{ route('phones.see-all') }}" class="hover:text-orange-500">Terlaris</a>
                        <a href="{{ route('phones.see-all') }}" class="hover:text-orange-500">Terbaru</a>
                        <a href="{{ route('orders.history') }}" class="hover:text-orange-500">Daftar Pesanan</a>
                    </nav>
                </div>
            </div>

            <!-- Kanan: Icons -->
            <div class="flex items-center gap-x-6">
                <!-- Keranjang -->
                <a href="{{ route('cart.index') }}" title="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>

                <!-- Notifikasi -->
                <a href="#" title="Notifikasi">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                    </svg>
                </a>

                <!-- Pesan -->
                <a href="#" title="Pesan">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </a>

                <!-- Toko -->
                <a href="{{ route('about.store') }}" class="flex items-center space-x-1 text-sm text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M5 10V6a1 1 0 011-1h12a1 1 0 011 1v4m-1 0v10H6V10"/>
                    </svg>
                    <span>Toko</span>
                </a>

                <!-- Profil -->
                <!-- Jika sudah login -->
                @auth
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button type="button"
                        @click="open = !open"
                        class="flex items-center space-x-2 text-sm text-gray-700 focus:outline-none"
                        id="profile-menu-button">
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-52 bg-white rounded-md shadow-lg z-10"
                        id="profile-menu">
                        <div class="py-2">
                            <a href="{{ route('profile.show') }}"
                                class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('orders.history') }}"
                                class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>
                                <span>Pesanan Saya</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center space-x-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5"/>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth

                <!-- Jika belum login -->
                @guest
                    <a href="{{ route('login') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Dynamic Content -->
    <main class="bg-white">
        <!-- Carousel Section -->
        @yield('content')
    </main>

    <!-- Footer (Optional) -->
    <footer class="bg-white border-t mt-12 mx-4 text-sm text-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Informasi Phoneshop -->
            <div>
            <h4 class="font-semibold mb-3">SIJA Phone</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('about.store') }}">Tentang SIJA Phone</a></li>
                <li><a href="#">Lorem Ipsum</a></li>
                <li><a href="#">Karir</a></li>
                <li><a href="#">Promo Hari Ini</a></li>
            </ul>
            </div>

            <!-- Panduan -->
            <div>
            <h4 class="font-semibold mb-3">Bantuan Dan Panduan</h4>
            <ul class="space-y-2">
                <li><a href="#">Customer Care</a></li>
                <li><a href="#">Syarat dan Ketentuan</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
            </ul>
            </div>

            <!-- Beli / Jual -->
            <div>
            <h4 class="font-semibold mb-3">Beli</h4>
            <ul class="space-y-2 mb-4">
                <li><a href="#">Merk</a></li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">COD</a></li>
                <li><a href="#">Aksesoris</a></li>
            </ul>
            <h4 class="font-semibold mb-3">Jual</h4>
            <ul class="space-y-2">
                <li><a href="#">Jasa Titip</a></li>
                <li><a href="#">Tukar Tambah</a></li>
            </ul>
            </div>

            <!-- Pembayaran & Pengiriman -->
            <div class="md:col-span-1 flex flex-col gap-6">
            <!-- Pembayaran -->
            <div>
                <h4 class="font-semibold mb-3">Pembayaran</h4>
                <img src="{{ asset('payment.png') }}" alt="Metode Pembayaran" class="w-full object-contain">
            </div>
            <!-- Pengiriman -->
            <div>
                <h4 class="font-semibold mb-3">Pengiriman</h4>
                <img src="{{ asset('shipping.png') }}" alt="Metode Pengiriman" class="w-full object-contain">
            </div>
            </div>
        </div>
        <div class="text-center text-xs text-gray-500 py-4 border-t mt-6">
            &copy; 2025 Phoneshop. All rights reserved.
        </div>
    </footer>

</body>
</html>
