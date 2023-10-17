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


</head>
<body class="h-full font-sans antialiased bg-[#FDD85D]">
<div class="h-full flex sm:flex-col md:flex-row pt-6 mt-6">
    <div class="h-full basis-1/2 flex flex-col align-content-center">
        <img src="images/LOGOEDENIS.png" alt="" class="bg-[#202020]" width="200" height="200"/>
    </div>
    <div class="h-full basis-1/2 bg-[#202020] rounded-md pt-6 mt-6 ">
        2
    </div>
</div>

</body>
</html>
