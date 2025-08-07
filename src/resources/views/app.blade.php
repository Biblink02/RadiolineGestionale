<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- PRIORITY 100 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PRIORITY 95 -->
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- PRIORITY 90 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- PRIORITY 50 -->
    @routes
    @vite(['resources/ts/app.ts', "resources/ts/Pages/{$page['component']}.vue"])

    <!-- PRIORITY 40 -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/svg+xml" href="/favicons/favicon.svg"/>
    <link rel="shortcut icon" href="/favicons/favicon.ico"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png"/>
    <link rel="manifest" href="/favicons/site.webmanifest"/>
    <meta name="apple-mobile-web-app-title" content="MdjService"/>
    <meta name="theme-color" content="#ffffff">

    <!-- JSON-LD  -->
    {!! \App\Services\SchemaGenerator::for(Illuminate\Support\Str::after(Illuminate\Support\Facades\Route::currentRouteName(), 'page.')) !!}

    @inertiaHead
</head>

<body class="font-sans antialiased">
@inertia
</body>
</html>
