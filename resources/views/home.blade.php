@extends('layouts.welcome')

@section('content')
<div class="bg-white font-sans">
    <!-- Recomendation -->
    <section class="mt-6 mx-6">
        <div class="flex items-center gap-4 mb-4 text-sm md:text-lg font-semibold">
            <h2>Berdasarkan preferensimu</h2>
            <a href="{{ route('phones.see-all') }}" class="text-blue-500 hover:underline transition-all duration-200">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-5 md:grid-cols-4 gap-4">
            @foreach ($phonesForRecommendation as $phone)
            <div onclick="window.location='/phones/{{ $phone->id }}'" class="border p-4 rounded-lg shadow-sm hover:shadow-md transition cursor-pointer">
                <img src="{{ asset('storage/' . $phone->gambar) }}" alt="{{ $phone->tipe }}" class="object-cover w-full h-48 mb-3">
                <div class="p-3">
                    <p class="text-xs text-gray-400 mb-1">{{ $phone->brand->brand }}
                        <span>{{ $phone->tipe }}</span>
                    </p>
                    <h3 class="text-sm font-semibold leading-tight mb-1">{{ Str::limit($phone->deskripsi, 50) }}</h3>
                    <p class="text-black font-bold mb-1">Harga: Rp{{ number_format($phone->harga, 0, ',', '.') }}</p>
                    <p class="text-orange-600 font-bold mb-1">Stok: {{ $phone->stok }}</p>
                    <div class="text-xs text-gray-500">Status: {{ $phone->status_stok ? 'Tersedia' : 'Habis' }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Products and Brands -->
    <section class="px-6 py-8">
        <!-- Brand button -->
        <div class="flex items-center justify-center mb-6">
            <div class="flex flex-wrap gap-6 items-center">
                <!-- Brand buttons -->
                <button class="flex items-center gap-4 px-6 py-3 text-white font-semibold rounded-md bg-gradient-to-r from-red-500 to-red-900 text-lg">
                    Huawei
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Huawei_Standard_logo.svg/1008px-Huawei_Standard_logo.svg.png" alt="Huawei Logo" class="h-7" />
                </button>
                <button class="flex items-center gap-4 px-6 py-3 text-white font-semibold rounded-md bg-gradient-to-r from-gray-900 to-gray-300 text-lg">
                    Apple
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple Logo" class="h-7" />
                </button>
                <button class="flex items-center gap-4 px-6 py-3 text-white font-semibold rounded-md bg-gradient-to-r from-blue-700 to-blue-500 text-lg">
                    Samsung
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Samsung_Logo.svg/2560px-Samsung_Logo.svg.png" alt="Samsung Logo" class="h-7" />
                </button>
                <button class="flex items-center gap-4 px-6 py-3 text-white font-semibold rounded-md bg-gradient-to-r from-green-700 to-green-300 text-lg">
                    Infinix
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Infinix_logo.svg/512px-Infinix_logo.svg.png" alt="Infinix Logo" class="h-7" />
                </button>

                <!-- Lihat Semua -->
                <a href="{{ route('phones.see-all') }}" class="text-blue-700 text-lg align-bottom ml-6">Lihat Semua</a>
            </div>
        </div>

        <!-- Produk Based on Brands -->
        <div class="grid grid-cols-2 lg:grid-cols-5 md:grid-cols-4 gap-4" id="product-list">
            @foreach ($phonesForBrands as $phone)
            <div onclick="window.location='/phones/{{ $phone->id }}'" class="border p-4 rounded-lg shadow-sm hover:shadow-md transition cursor-pointer">
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

        <!-- Button Load More -->
        <div class="mt-8 flex justify-center">
            <button id="load-more-btn" class="px-6 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
                Muat Lebih Banyak
            </button>
        </div>
    </section>

    <!-- Temukan Smartphone Impianmu -->
    <section class="mt-6 mx-6 rounded-lg p-8">
        <div class="flex flex-col items-center text-center">
            <h1 class="text-3xl font-bold text-orange-400 mb-4">
                Temukan Smartphone Impianmu!
            </h1>
            <p class="text-xl text-gray-700 mb-6">
                Dapatkan penawaran terbaik dan temukan gadget yang sesuai dengan kebutuhanmu. Mulai belanja sekarang!
            </p>
            <div class="flex justify-center gap-6 mb-6">
                <a href="{{ route('phones.see-all') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition duration-300">
                    Belanja Sekarang
                </a>
                <a href="{{ route('phones.see-all') }}" class="px-6 py-3 bg-transparent border-2 border-blue-600 text-blue-600 rounded-md font-semibold hover:bg-blue-600 hover:text-white transition duration-300">
                    Lihat Semua Produk
                </a>
            </div>
            <div class="w-full h-60 overflow-hidden rounded-md shadow-lg mb-6">
                <img src="https://asset.kompas.com/crops/Bc4cUnHRyfjn607g4pww-bXfEIE=/127x0:1140x675/1200x800/data/photo/2021/03/02/603e0132c9e89.jpg" 
                    alt="Smartphone Collection" 
                    class="w-full h-full object-cover object-center" />
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('load-more-btn').addEventListener('click', function () {
        fetch('/load-more', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            let productList = document.getElementById('product-list');
            data.forEach(phone => {
                let productHTML = `
                    <div onclick="window.location='/phones/${phone.id}'" class="border p-4 rounded-lg shadow-sm hover:shadow-md transition cursor-pointer">
                        <img src="/storage/${phone.gambar}" alt="${phone.tipe}" class="object-cover w-full h-48 mb-3">
                        <div class="p-3">
                            <p class="text-xs text-gray-400 mb-1">${phone.tipe}</p>
                            <h3 class="text-sm font-semibold leading-tight mb-1">${phone.deskripsi.slice(0, 50)}</h3>
                            <p class="text-black font-bold mb-1">Harga: Rp${new Intl.NumberFormat('id-ID').format(phone.harga)}</p>
                            <p class="text-orange-600 font-bold mb-1">Stok: ${phone.stok}</p>
                            <div class="text-xs text-gray-500">Status: ${phone.status_stok ? 'Tersedia' : 'Habis'}</div>
                        </div>
                    </div>
                `;
                productList.insertAdjacentHTML('beforeend', productHTML);
            });
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection
