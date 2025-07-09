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
            <h1 class="text-3xl font-extrabold mb-2 leading-snug">
                {{ $phone->brand->brand }}
                <span>
                {{ $phone->tipe }}
                </span>
            </h1>
            <p class="text-lg font-semibold mb-4 leading-snug">
                Stok saat ini: 
                <span class="text-orange-600">{{ $phone->stok }}</span>
            </p>

            {{-- Gambar Produk --}}
            <div class="w-full mb-6">
                <img src="{{ asset('storage/' . $phone->gambar) }}" alt="{{ $phone->tipe }}" class="rounded-lg shadow-md w-full object-cover">
            </div>

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
                <form action="{{ route('cart.add') }}" method="POST" class="w-full sm:flex-1">
                    @csrf
                    <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                    <input type="hidden" name="quantity" id="inputQty" value="1">
                    <button type="submit" class="w-full bg-gray-200 text-black py-2 px-4 rounded font-semibold text-sm flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <span>Masuk Keranjang</span>
                    </button>
                </form>
                <form action="{{ route('checkout.fromProduct') }}" method="POST" class="w-full sm:flex-1">
                    @csrf
                    <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                    <input type="hidden" name="quantity" id="inputQty" value="1">
                    <button type="submit" class="w-full bg-gray-200 text-black py-2 px-4 rounded font-semibold text-sm flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span>Beli Sekarang</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section class="mt-6 mx-6">
        <div class="flex items-center gap-4 mb-4 text-sm md:text-lg font-semibold ">
            <h2>Berdasarkan preferensimu</h2>
            <a href="{{ route('phones.see-all') }}" class="text-blue-500 hover:underline transition-all duration-200">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-5 md:grid-cols-4 gap-4">
            @foreach ($phonesForRecommendation as $phone)
            <div onclick="window.location='{{ route('phones.show', $phone->id) }}'" class="border p-4 rounded-lg shadow-sm hover:shadow-md transition cursor-pointer">
                <img src="{{ asset('storage/' . $phone->gambar) }}" alt="{{ $phone->tipe }}" class="object-cover w-full h-48 mb-3">
                <div class="p-3">
                    <p class="text-xs text-gray-400 mb-1">{{ $phone->brand->brand }}
                        <span>{{ $phone->tipe }}</span>
                    </p>
                    <h3 class="text-sm font-semibold leading-tight mb-1">{{ Str::limit($phone->deskripsi, 50) }}</h3>
                    <p class="text-black font-bold mb-1">Harga: Rp{{ number_format($phone->harga, 0, ',', '.') }}</p>
                    <p class="text-orange-600 font-bold mb-1">Stok: {{ $phone->stok }}</p>
                    <div class="text-xs text-gray-500">Status: {{ $phone->status_stok ? 'Tersedia' : 'Habis' }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</div>


<script>
    let qty = 1;

    function updateQtyDisplay() {
        document.getElementById('qty').innerText = qty;
        document.getElementById('inputQty').value = qty;
    }

    function increaseQty() {
        qty++;
        updateQtyDisplay();
    }

    function decreaseQty() {
        if (qty > 1) qty--;
        updateQtyDisplay();
    }

    document.addEventListener('DOMContentLoaded', updateQtyDisplay);
</script>

@endsection