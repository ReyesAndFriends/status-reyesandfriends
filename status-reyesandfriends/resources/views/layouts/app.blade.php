<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#FDFDFC] flex flex-col min-h-screen">

        <header class="flex items-center justify-between mx-auto w-full max-w-5xl py-8 px-8">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="/reyesandfriends-black.svg" alt="Reyes&Friends logo" class="h-10 w-auto mr-3 block dark:hidden">
                <img src="/reyesandfriends-white.svg" alt="Reyes&Friends logo" class="h-10 w-auto mr-3 hidden dark:block">
            </a>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 cursor-pointer">Logout</button>
                </form>
            @endauth
        </header>
        
        <hr class="border-t border-gray-200 dark:border-zinc-700 my-6 w-full max-w-5xl mx-auto">

        <main class="flex flex-col items-center flex-1 w-full px-4">
            @yield('content')
        </main>
        <footer class="w-full bg-zinc-900 text-gray-300 text-center py-2 text-sm mt-8">
            © {{ date('Y') }} Reyes&Friends. Todos los derechos reservados.
        </footer>
    </body>
</html>
