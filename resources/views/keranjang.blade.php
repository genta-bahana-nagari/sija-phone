@extends('layouts.without-banner')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Keranjang Belanja</h2>

    @if(session('success'))
        <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="bg-green-100 text-green-800 px-4 py-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="bg-orange-100 text-orange-800 px-4 py-3 rounded-md">
            Keranjang Anda kosong.
        </div>
    @else
        @foreach ($cartItems as $item)
        <div class="bg-white rounded-lg border shadow p-4 mb-6">
            <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                <div class="flex items-center gap-2">
                    <span class="font-semibold">Ditambahkan:</span>
                    <span>{{ $item->created_at->format('d M Y, H:i') }}</span>
                </div>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline text-sm font-medium">
                        Hapus
                    </button>
                </form>
            </div>

            <div class="flex items-start gap-4 border-t pt-4">
                <img src="{{ asset('storage/' . $item->phone->gambar) }}" alt="Produk" class="w-16 h-16 object-cover rounded-md border">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-800 mb-1">
                        {{ $item->phone->brand->brand ?? '-' }} {{ $item->phone->tipe ?? '-' }}
                    </div>
                    <div class="text-sm text-gray-600">{{ $item->jumlah }} barang x Rp {{ number_format($item->phone->harga, 0, ',', '.') }}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Subtotal</div>
                    <div class="text-base font-semibold text-gray-800">Rp {{ number_format($item->jumlah * $item->phone->harga, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Total dan Tombol Checkout --}}
        <div class="bg-gray-100 p-4 rounded-lg shadow mt-6 flex justify-between items-center">
            <div class="text-lg font-semibold text-gray-800">
                Total: Rp {{ number_format($cartItems->sum(fn($item) => $item->jumlah * $item->phone->harga), 0, ',', '.') }}
            </div>
            <form action="{{ route('checkout.cart') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Checkout Sekarang</button>
            </form>
        </div>
    @endif
</div>
@endsection