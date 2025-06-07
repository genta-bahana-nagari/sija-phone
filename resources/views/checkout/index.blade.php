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

            {{-- Hidden inputs untuk harga --}}
            <input type="hidden" id="harga-{{ $index }}" value="{{ $phone->harga }}">
        @endforeach

        <hr class="my-4">

        <div class="items-center mb-4">
            <p class="text-md font-semibold">Deskripsi Produk</p>
            @foreach ($phones as $index => $phone)
                <div class="mb-2">
                    <p class="text-sm font-semibold">{{ $phone->brand->brand }} {{ $phone->tipe }}</p>
                    <p class="text-sm text-justify text-gray-600">{{ $phone->deskripsi }}</p>
                </div>
            @endforeach
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

            <div>
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <input type="text" name="alamat" class="w-full border px-4 py-2 rounded text-sm" required value="Jl. Lorem Ipsum, Dolor Sit, Amet, Jakarta">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">No. Kontak</label>
                <input type="text" name="kontak" class="w-full border px-4 py-2 rounded text-sm" required value="081234567890">
            </div>

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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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
        const form = document.querySelector('form');

        shippingSelect.addEventListener('change', function () {
            updateTotal();
        });

        form.addEventListener('submit', function (e) {
            const shipping = document.getElementById('shipping_type_id');
            const payment = document.getElementById('payment_method');
            if (!shipping.value || !payment.value) {
                alert('Harap pilih pengiriman dan metode pembayaran.');
                e.preventDefault();
            }
        });

        updateTotal(); // Initial calculation
    });

    function updateQuantity(index, change) {
        const qtyInput = document.getElementById('qty-' + index);
        let qty = parseInt(qtyInput.value) + change;
        if (qty < 1) qty = 1;

        qtyInput.value = qty;
        const hiddenQty = document.getElementById('hidden-qty-' + index);
        if (hiddenQty) hiddenQty.value = qty;

        updateSubtotal(index, qty);
        updateTotal();
    }

    function updateSubtotal(index, qty) {
        const phonePrice = parseFloat(document.getElementById('harga-' + index).value);
        const subtotal = phonePrice * qty;
        document.getElementById('subtotal-' + index).textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    }

    function updateTotal() {
        let totalProduk = 0;
        @foreach ($phones as $index => $phone)
            const qty = parseInt(document.getElementById('qty-{{ $index }}').value);
            const harga = parseFloat(document.getElementById('harga-{{ $index }}').value);
            totalProduk += harga * qty;
        @endforeach

        const selected = document.getElementById('shipping_type_id').selectedOptions[0];
        const ongkir = selected ? parseFloat(selected.getAttribute('data-ongkir')) : 0;
        const total = totalProduk + ongkir;

        document.getElementById('subtotal-display').textContent = 'Rp ' + totalProduk.toLocaleString('id-ID');
        document.getElementById('total-display').textContent = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('total-final').value = total;
        document.getElementById('ongkir-display').innerHTML = 'Ongkos Kirim: <span class="float-right">Rp ' + ongkir.toLocaleString('id-ID') + '</span>';
    }
</script>
@endsection
