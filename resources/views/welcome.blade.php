<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}">
    <title>Laravel - Instagram</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    @vite('resources/css/app.css')
    <style>
        body {
            padding-top: 3.5rem;
        }
    </style>
</head>

<body>
    <div id="app">

    </div>
    @vite('resources/js/app.js')
</body>

</html>
