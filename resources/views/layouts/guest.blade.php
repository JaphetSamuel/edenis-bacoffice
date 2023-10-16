<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Backoffice</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-color: #FDD85D !important;
            }

            input, input:hover, input:focus {
                background-color: #202020 !important;
                color: #FFFFFF !important;

            }
            input:hover, input:focus {
                border-color: #FDD85D !important;
            }

            label {
                color: #FFFFFF !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased flex items-stretch lg:flex-row sm:flex-col">
        <div class="basis-1/2 flex  flex-col pt-6 sm:pt-0 pl-6 items-stretch sm:justify-center ">
            <div class="flex items-start justify-self-start">
                <img src="/images/LOGOEDENIS.png" alt="" width="200" height="200">
            </div>
            <div class="flex block flex-col items-center">
                <h1 class=" text-6xl justify-self-center" style="font-weight: 900!important;">BIENVENUE</h1>
                <h3 class="font-bold font-black text-xl tracking-wide">DANS LE CLUB DES ACTIONNAIRES</h3>
            </div>
            <div class="items-center ">
                <img src="/images/backguest.jpg" alt="" width="500" height="500">
            </div>
            <div class="mt-[30px] mb-[30px] flex justify-center">
                <p>WE ARE CONNECTING AFRICA</p>
            </div>
        </div>
        <div class="w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 dark:bg-gray-900" style="background-color:#FDD85D">
            <div>
                <a href="/">
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
                </a>
            </div>

            <div class="w-full h-full  flex-1 ml-6 px-[160px] py-4 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-l-[20px] " style="background-color:#202020">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
