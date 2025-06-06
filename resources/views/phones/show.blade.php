@extends('layouts.welcome')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 md:px-0">
    {{-- Breadcrumb --}}
    <div class="text-lg font-semibold text-gray-500 mb-4 px-6">
        <a href="/" class="hover:underline">Home</a> / 
        <a href="#" class="hover:underline">{{ $phone->brand->brand }}</a> / 
        <span class="text-black font-semibold">{{ $phone->tipe }}</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6">

        {{-- LEFT SIDE --}}
        <div class="md:col-span-2">

            {{-- Title --}}
            <h1 class="text-3xl font-extrabold mb-4 leading-snug">
                {{ $phone->brand->brand }}
                <span>
                {{ $phone->tipe }}
                </span>
            </h1>

            {{-- Seller Info --}}
            <div class="flex items-center gap-3 mb-3">
                <!-- <div class="w-10 h-10 bg-gray-300 rounded-full"></div> -->
                <img src="{{ asset('site-logo.png') }}" alt="Logo" class="h-10">
                <div>
                    <p class="font-semibold text-sm">Phone Shop</p>
                    <p class="text-xs text-gray-500">
                        Verified Seller · Average Respond Time : <span class="font-semibold">TBD</span>
                    </p>
                </div>
            </div>

            {{-- Description --}}
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-md font-semibold mb-2 flex items-center gap-2">
                    📝 Description
                </h2>
                <div class="text-sm text-gray-800 leading-relaxed space-y-3">
                    {!! nl2br(e($phone->deskripsi)) !!}
                </div>
            </div>
            {{-- Ulasan / Review --}}
            <div class="mt-10 bg-white rounded shadow p-6">
                <h2 class="text-xl font-bold mb-4">🗣️ Seller Review</h2>

                {{-- Simulasi review, bisa diganti dengan data dinamis nanti --}}
                @foreach (range(1, 3) as $i)
                <div class="mb-4 p-4 bg-gray-50 rounded border">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                        <strong>Nama Pembeli {{ $i }}</strong>
                    </div>
                    <p class="text-sm text-gray-700">Komentar dari pembeli mengenai produk ini... Sangat puas!</p>
                </div>
                @endforeach

                <div class="text-center">
                    <button class="text-sm text-blue-600 hover:underline mt-2">Lihat Lebih Banyak</button>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="bg-white shadow-md rounded-xl p-4 w-full max-w-full sm:max-w-md md:max-w-sm overflow-hidden self-start">

            {{-- Header Seller --}}
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('site-logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                <div class="min-w-0">
                    <p class="font-semibold text-sm truncate">Phone Shop</p>
                    <p class="text-xs text-gray-500 whitespace-nowrap overflow-hidden text-ellipsis">
                        • Last Active: 5 minutes ago
                        <span class="text-yellow-500 font-semibold">5.0 ★</span>
                    </p>
                </div>
            </div>

            {{-- Title Summary --}}
            <p class="text-sm font-semibold mb-2 leading-snug break-words">
                {{ $phone->brand->brand }}
                <span>{{ $phone->tipe }}</span>
            </p>

            {{-- Short Desc --}}
            <p class="text-sm font-semibold mb-2 break-words">
                {{ \Illuminate\Support\Str::limit($phone->deskripsi, 150) }}
            </p>

            {{-- Harga --}}
            <p class="text-xl font-bold text-red-600 mb-4">
                Rp {{ number_format($phone->harga, 0, ',', '.') }}
            </p>

            {{-- Quantity + Buttons --}}
            <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-3">

                {{-- Qty Selector --}}
                <div class="flex items-center justify-between bg-black text-white rounded-full px-3 py-1 w-full sm:w-auto">
                    <button onclick="decreaseQty()" class="text-lg font-bold px-2">−</button>
                    <span id="qty" class="px-4 text-sm">1</span>
                    <button onclick="increaseQty()" class="text-lg font-bold px-2">+</button>
                </div>

                {{-- Action Buttons --}}
                <button class="w-full sm:flex-1 bg-gray-200 text-black py-2 px-4 rounded font-semibold text-sm">
                    Beli Sekarang
                </button>
                <button class="w-full sm:flex-1 bg-gray-200 text-black py-2 px-4 rounded font-semibold text-sm">
                    Keranjang
                </button>
            </div>
        </div>

    </div>

</div>


<script>
    let qty = 1;
    function increaseQty() {
        qty++;
        document.getElementById('qty').innerText = qty;
    }
    function decreaseQty() {
        if (qty > 1) qty--;
        document.getElementById('qty').innerText = qty;
    }
</script>

@endsection
