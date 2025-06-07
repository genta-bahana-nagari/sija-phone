@extends('layouts.without-banner')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- Judul Halaman --}}
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Keranjang Belanja</h2>

    {{-- Menampilkan Pesan Sukses --}}
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

    {{-- Menampilkan Pesan Keranjang Kosong --}}
    @if($cartItems->isEmpty())
        <div class="bg-orange-100 text-orange-800 px-4 py-3 rounded-md">
            Keranjang Anda kosong.
        </div>
    @else
        {{-- Form Checkout Terpilih --}}
        <form action="{{ route('cart.checkout.selected') }}" method="POST" id="checkout-form">
            @csrf

            {{-- Menampilkan Daftar Item di Keranjang --}}
            @foreach ($cartItems as $index => $item)
            <div class="bg-white rounded-lg border shadow p-4 mb-6">
                <div class="flex justify-between items-center text-sm text-gray-600 mb-2">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">Ditambahkan:</span>
                        <span>{{ $item->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 border-t pt-4">
                    {{-- Checkbox untuk Memilih Item --}}
                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" id="item-{{ $index }}" class="mt-1" onchange="updateCheckoutLink()">
                    
                    {{-- Gambar Produk --}}
                    <img src="{{ asset('storage/' . $item->phone->gambar) }}" alt="Produk" class="w-16 h-16 object-cover rounded-md border">
                    
                    {{-- Detail Produk --}}
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-gray-800 mb-1">
                            {{ $item->phone->brand->brand ?? '-' }} {{ $item->phone->tipe ?? '-' }}
                        </div>
                        <div class="text-sm text-gray-600">
                            {{ $item->jumlah }} barang x Rp {{ number_format($item->phone->harga, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    {{-- Subtotal Produk --}}
                    <div class="text-right">
                        <div class="text-sm text-gray-600">Subtotal</div>
                        <div class="text-base font-semibold text-gray-800">
                            Rp {{ number_format($item->jumlah * $item->phone->harga, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Tombol Checkout Terpilih --}}
            <div class="bg-gray-100 p-4 rounded-lg shadow mt-6 flex justify-between items-center">
                <div class="text-lg font-semibold text-gray-800">
                    Total: Rp <span id="total-price">0</span>
                </div>
                <button type="submit" id="checkout-btn" class="text-white px-4 py-2 rounded-full cursor-pointer bg-orange-400 hover:bg-orange-600" disabled>
                    Checkout
                </button>
            </div>
        </form>
    @endif
</div>

<script>
    // Fungsi untuk memeriksa checkbox yang dipilih dan menghitung total
    function updateCheckoutLink() {
        const checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
        const checkoutBtn = document.getElementById('checkout-btn');
        const totalPriceElement = document.getElementById('total-price');
        let totalPrice = 0;

        // Hitung total harga berdasarkan item yang terpilih
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const itemRow = checkbox.closest('.flex');
                
                // Mengambil subtotal produk yang dipilih dan menghapus format Rp dan titik
                const itemSubtotalText = itemRow.querySelector('.text-base.font-semibold.text-gray-800').textContent;
                
                // Menghilangkan 'Rp' dan titik untuk mendapatkan angka murni
                const itemSubtotal = parseInt(itemSubtotalText.replace('Rp ', '').replace(/\./g, '').trim());
                
                // Menambahkan harga subtotal ke totalPrice
                totalPrice += itemSubtotal;
            }
        });

        // Update harga total di elemen
        totalPriceElement.textContent = totalPrice.toLocaleString('id-ID');

        // Atur status tombol Checkout
        if (totalPrice === 0) {
            checkoutBtn.disabled = true;
            checkoutBtn.textContent = 'Pilih produk untuk checkout!';
        } else {
            checkoutBtn.disabled = false;
            checkoutBtn.textContent = 'Checkout Terpilih';
        }
    }

    // Memanggil fungsi awal untuk mengatur tombol saat halaman dimuat
    window.onload = updateCheckoutLink;
</script>

@endsection
