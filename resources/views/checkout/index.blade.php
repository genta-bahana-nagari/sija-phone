@extends('layouts.without-banner')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <a href="{{ url()->previous() }}" class="text-gray-500 text-sm mb-4 inline-block hover:underline">← Kembali</a>
    
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>

    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Alamat Pengiriman --}}
        <div>
            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="w-full border px-4 py-2 rounded text-sm" required value="Jl. Lorem Ipsum, Dolor Sit, Amet, Jakarta">
        </div>

        {{-- Kontak --}}
        <div>
            <label for="kontak" class="block text-sm font-semibold text-gray-700 mb-1">No. Kontak</label>
            <input type="text" name="kontak" id="kontak" class="w-full border px-4 py-2 rounded text-sm" required value="081234567890">
        </div>

        {{-- Produk --}}
        <div class="bg-gray-50 p-4 rounded-lg border">
            <h3 class="font-semibold text-sm mb-3">Produk yang Dibeli</h3>
            @php
                $totalProduk = 0;
            @endphp
            @foreach ($phones as $index => $phone)
                @php
                    $subtotal = $phone->harga * $quantities[$index];
                    $totalProduk += $subtotal;
                @endphp
                <div class="mb-2 flex justify-between">
                    <input type="hidden" name="phone_ids[]" value="{{ $phone->id }}">
                    <input type="hidden" name="quantities[]" value="{{ $quantities[$index] }}">
                    <p class="text-sm">{{ $quantities[$index] }}x {{ $phone->brand->brand }} {{ $phone->tipe }} - Rp{{ number_format($phone->harga, 0, ',', '.') }}</p>
                    <p class="text-sm">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        {{-- Total Produk --}}
        <input type="hidden" id="total-produk" value="{{ $totalProduk }}">
        <input type="hidden" name="total" id="total-final" value="{{ $totalProduk }}">

        {{-- Opsi Pengiriman --}}
        <div>
            <label for="shipping_type_id" class="block text-sm font-semibold text-gray-700 mb-1">Opsi Pengiriman</label>
            <select name="shipping_type_id" id="shipping_type_id" class="w-full border px-4 py-2 rounded text-sm" required>
                <option disabled selected value="">Pilih Pengiriman</option>
                @foreach ($shippingTypes as $shipping)
                    <option value="{{ $shipping->id }}" data-ongkir="{{ $shipping->ongkos }}">
                        {{ $shipping->tipe_pengiriman }} - Rp{{ number_format($shipping->ongkos, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Total --}}
        <div class="text-right mt-4">
            <p class="text-sm text-gray-500">Total Harga (termasuk ongkir)</p>
            <p class="text-xl font-bold text-black" id="total-display">Rp {{ number_format($totalProduk, 0, ',', '.') }}</p>
            <p id="ongkir-display" class="text-sm text-gray-500"></p> {{-- Menampilkan ongkir --}}
        </div>

        {{-- Submit --}}
        <div class="text-right">
            <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">
                Bayar Sekarang
            </button>
        </div>
    </form>
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
            const selectedOption = this.options[this.selectedIndex];
            const ongkir = parseFloat(selectedOption.getAttribute('data-ongkir')) || 0;
            const total = totalProduk + ongkir;

            // Menampilkan Total Harga
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            totalHidden.value = total;
        });
    });
</script>
@endsection
