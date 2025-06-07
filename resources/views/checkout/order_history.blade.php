@extends('layouts.without-banner')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Riwayat Pesanan</h2>
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
    @if($orders->isEmpty())
        <div class="bg-orange-100 text-orange-800 px-4 py-3 rounded-md">
            Tidak ada pesanan.
        </div>
    @else
        @foreach ($orders as $order)
        <div class="bg-white rounded-lg border shadow p-4 mb-6">
            <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                <div class="flex items-center gap-2">
                    <span class="font-semibold">Belanja</span>
                    <span>{{ $order->created_at->format('d M Y') }}</span>
                    <span class="font-semibold px-2 py-1 rounded text-xs capitalize
                    {{ match($order->status_pesanan) {
                        'pending' => 'bg-gray-100 text-orange-700',
                        'diproses' => 'bg-yellow-200 text-yellow-600',
                        'selesai' => 'bg-green-300 text-green-900',
                        'dibatalkan' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    } }}
                    ">
                        {{ ucfirst($order->status_pesanan) }}
                    </span>
                    <span class="text-xs">{{ 'INV/' . $order->id }}</span> <!-- Example of concatenating 'INV/' with order ID -->
                    <span>{{ $order->created_at->format('d M Y') }}</span>
                </div>
                <div class="text-xs text-right">
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                        Batal Otomatis: {{ $order->created_at->addDays(5)->format('d M') }} {{ $order->created_at->format('H:i') }}
                    </span>
                </div>
            </div>

            <div class="flex items-start gap-4 border-t pt-4">
                <img src="{{ asset('storage/' . $order->phone->gambar) }}" alt="Produk" class="w-16 h-16 object-cover rounded-md border">
                <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-800 mb-1">
                        {{ $order->phone->brand->brand ?? '-' }} {{ $order->phone->tipe ?? '-' }}
                    </div>
                    <div class="text-sm text-gray-600">{{ $order->jumlah_order }} barang x Rp {{ number_format($order->phone->harga, 0, ',', '.') }}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Total Belanja</div>
                    <div class="text-base font-semibold text-gray-800">Rp {{ number_format($order->harga_total, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ route('orders.show', $order->id) }}"
                   class="text-green-600 hover:underline font-medium text-sm">
                    Lihat Detail Transaksi
                </a>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
