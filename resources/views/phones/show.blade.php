@extends('layouts.welcome')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6">

    {{-- LEFT SIDE --}}
    <div class="md:col-span-2">

        {{-- Title --}}
        <h1 class="text-3xl font-extrabold mb-2 leading-snug">
            {{ $phone->brand->brand }}
            <span>{{ $phone->tipe }}</span>
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
            <h2 class="text-md font-semibold mb-2 flex items-center gap-2">📝 Description</h2>
            <div class="text-sm text-gray-800 leading-relaxed space-y-3">
                {!! nl2br(e($phone->deskripsi)) !!}
            </div>
        </div>

        {{-- Ulasan --}}
        <div class="mt-10 bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">🗣️ Seller Review</h2>
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

        <p class="text-sm font-semibold mb-2 leading-snug break-words">
            {{ $phone->brand->brand }}
            <span>{{ $phone->tipe }}</span>
        </p>
        <p class="text-sm font-semibold mb-2 break-words">
            {{ \Illuminate\Support\Str::limit($phone->deskripsi, 150) }}
        </p>
        <p class="text-xl font-bold text-red-600 mb-4">
            Rp {{ number_format($phone->harga, 0, ',', '.') }}
        </p>

        {{-- Qty Selector & Buttons --}}
        <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-3">

            {{-- Qty Selector --}}
            <div class="flex items-center justify-between bg-black text-white rounded-full px-3 py-1 w-full sm:w-auto">
                <button onclick="decreaseQty()" class="text-lg font-bold px-2">−</button>
                <span id="qty" class="px-4 text-sm">1</span>
                <button onclick="increaseQty()" class="text-lg font-bold px-2">+</button>
            </div>

            {{-- Masuk Keranjang --}}
            <form action="{{ route('cart.add') }}" method="POST" class="w-full sm:flex-1">
                @csrf
                <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                <input type="hidden" name="quantity" id="inputQty" value="1">
                <button type="submit" id="addToCartBtn" class="w-full bg-gray-200 text-black py-2 px-4 rounded font-semibold text-sm flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span>Masuk Keranjang</span>
                </button>
            </form>

            {{-- Beli Sekarang --}}
            <form action="{{ route('checkout.fromProduct') }}" method="POST" class="w-full sm:flex-1">
                @csrf
                <input type="hidden" name="phone_id" value="{{ $phone->id }}">
                <input type="hidden" name="quantity" id="inputQty" value="1">
                <button type="submit" id="buyNowBtn" class="w-full bg-gray-200 text-black py-2 px-4 rounded font-semibold text-sm flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span>Beli Sekarang</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Stok Habis -->
    <div id="stokHabisModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-11/12 max-w-sm text-center">
            <h2 class="text-xl font-bold text-red-600 mb-4">Stok Habis</h2>
            <p class="text-gray-700 mb-6">Maaf, produk ini sudah habis dan tidak bisa dibeli saat ini.</p>
            <button onclick="closeModal()" class="bg-black text-white px-4 py-2 rounded-md font-semibold hover:bg-gray-800">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const stok = {{ $phone->stok }};
    const qtyDisplay = document.getElementById('qty');
    const inputQtys = document.querySelectorAll('#inputQty');
    const addToCartBtn = document.getElementById('addToCartBtn');
    const buyNowBtn = document.getElementById('buyNowBtn');

    function updateButtons(qty) {
        if (stok === 0 || qty < 1) {
            disableButtons(true);
            qtyDisplay.textContent = "0";
            inputQtys.forEach(el => el.value = 0);
            alert("Produk ini sudah habis.");
            return;
        }

        if (qty > stok) {
            alert("Jumlah yang kamu inginkan melebihi stok!");
            disableButtons(true);
        } else {
            disableButtons(false);
        }

        inputQtys.forEach(el => el.value = qty);
    }

    function disableButtons(disabled) {
        [addToCartBtn, buyNowBtn].forEach(btn => {
            btn.disabled = disabled;
            btn.classList.toggle('opacity-50', disabled);
            btn.classList.toggle('cursor-not-allowed', disabled);
        });
    }

    function decreaseQty() {
        let currentQty = parseInt(qtyDisplay.textContent);
        if (currentQty > 1) {
            currentQty--;
            qtyDisplay.textContent = currentQty;
            updateButtons(currentQty);
        }
    }

    function increaseQty() {
        let currentQty = parseInt(qtyDisplay.textContent);
        currentQty++;
        qtyDisplay.textContent = currentQty;
        updateButtons(currentQty);
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (stok === 0) {
            showModal();
            disableButtons(true);
            qtyDisplay.textContent = "0";
            inputQtys.forEach(el => el.value = 0);
        } else {
            updateButtons(parseInt(qtyDisplay.textContent));
        }
    });

    function showModal() {
        document.getElementById("stokHabisModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("stokHabisModal").classList.add("hidden");
    }
</script>

<style>
    .cursor-not-allowed {
        cursor: not-allowed;
    }
    .opacity-50 {
        opacity: 0.5;
    }
</style>

@endsection
