@extends('layouts.welcome')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- Sidebar Filter --}}
        <aside class="lg:w-1/4 w-full bg-white border rounded-lg p-6 shadow-md">
            <form method="GET" action="{{ route('phones.see-all') }}" class="space-y-6">

                {{-- Search Input --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🔍 Pencarian</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari tipe atau deskripsi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                {{-- Status Stok Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">📦 Status Stok</label>
                    <div class="flex flex-col space-y-2 text-sm text-gray-600">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status_stok" value="1" {{ request('status_stok') === '1' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">Tersedia</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status_stok" value="0" {{ request('status_stok') === '0' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">Habis</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status_stok" value="" {{ request('status_stok') === null ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">Semua</span>
                        </label>
                    </div>
                </div>

                {{-- Brand Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">🏷️ Merk</label>
                    <select name="brand_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">Semua Merk</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Button --}}
                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md font-semibold transition">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </aside>

        {{-- Main Content --}}
        <section class="lg:w-3/4 w-full">
            <h2 class="text-xl font-bold mb-4">Daftar Produk</h2>
            @if ($phones->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($phones as $phone)
                        <div class="border p-4 rounded-lg shadow-sm hover:shadow-md transition">
                            <img src="{{ asset('storage/' . $phone->gambar) }}" alt="{{ $phone->tipe }}" class="object-cover w-full h-48 mb-3">
                            <div class="p-3">
                                <p class="text-xs text-gray-400 mb-1">{{ $phone->tipe }}</p>
                                <h3 class="text-sm font-semibold leading-tight mb-1">{{ Str::limit($phone->deskripsi, 50) }}</h3>
                                <p class="text-black font-bold mb-1">Harga: Rp{{ number_format($phone->harga, 0, ',', '.') }}</p>
                                <p class="text-orange-600 font-bold mb-1">Stok: {{ $phone->stok }}</p>
                                <div class="text-xs text-gray-500">Status: {{ $phone->status_stok ? 'Tersedia' : 'Habis' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $phones->withQueryString()->links() }}
                </div>
            @else
                <p class="text-gray-500">Tidak ada data yang cocok dengan filter pencarian.</p>
            @endif
        </section>
    </div>
</div>
@endsection
