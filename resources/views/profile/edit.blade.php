@extends('layouts.without-banner')

@section('content')
<div class="max-w-xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">✏️ Edit Profil</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded-lg p-6">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="mt-1 w-full p-2 border border-gray-300 rounded-md bg-gray-50 focus:outline-none focus:ring-orange-500 focus:border-orange-500 text-sm"
                required>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email (readonly) -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="mt-1 w-full p-2 border border-gray-200 rounded-md bg-gray-100 text-sm">
        </div>

        <!-- Foto Profil -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
            <input type="file" name="photo" accept="image/*"
                class="mt-1 w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500">
            
            @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-md text-sm font-medium transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
