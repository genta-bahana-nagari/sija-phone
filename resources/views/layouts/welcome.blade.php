<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Store</title>
    <link rel="icon" href="{{ asset('site-logo.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Kiri: Logo dan Search -->
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <div class="flex items-center space-x-1">
                    <img src="/images/logo.png" alt="Logo" class="h-10">
                    <span class="font-semibold text-sm">Merk</span>
                </div>

                <!-- Search bar -->
                <div class="relative w-80">
                    <!-- Heroicon: Magnifying Glass -->
                    <div class="absolute inset-y-0 left-2 flex items-center pointer-events-none">
                        <!-- Heroicon: Magnifying Glass -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1117 9.5a7.5 7.5 0 01-.35 7.15z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        class="w-full border rounded-full py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="cari di toko ini"
                    >
                </div>

                <!-- Menu Link -->
                <nav class="ml-4 space-x-4 text-sm text-gray-700 hidden md:flex">
                    <a href="#">Untukmu</a>
                    <a href="#">Promo</a>
                    <a href="#">Terlaris</a>
                    <a href="#">Terbaru</a>
                </nav>
            </div>

            <!-- Kanan: Icons dan Profile -->
            <div class="flex items-center space-x-4">
                <!-- Icon Keranjang -->
                <a href="#" title="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h13L17 13M7 13h10M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>
                </a>

                <!-- Icon Notifikasi -->
                <a href="#" title="Notifikasi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405C18.79 14.79 18 13.42 18 12V8a6 6 0 00-9.33-4.86A5.97 5.97 0 006 8v4c0 1.42-.79 2.79-1.595 3.595L3 17h5m7 0v1a3 3 0 01-6 0v-1m6 0H9"/>
                    </svg>
                </a>

                <!-- Icon Pesan -->
                <a href="#" title="Pesan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m-6 8h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </a>

                <!-- Toko -->
                <a href="#" class="flex items-center space-x-1 text-sm text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M5 10V6a1 1 0 011-1h12a1 1 0 011 1v4m-1 0v10H6V10"/>
                    </svg>
                    <span>Toko</span>
                </a>

                <!-- Profile -->
                <a href="#" class="flex items-center space-x-1 text-sm text-gray-700">
                    <img src="/images/profile.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                    <span>Bijak</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Dynamic Content -->
    <main class="bg-white">
        @yield('content')
    </main>

    <!-- Footer (Optional) -->
    <footer class="bg-white border-t mt-12 mx-4 text-sm text-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Informasi Phoneshop -->
            <div>
            <h4 class="font-semibold mb-3">Phoneshop</h4>
            <ul class="space-y-2">
                <li><a href="#">Tentang Phoneshop</a></li>
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
