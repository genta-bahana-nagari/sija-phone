@extends('layouts.without-banner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-semibold mb-6">Riwayat Pesanan</h2>

    @if($orders->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-md">
            Tidak ada pesanan.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-md shadow-md bg-white">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Produk</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Jumlah</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Harga (Satuan)</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Metode Pembayaran</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Pengiriman</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Ongkos Kirim</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Total Bayar</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Status</th>
                        <th class="px-4 py-2 text-left border-b whitespace-nowrap">Waktu Pesan</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-800">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-2 border-b whitespace-nowrap">
                                {{ $order->phone->brand->nama ?? '-' }} - {{ $order->phone->nama }}
                            </td>
                            <td class="px-4 py-2 border-b whitespace-nowrap">{{ $order->jumlah_order }}</td>
                            <td class="px-4 py-2 border-b whitespace-nowrap">
                                Rp {{ number_format($order->phone->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 border-b whitespace-nowrap">{{ $order->paymentType->tipe_pembayaran ?? '-' }}</td>
                            <td class="px-4 py-2 border-b whitespace-nowrap">{{ $order->shippingType->tipe_pengiriman ?? '-' }}</td>
                            <td class="px-4 py-2 border-b whitespace-nowrap">
                                Rp {{ number_format($order->shippingType->ongkos, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 border-b whitespace-nowrap font-semibold text-green-600">
                                Rp {{ number_format($order->harga_total, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 border-b whitespace-nowrap capitalize">
                                <span class="
                                    px-2 py-1 rounded-full text-xs font-medium
                                    {{ match($order->status_pesanan) {
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'diproses' => 'bg-blue-100 text-blue-700',
                                        'selesai' => 'bg-green-100 text-green-700',
                                        'dibatalkan' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    } }}
                                ">
                                    {{ $order->status_pesanan }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border-b whitespace-nowrap">
                                {{ $order->created_at->format('d-m-Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
