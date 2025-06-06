@extends('layouts.without-banner')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Ganti Password</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.password.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="password" class="block font-semibold">Password Baru</label>
            <input type="password" name="password" id="password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded">
            Simpan Password
        </button>
    </form>
</div>
@endsection
