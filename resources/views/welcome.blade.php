<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{route('notes.index') }}" class="text-sm text-gray-700  underline">Notes</a>
                    @else
                       <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"><a href="{{ route('login') }}" class="text-sm text-white-700">Log in</a></button>
                        @if (Route::has('register'))
                         <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-4 rounded"><a href="{{ route('register') }}" class="ml-4 text-sm text-white-700">Register</a></button>
                        @endif
                    @endauth
                </div>
            @endif
            <h1 class="text-5xl">LiteNotes</h1>
        </div>
    </body>
</html>
