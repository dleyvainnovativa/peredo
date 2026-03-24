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
    <meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" media="(prefers-color-scheme: light)">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" media="(prefers-color-scheme: dark)">
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">

    <meta name="theme-color" content="#0b0b18" media="(prefers-color-scheme: dark)">
    @vite(['resources/scss/app.scss', 'resources/js/app.js','resources/css/theme.css'
    ])
    <script preload src="https://kit.fontawesome.com/d544c5e79c.js" crossorigin="anonymous"></script>
</head>

<body class="text-bg-dark h-100">
    @include("components.header")
    <main class="container h-100 my-auto align-content-center">

        <section class="text-bg-dark">
            <div class="container text-center">
                <div class="row g-4 py-4">
                    <div class="col-lg-12 col-12 col-md-12 mx-auto">
                        <div class="row g-2 text-center">

                            <!-- <div class="col-12">
                                <h2 class="">
                                    <i class="far fa-question-circle text-muted fa-2xl"></i>
                                </h2>
                            </div> -->
                            <div class="col-12">
                                <h1 class="subtitle">{{$title}}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-12 col-md-12 mx-auto text-center">
                        <div class="card card-dark border border-dark text-dark">
                            <div class="card-body p-4">
                                <h3 class="fw-bold">Lo sentimos</h3>
                                <p class="text-muted">
                                    {{$subtitle}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mx-auto">
                        <img width="100" src='{{asset("img/logo.png")}}' alt="">
                    </div>

                    <!-- <div class="col-lg-8 col-md-12 col-12 mx-auto">
                        <div class="row g-2">
                            <div class="col-lg-6 col-12 col-md-6 mx-auto text-start">
                                <a class="btn btn-primary w-100 btn-lg">
                                    <i class=" fas fa-arrow-right-to-bracket me-2"></i>Inicia Sesión
                                </a>
                            </div>
                            <div class="col-lg-6 col-12 col-md-6 mx-auto text-start">
                                <a class="btn btn-outline-primary w-100 btn-lg">
                                    Regresar a Home
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>

            </div>
        </section>
    </main>
</body>


</html>