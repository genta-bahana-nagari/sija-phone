@extends('layouts.auth')

@section('content')
<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
    Masuk ke akun Anda
</h1>

@foreach ($errors->all() as $error)
    <div class="text-sm text-red-600 bg-red-100 px-4 py-2 rounded">{{ $error }}</div>
@endforeach

<form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="email" class="block mb-2 text-sm font-medium">Email</label>
        <input type="email" name="email" id="email" placeholder="nama@email.com" value="{{ old('email') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    <div>
        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
    </div>

    <div class="flex items-center justify-between">
        <label for="remember" class="flex items-center text-sm text-gray-500 dark:text-gray-300">
            <input id="remember" type="checkbox" class="mr-2 w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
            Ingat saya
        </label>
        <a href="#" class="text-sm text-primary-600 hover:underline dark:text-primary-400">Lupa password?</a>
    </div>

    <button type="submit"
        class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Masuk
    </button>

    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-400">Daftar sekarang</a>
    </p>
</form>
@endsection
