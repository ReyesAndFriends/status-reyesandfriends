@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full bg-white dark:bg-zinc-900 rounded shadow p-8 max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-zinc-900 dark:text-zinc-100">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-zinc-700 dark:text-zinc-300 mb-2" for="email">Email</label>
                <input class="w-full px-3 py-2 border rounded bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 border-zinc-300 dark:border-zinc-700" type="email" name="email" required autofocus placeholder="Enter your email">
                @error('email')
                    <span class="text-red-500 dark:text-red-400 text-sm break-words whitespace-normal max-w-full block">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-zinc-700 dark:text-zinc-300 mb-2" for="password">Password</label>
                <input class="w-full px-3 py-2 border rounded bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 border-zinc-300 dark:border-zinc-700" type="password" name="password" required placeholder="Enter your password">
                @error('password')
                    <span class="text-red-500 dark:text-red-400 text-sm break-words whitespace-normal max-w-full block">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-green-600 dark:bg-green-700 text-white py-2 rounded hover:bg-green-700 dark:hover:bg-green-800 cursor-pointer">Login</button>
        </form>
    </div>
</div>
@endsection
