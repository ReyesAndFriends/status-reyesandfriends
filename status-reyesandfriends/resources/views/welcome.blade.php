<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="w-full max-w-3xl text-center">
            <h1 class="text-4xl lg:text-5xl font-semibold mb-6 dark:text-[#FDFDFC]">Welcome to {{ config('app.name', 'Laravel') }}</h1>
            <p class="text-lg lg:text-xl mb-8 dark:text-[#FDFDFC]">Your application is successfully set up and ready to go!</p>
        </div>
    </body>
</html>
