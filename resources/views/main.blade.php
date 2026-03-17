<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', env('APP_NAME').' | LandingPage')</title>
    <meta name="description" content="@yield('description',  env('APP_NAME').' | LandingPage')">
    <link rel="icon" type="image/png" href="{{ asset('img/icon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/icon/favicon.svg')}}" />
    <link rel="shortcut icon" href="{{ asset('img/icon/favicon.ico')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icon/apple-touch-icon.png')}}" />
    <meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME')}}" />
    <link rel="manifest" href="{{ asset('img/icon/site.webmanifest')}}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Light mode -->
    <meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" media="(prefers-color-scheme: light)">

    <!-- Dark mode -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" media="(prefers-color-scheme: dark)">

    <!-- <meta name="theme-color" content="#ffffff"> -->
    <!-- Light mode -->
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">

    <!-- Dark mode -->
    <meta name="theme-color" content="#0b0b18" media="(prefers-color-scheme: dark)">


    @vite(['resources/scss/app.scss', 'resources/js/app.js','resources/css/theme.css',
    'resources/js/navigate.js',
    ])
    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="https://unpkg.com/heic2any/dist/heic2any.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
    <script preload src="https://kit.fontawesome.com/d544c5e79c.js" crossorigin="anonymous"></script>


</head>

<body class="text-bg-dark">
    <input id="app_url" type="hidden" value="{{env('APP_URL')}}">
    <input id="api_url" type="hidden" value="{{env('APP_URL')}}api/">

    @include('components.header')

    <main class="py-5 mt-5 container">
        @yield('content')
    </main>
    <script>
        // The global state object for the entire reservation
        window.reservationState = {
            serviceIds: new Set(),
            branch: null,
            date: null,
            time: null,
            // --- ADD THIS ---
            customerInfo: {
                name: null,
                email: null,
                phone: null
            },
            totalCost: 0 // We'll calculate and store this later
        };
    </script>

    @include("components.alert")
    @include("components.notification")
    @include("components.popup")
</body>


</html>