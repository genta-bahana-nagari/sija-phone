@extends('layouts.auth')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

@foreach ($errors->all() as $error)
    <div class="mb-2 text-sm text-red-600">
        {{ $error }}
    </div>
@endforeach


<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" name="email" id="email" class="w-full mt-1 p-2 border rounded" required autofocus value="{{ old('email') }}">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" name="password" id="password" class="w-full mt-1 p-2 border rounded" required>
    </div>

    <div class="flex items-center justify-between mb-4">
        <a href="{{ route('register') }}" class="text-sm text-blue-500 hover:underline">Belum punya akun?</a>
    </div>

    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
        Login
    </button>
</form>
@endsection
