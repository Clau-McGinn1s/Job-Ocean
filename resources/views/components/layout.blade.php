<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   <body class='container bg-linear-to-bl from-slate-700 via-cyan-800 to-blue-950 mx-auto mt-3 max-w-4xl'>
        <nav class='flex justify-between items-center px-2 rounded-t-xl py-3 container bg-blue-950 max-w-4xl'>
            <ul class="flex">
                <li>
                    <a href="{{ route('jobs.index') }}"
                        class='text-3xl  text-cyan-500 text-center hover:text-blue-200'>
                        <i class="fa-solid fa-house-flood-water"></i> Job Ocean
                    </a>
                </li>
            </ul>
            <ul class="flex space-x-2 items-center">
                @auth
                    <a href=#>
                        <p class='text-blue-300 hover:text-cyan-200 text-xl'>
                            {{auth()->user()->name ?? 'Anon'}}
                            <i class="fa-solid fa-user"></i>
                        </p>
                    </a>
                    <li>
                        <form action="{{ route('auth.destroy') }}" method='POST'>
                            @csrf
                            @method('DELETE')
                            <x-button class='px-4'>
                                Log Out
                            </x-button>
                        </form>
                    </li>
                @else
                    <li>
                        <x-link-button :href="route('auth.create')">
                            Log In
                        </x-link-button>
                    </li>
                    <li>
                        <x-link-button href="#">
                            Sing Up
                        </x-link-button>
                    </li>
                @endauth
            </ul>
        </nav>    
        {{ $slot }}
   </body>
</html>
