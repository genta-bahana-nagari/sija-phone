@extends('layouts.without-banner')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">👤 Profil Saya</h1>
    @if(session('success'))
        <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-6 space-y-4 md:space-y-0">
            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="w-28 h-28 rounded-full object-cover">
            @else
                <div class="w-28 h-28 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 text-3xl font-bold border-2 border-orange-500">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                <p class="text-gray-500 text-sm mt-1">Bergabung sejak: {{ $user->created_at->translatedFormat('d F Y') }}</p>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('profile.edit') }}"
                       class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded transition">
                        ✏️ Edit Profil
                    </a>
                    <a href="{{ route('profile.password') }}"
                       class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded transition">
                        🔓 Ganti Password
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-6">

        <!-- Info Tambahan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">📦 Aktivitas</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <!-- Dynamic Order Count -->
                    @php
                        // Assuming 'auth()->user()' gives the currently logged-in user
                        $totalOrders = auth()->user()->orders->count();
                        $activeOrders = auth()->user()->orders->where('status_pesanan', '!=', 'selesai')->count();
                    @endphp
                    <li>Total pesanan: <span class="font-medium text-gray-800">{{ $totalOrders }}</span></li>
                    <li>Pesanan aktif: <span class="font-medium text-gray-800">{{ $activeOrders }}</span></li>
                    <li>Ulasan produk: <span class="font-medium text-gray-800">Tidak pernah review</span></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">⚙️ Pengaturan Akun</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>Status akun: <span class="inline-block px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded">Aktif</span></li>
                    <li>Email Terverifikasi: <span class="text-gray-800">Ya</span></li>
                    <li>2FA: <span class="text-gray-800">Tidak Aktif</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
