@extends('layouts.auth')

@section('content')
<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
    Buat Akun Baru
</h1>

@foreach ($errors->all() as $error)
    <div class="text-sm text-red-600 bg-red-100 px-4 py-2 rounded">{{ $error }}</div>
@endforeach

<form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label for="name" class="block mb-2 text-sm font-medium">Nama Lengkap</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    <div>
        <label for="email" class="block mb-2 text-sm font-medium">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    <div>
        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
        <input type="password" name="password" id="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    <div>
        <label for="password_confirmation" class="block mb-2 text-sm font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    <button type="submit"
        class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Daftar Sekarang
    </button>

    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-400">Masuk di sini</a>
    </p>
</form>
@endsection
