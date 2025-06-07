@extends('layouts.without-banner')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold mb-8 text-gray-900 border-b pb-4">Detail Pesanan</h2>

    <div class="bg-white shadow-lg rounded-lg p-8 space-y-6">

        {{-- Header Invoice & Status --}}
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-700 text-lg font-semibold">Invoice: <span class="font-normal">INV/{{ $order->id }}</span></p>
                <p class="text-gray-500 text-sm">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                    {{ match($order->status_pesanan) {
                        'pending' => 'bg-gray-100 text-orange-700',
                        'diproses' => 'bg-yellow-200 text-yellow-600',
                        'selesai' => 'bg-green-300 text-green-900',
                        'dibatalkan' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    } }}">
                    {{ ucfirst($order->status_pesanan) }}
                </span>
            </div>
        </div>

        {{-- Produk --}}
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 border rounded-md p-4 shadow-sm">
            <img src="{{ asset('storage/' . $order->phone->gambar) }}" class="w-48 h-48 object-cover rounded-md border" alt="Produk">

            <div class="flex-1">
                <h3 class="text-xl font-semibold text-gray-800">
                    {{ $order->phone->brand->brand ?? '-' }} {{ $order->phone->tipe ?? '-' }}
                </h3>
                <p class="text-gray-600 mt-2">
                    {{ $order->jumlah_order }} barang &times; Rp {{ number_format($order->phone->harga, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Detail Alamat & Pembayaran --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-700">
            <div>
                <h4 class="font-semibold mb-2">Alamat Pengiriman</h4>
                <p class="whitespace-pre-line">{{ $order->alamat }}</p>

                <h4 class="font-semibold mt-4 mb-2">Kontak</h4>
                <p>{{ $order->kontak }}</p>
            </div>

            <div>
                <h4 class="font-semibold mb-2">Metode Pembayaran</h4>
                <p>{{ $order->paymentType->tipe_pembayaran ?? '-' }}</p>

                <h4 class="font-semibold mt-4 mb-2">Pengiriman</h4>
                <p>
                    {{ $order->shippingType->tipe_pengiriman ?? '-' }}<br>
                    Ongkos kirim: Rp {{ number_format($order->shippingType->ongkos, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Total Bayar --}}
        <div class="border-t pt-6 flex justify-between items-center">
            <div>
                <p class="text-gray-600 text-lg">Total Bayar:</p>
                <p class="text-3xl font-extrabold text-orange-600">Rp {{ number_format($order->harga_total, 0, ',', '.') }}</p>
            </div>

            @if($order->status_pesanan !== 'dibatalkan' && $order->status_pesanan !== 'selesai' && $order->status_pesanan !== 'diproses')
                {{-- Form Batalkan Pesanan --}}
                <form id="cancelOrderForm" action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status_pesanan" value="dibatalkan">

                    <button 
                        type="button"
                        onclick="confirmCancel()"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md shadow-md transition duration-200">
                        Batalkan Pesanan
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmCancel() {
        if (confirm('Apa kamu yakin ingin membatalkan pesanan ini?')) {
            document.getElementById('cancelOrderForm').submit();
        }
    }
</script>
@endsection
