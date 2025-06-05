@extends('layouts.welcome')

@section('content')
    <!-- Konten Utama Kita! -->
    <div class="space-y-8">

        <!-- Banner -->
        <div class="rounded overflow-hidden shadow">
            <img src="/images/banner.jpg" alt="Banner" class="w-full h-64 object-cover">
        </div>

        <!-- Rekomendasi Produk -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Berdasarkan preferensimu</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @for($i = 0; $i < 5; $i++)
                    <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
                        <img src="/images/phone{{ $i+1 }}.jpg" alt="Phone {{ $i+1 }}" class="h-40 w-full object-contain mb-2">
                        <h3 class="text-sm font-medium">NextiPhone X 30 PRIME (12/1204)</h3>
                        <p class="text-orange-600 font-bold">Rp25.499.000</p>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Brand Pilihan -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Pilih Brand</h2>
            <div class="flex space-x-4">
                @foreach (['Huawei', 'Apple', 'Samsung', 'Infinix'] as $brand)
                    <button class="px-4 py-2 rounded text-white {{ strtolower($brand) === 'huawei' ? 'bg-red-600' : (strtolower($brand) === 'apple' ? 'bg-gray-800' : (strtolower($brand) === 'samsung' ? 'bg-blue-600' : 'bg-green-600')) }}">
                        {{ $brand }}
                    </button>
                @endforeach
            </div>
        </div>

    </div>
@endsection