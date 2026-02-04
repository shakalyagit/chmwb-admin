<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Legacy Remodeling & Restoration | Roofing, Siding & Home Restoration in Maryland</title>
    <meta name="description"
        content="Legacy Remodeling & Restoration offers expert roofing, siding, gutter, window, and home restoration services in Maryland and nearby areas. Trusted craftsmanship, integrity, and quality service for homeowners." />
    <meta name="keywords"
        content="Roofing Maryland, Siding Contractors Maryland, Gutter Installation Maryland, Window Replacement Maryland, Home Restoration Maryland, Storm Damage Repair Maryland, Roof Replacement Maryland, Legacy Remodeling, Remodeling Contractors Maryland, Home Improvement Maryland" />
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta property="og:image" content="https://legacyrmd.com/assets/images/logo.png" />

    <link rel="canonical" href="https://legacyrmd.com/" />

    {{-- <meta property="og:title"
        content="Legacy Remodeling & Restoration | Roofing, Siding & Home Restoration in Maryland" />
    <meta property="og:url" content="https://legacyrmd.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://legacyrmd.com/assets/images/logo.png" />
    <meta property="og:image:width" content="630" />
    <meta property="og:image:height" content="473" />
    <meta property="og:description"
        content="Legacy Remodeling & Restoration provides expert roofing, siding, gutters, windows, and home restoration services in Maryland. Built on trust, integrity, and quality craftsmanship." />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Legacy Remodeling & Restoration | Roofing, Siding & Home Restoration in Maryland">
    <meta name="twitter:description"
        content="Trusted home improvement experts in Maryland specializing in roofing, siding, windows, gutters, and full restoration services.">
    <meta property="twitter:image" content="/assets/images/logo.png">
    <meta property="twitter:url" content="https://legacyrmd.com/" /> --}}

    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/fabicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/fabicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/fabicon.ico">
    <!-- web fonts -->
    <link href="http://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="http://fonts.googleapis.com/css?family=Pacifico&amp;display=swap&amp;subset=cyrillic,cyrillic-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!-- //web fonts -->
    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style-freedom.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="w3l-bootstrap-header">
        <nav class="navbar navbar-expand-lg navbar-light sub-content">
            <div class="container">
                <a class="navbar-brand" href="/">
                    {{-- <span class="fa fa-window-restore logo-icon" aria-hidden="true"></span><span class="left-logo"><span
                            class="logo-let">L</span>egancy<p class="mt-2">
                            Remodeling and Restoration</p></span> --}}
                    <img src="/assets/images/logo.webp" class="img-responsive" style="height: 56px" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item {{ request()->routeIs('home_page') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home_page') }}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('about_us') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('about_us') }}">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Services
                            </a>
                            <div class="dropdown-menu sec-nav" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('services') }}">Roofing</a>
                                <a class="dropdown-item" href="{{ route('services') }}">Siding</a>
                                <a class="dropdown-item" href="{{ route('services') }}">Restoration</a>
                                <a class="dropdown-item" href="{{ route('services') }}">Gutters</a>
                            </div>
                        </li>
                        <li class="nav-item {{ request()->routeIs('portfolio') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('portfolio') }}">Portfolio</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('contact_us') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact_us') }}">Contact</a>
                        </li>

                    </ul>
                    <button type="button" class="btn btn-primary text-white border border-white mr-2">
                        {{ config('company.company_number') }}
                    </button>
                    <button type="button" class="btn btn-outline-primary text-white border border-white"
                        data-toggle="modal" data-target="#exampleModalCenter">
                        Enquire Now
                    </button>
                </div>
            </div>
        </nav>
    </section>
