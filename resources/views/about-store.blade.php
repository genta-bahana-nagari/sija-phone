@extends('layouts.without-banner')

@section('content')
<div class="bg-white font-sans">
    <!-- Hero Banner -->
    <section class="mt-6 mx-6">
        <div class="w-full h-52 rounded-lg flex items-center justify-center text-center px-4 bg-[url('https://plus.unsplash.com/premium_photo-1668472170724-8b544ca3c86e?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-cover bg-center">
            <div>
                <h1 class="text-3xl font-bold text-orange-400 mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Tentang SIJA Phone
                </h1>
                <p class="text-white font-semibold text-lg max-w-2xl mx-auto" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Tempat terbaik untuk menemukan smartphone impianmu dengan pelayanan profesional dan harga kompetitif.
                </p>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="mt-10 mx-6">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1469384016477-880d0bb46a51?q=80&w=1432&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tentang SIJA Phone" class="rounded-lg shadow-md object-cover w-full h-80">
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">SIJA Phone, Pilihan Cerdas untuk Kebutuhan Teknologimu</h2>
                <p class="text-gray-600 mb-4">Kami adalah platform penjualan smartphone yang mengutamakan kualitas, kenyamanan, dan kepercayaan pelanggan. Didirikan oleh tim yang berpengalaman di bidang teknologi dan retail, kami berkomitmen untuk menyediakan produk-produk terbaru dan terjamin keasliannya.</p>
                <p class="text-gray-600 mb-4">Mulai dari brand global ternama hingga varian lokal terbaik, SIJA Phone menghadirkan berbagai pilihan smartphone dan aksesoris untuk memenuhi kebutuhan gaya hidup digitalmu.</p>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="mt-12 mx-6">
        <div class="bg-gray-50 rounded-lg p-6 md:p-10 shadow-inner">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Visi & Misi Kami</h3>
            <ul class="list-disc pl-6 text-gray-700 space-y-2">
                <li><strong>Visi:</strong> Menjadi toko smartphone terdepan yang memberikan pengalaman belanja online yang terpercaya dan mudah.</li>
                <li><strong>Misi:</strong> 
                    <ul class="list-disc pl-6 mt-1 space-y-1">
                        <li>Menyediakan produk berkualitas tinggi dengan harga kompetitif.</li>
                        <li>Memberikan layanan pelanggan yang cepat dan ramah.</li>
                        <li>Selalu mengikuti perkembangan teknologi untuk menghadirkan produk-produk terkini.</li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="mt-12 mx-6">
        <h3 class="text-3xl text-center font-semibold text-gray-800 mb-4">Mengapa Memilih SIJA Phone?</h3>
        <div class="grid md:grid-cols-3 gap-6 text-gray-700">
            <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                <h4 class="font-bold mb-2 text-orange-500">Garansi Produk</h4>
                <p>Kami menjamin keaslian dan kualitas setiap produk yang dijual dengan garansi resmi.</p>
            </div>
            <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                <h4 class="font-bold mb-2 text-orange-500">Pengiriman Cepat</h4>
                <p>Pengiriman ke seluruh Indonesia dengan berbagai pilihan kurir terpercaya.</p>
            </div>
            <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                <h4 class="font-bold mb-2 text-orange-500">Layanan Pelanggan 24/7</h4>
                <p>Tim kami siap membantu kebutuhan dan pertanyaanmu kapan pun dibutuhkan.</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="mt-12 mx-6 rounded-lg bg-gray-50 p-8 text-center shadow-lg">
        <h2 class="text-2xl font-bold text-blue-600 mb-3">Bergabunglah dengan ribuan pelanggan puas!</h2>
        <p class="text-gray-700 mb-6">Mulai pengalaman belanja gadget terbaik bersama SIJA Phone sekarang.</p>
        <a href="{{ route('phones.see-all') }}" class="px-6 py-3 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition duration-300 font-semibold">
            Belanja Sekarang
        </a>
    </section>

    <!-- Developers -->
    <section class="mt-12 mx-6">
        <h3 class="text-3xl text-center font-semibold text-gray-800 mb-8">Developer Kami</h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6 text-gray-700">
            <!-- Card 1 -->
            <div class="border rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 text-center bg-white">
                <h4 class="font-bold mb-2 text-orange-500 text-lg">Akbar Ad'ha Kw.</h4>
                <p class="text-sm font-medium">Server Administrator</p>
            </div>
            <!-- Card 2 -->
            <div class="border rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 text-center bg-white">
                <h4 class="font-bold mb-2 text-orange-500 text-lg">Arifin Nur Ihsan</h4>
                <p class="text-sm font-medium">Backend Developer</p>
            </div>
            <!-- Card 3 -->
            <div class="border rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 text-center bg-white">
                <h4 class="font-bold mb-2 text-orange-500 text-lg">Bijak Putra Firmansyah</h4>
                <p class="text-sm font-medium">UI/UX Designer</p>
            </div>
            <!-- Card 4 -->
            <div class="border rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300 text-center bg-white">
                <h4 class="font-bold mb-2 text-orange-500 text-lg">Gabriel Possenti Genta</h4>
                <p class="text-sm font-medium">Frontend Developer</p>
            </div>
        </div>
    </section>
</div>
@endsection
