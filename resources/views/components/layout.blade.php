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
    <body class="container bg-img-ocean bg-center bg-fixed mx-auto mt-3 max-w-4xl min-h-screen" >
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
                    <a class="flex gap-3 items-center" href={{ route('user.profile.show', [ 
                        "user" => auth()->user(), 
                        "profile" => auth()->user()->profile
                        ])}}>
                        @can("checkApplications", request()->user())
                            <p class='text-blue-400 hover:text-cyan-200 text-xl'>
                                {{auth()->user()->name ?? 'Anon'}} ⋅ {{auth()->user()->employer->company_name ?? ''}}
                            </p>
                        @else
                            <p class='text-blue-400 hover:text-cyan-200 text-xl'>
                            {{auth()->user()->name ?? 'Anon'}}
                            </p>
                        @endcan
                        <x-profile-picture :profile="auth()->user()->profile"/>
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
                        <x-link-button  class='bg-cyan-500' :href="route('user.create')">
                           <p class='text-blue-800'> Join</p>
                        </x-link-button>
                    </li>
                @endauth
            </ul>
        </nav>    

        <x-flash-message/>

        {{ $slot }}

        <div class="mt-4 flex justify-center">
            <p class="text-xs font-extralight text-blue-950">Job Ocean Made by Clau McGinnis using Laravel 12</p>
        </div>
   </body>
</html>
