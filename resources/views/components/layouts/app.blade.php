<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="dark-mode dark bg-dark bg-[#FDD85D]">
        <section class="" style="padding: 90px 190px 90px 190px">
            {{ $slot }}
        </section>
    </body>
</html>
