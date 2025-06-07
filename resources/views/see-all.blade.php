@extends('layouts.welcome')

@section('content')
<div class="container mx-auto px-2 py-6">
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- Sidebar Filter --}}
        <aside class="lg:w-1/4 w-full bg-white border border-gray-200 rounded-lg p-6 shadow-sm self-start">
            <form method="GET" action="{{ route('phones.see-all') }}" class="space-y-6">
                
                {{-- Filter Title --}}
                <div>
                    <div class="flex items-center text-md font-semibold text-gray-700 mb-2 space-x-2">
                        <p>Filter Pencarian</p>
                    </div>
                </div>

                {{-- Status Stok Filter --}}
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2 space-x-2">
                        <span>📦</span>
                        <span>Status Stok</span>
                    </label>
                    @php $status = request('status_stok'); @endphp
                    <div class="flex flex-col space-y-2 text-sm text-gray-600 pl-1">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="status_stok" value="1" {{ $status === '1' ? 'checked' : '' }} class="text-orange-500 focus:ring-orange-500">
                            <span>Tersedia</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="status_stok" value="0" {{ $status === '0' ? 'checked' : '' }} class="text-orange-500 focus:ring-orange-500">
                            <span>Habis</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="status_stok" value="all" {{ $status === 'all' ? 'checked' : '' }} class="text-orange-500 focus:ring-orange-500">
                            <span>Semua</span>
                        </label>
                    </div>
                </div>

                {{-- Brand Filter --}}
                <div>
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-2 space-x-2">
                        <span>🏷️</span>
                        <span>Merk</span>
                    </label>
                    <select name="brand_id" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Semua Merk</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Button --}}
                <div>
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-md font-semibold text-sm transition">
                        🔎 Terapkan Filter
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
                        <div onclick="window.location='{{ route('phones.show', $phone->id) }}'" 
                            class="border p-4 rounded-lg shadow-sm hover:shadow-md transition cursor-pointer">
                            
                            <img src="{{ asset('storage/' . $phone->gambar) }}" 
                                alt="{{ $phone->tipe }}" 
                                class="object-cover w-full h-48 mb-3 rounded" loading="lazy">

                            <div class="p-3">
                                <p class="text-xs text-gray-400 mb-1">
                                    {{ $phone->brand->brand }} <span>{{ $phone->tipe }}</span>
                                </p>

                                <h3 class="text-sm font-semibold leading-tight mb-1">
                                    {{ Str::limit(strip_tags($phone->deskripsi), 50) }}
                                </h3>

                                <p class="text-black font-bold mb-1">
                                    Harga: Rp{{ number_format($phone->harga, 0, ',', '.') }}
                                </p>

                                <p class="text-orange-600 font-bold mb-1">
                                    Stok: {{ $phone->stok }}
                                </p>

                                <div class="text-xs text-gray-500">
                                    Status: {{ $phone->status_stok ? 'Tersedia' : 'Habis' }}
                                </div>
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
