@extends('layouts.without-banner')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
    {{-- KIRI: Ringkasan Belanja --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4">Shopping Cart</h2>
        @php
            $totalProduk = 0;
        @endphp
        @foreach ($phones as $index => $phone)
            @php
                $subtotal = $phone->harga * $quantities[$index];
                $totalProduk += $subtotal;
            @endphp
            <div class="flex justify-between items-center mb-4" id="cart-item-{{ $index }}">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('storage/' . $phone->gambar) }}" alt="Produk" class="w-16 h-16 object-cover rounded-md border">
                    <div>
                        <p class="text-md font-semibold">{{ $phone->brand->brand }} {{ $phone->tipe }}</p>
                        <div class="flex items-center gap-3">
                            <button type="button" class="text-sm text-gray-500" onclick="updateQuantity({{ $index }}, -1)">-</button>
                            <input type="number" id="qty-{{ $index }}" value="{{ $quantities[$index] }}" min="1" class="w-16 text-center border px-2 py-1 rounded-md" onchange="updateQuantity({{ $index }}, 0)">
                            <button type="button" class="text-sm text-gray-500" onclick="updateQuantity({{ $index }}, 1)">+</button>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Harga per unit: Rp {{ number_format($phone->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                <p class="text-md font-medium" id="subtotal-{{ $index }}">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>
        @endforeach

        <hr class="my-4">

        <div class="items-center mb-4">
            <p class="text-md font-semibold">Deskripsi Produk</p>
            <p class="text-sm text-justify">{{ $phone->deskripsi }}</p>
        </div>

        <hr class="my-4">

        <div class="text-sm text-gray-600 space-y-1">
            <p class="flex justify-between items-center">
                Subtotal: <span class="text-md font-medium" id="subtotal-display">Rp {{ number_format($totalProduk, 0, ',', '.') }}</span>
            </p>
            <p class="flex justify-between items-center" id="ongkir-display">
                Ongkos Kirim: <span class="float-right text-gray-500">-</span>
            </p>
        </div>

        <hr class="my-4">

        <div class="text-lg font-bold text-gray-800">
            TOTAL: <span class="float-right" id="total-display">Rp {{ number_format($totalProduk, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- KANAN: Formulir Checkout --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold mb-4">Checkout</h2>
        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Alamat --}}
            <div>
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <input type="text" name="alamat" class="w-full border px-4 py-2 rounded text-sm" required value="Jl. Lorem Ipsum, Dolor Sit, Amet, Jakarta">
            </div>

            {{-- Kontak --}}
            <div>
                <label class="block text-sm font-medium mb-1">No. Kontak</label>
                <input type="text" name="kontak" class="w-full border px-4 py-2 rounded text-sm" required value="081234567890">
            </div>

            {{-- Opsi Pengiriman --}}
            <div>
                <label class="block text-sm font-medium mb-1">Opsi Pengiriman</label>
                <select name="shipping_type_id" id="shipping_type_id" class="w-full border px-4 py-2 rounded text-sm" required>
                    <option disabled selected value="">Pilih Pengiriman</option>
                    @foreach ($shippingTypes as $shipping)
                        <option value="{{ $shipping->id }}" data-ongkir="{{ $shipping->ongkos }}">
                            {{ $shipping->tipe_pengiriman }} - Rp{{ number_format($shipping->ongkos, 0, ',', '.') }} - {{ $shipping->durasi_hari }} hari
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Metode Pembayaran --}}
            <div>
                <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="w-full border px-4 py-2 rounded text-sm" required>
                    <option disabled selected value="">Pilih Metode Pembayaran</option>
                    @foreach ($paymentTypes as $payment)
                        <option value="{{ $payment->id }}">
                            {{ $payment->tipe_pembayaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Hidden Inputs --}}
            @if(isset($source) && $source === 'cart')
                <input type="hidden" name="source" value="cart">
            @endif

            @foreach ($phones as $index => $phone)
                <input type="hidden" name="phone_ids[]" value="{{ $phone->id }}">
                <input type="hidden" id="hidden-qty-{{ $index }}" name="quantities[]" value="{{ $quantities[$index] }}">
            @endforeach

            <input type="hidden" id="total-produk" value="{{ $totalProduk }}">
            <input type="hidden" name="total" id="total-final" value="{{ $totalProduk }}">

            {{-- Tombol --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3">
                <a href="{{ url()->previous() }}" class="w-full text-center bg-black text-white py-3 rounded-md font-semibold hover:bg-gray-800 transition">
                    Kembali
                </a>
                <button type="submit" class="w-full bg-orange-400 text-white py-3 rounded-md font-semibold hover:bg-gray-800 transition">
                    Beli Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shippingSelect = document.getElementById('shipping_type_id');
        const totalDisplay = document.getElementById('total-display');
        const totalHidden = document.getElementById('total-final');
        const totalProduk = parseFloat(document.getElementById('total-produk').value);
        const ongkirDisplay = document.getElementById('ongkir-display');

        shippingSelect.addEventListener('change', function () {
            updateTotal(); // cukup panggil ini, karena updateTotal akan hitung ulang subtotal dan total
        });
    });

    function updateQuantity(index, change) {
        const qtyInput = document.getElementById('qty-' + index);
        let qty = parseInt(qtyInput.value) + change;

        // Prevent quantity from being less than 1
        if (qty < 1) {
            qty = 1;
        }

        qtyInput.value = qty;
        document.getElementById('hidden-qty-' + index).value = qty; // Update hidden input
        updateSubtotal(index, qty);
        updateTotal();
    }

    function updateSubtotal(index, qty) {
        const phonePrice = {{ $phones[$index]->harga }};
        const subtotal = phonePrice * qty;

        // Update subtotal for the item
        document.getElementById('subtotal-' + index).textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    }

    function updateTotal() {
        let totalProduk = 0;

        @foreach ($phones as $index => $phone)
            const qty = parseInt(document.getElementById('qty-{{ $index }}').value);
            const phonePrice = {{ $phone->harga }};
            totalProduk += phonePrice * qty;
        @endforeach

        const selected = document.getElementById('shipping_type_id').selectedOptions[0];
        const ongkir = selected ? parseFloat(selected.getAttribute('data-ongkir')) : 0;
        const total = totalProduk + ongkir;

        // Update total display
        document.getElementById('total-display').textContent = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('total-final').value = total;

        // Update shipping cost display
        document.getElementById('ongkir-display').innerHTML = 'Ongkos Kirim: <span class="float-right">Rp ' + ongkir.toLocaleString('id-ID') + '</span>';
    }
</script>

@endsection
