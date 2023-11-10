<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @yield('title')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        @yield('js')
    </head>
    <body class="font-sans antialiased h-screen bg-theme">
        <div class='flex'>
            <div class='panel-firmware w-theme h-screen bg-black-theme'>
                <a href="{{route('main')}}" title='На домашнюю страницу'>
                        <div class='container-logo flex justify-center items-center'>
                            <div class='w-2/3 h-2/3'><x-logo></x-logo></div>
                        </div>
                        <div class='inline float-right text-white w-1/2 pt-2 text-w-theme'>
                            Enterprise Resource Planning
                        </div>
                </a>
                <p class='text-gray-300 pt-16 ps-4 text-sm'>Продукты</p>
            </div>
            <div class='w-full'>
                @include('layouts.navigation')
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
