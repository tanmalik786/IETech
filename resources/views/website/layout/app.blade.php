<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>IET</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/features/">
    <link href="{{asset('vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/carousel.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>

        :root {
            --primary-blue: #1d4972;
            --primary-accent: #591d72;
        }

        .bg-custom-primary {
            background-color: var(--primary-blue);
        }

        .text-bg-custom-primary-blue {
            background-color: var(--primary-blue);
        }

        .bg-custom-primary {
            background-color: var(--primary-blue);
        }

        .featurette-heading {
            color: var(--primary-blue);
        }
        .subtitle {
            color: var(--primary-accent);
        }
        .bg-custom-gradient {
            background: rgb(89,29,114);
            background: linear-gradient(0deg, rgba(89,29,114,1) 0%, rgba(29,73,114,1) 100%);
        }

        body{
            padding-top: 0 !important;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .site-logo  {
            width: 50px;
        }


        .navbar-secondary {
            align-items: right !important;
            background: #f9f9f9;
            font-size: 12px;
            padding0: margin;
            padding: 0 !important;
            margin: 0;
        }
    </style>
    @stack('page-styles')
</head>
<body>
<main>
    <div class="container">
        <header class="navbar-secondary d-flex flex-wrap align-items-center justify-content-end">
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{url('/')}}" class="nav-link px-2 link-dark {{Request::is('/') ? 'link-active' : ''}}">Home</a></li>
                <li><a href="#about" class="nav-link px-2 link-dark">About</a></li>
                <li><a href="#contactus" class="nav-link px-2 link-dark">Contact Us</a></li>
                <li><a href="{{route('forum')}}" class="nav-link px-2 link-dark {{Request::is('forum') || Request::is('forum/*') ? 'active' : ''}}">Forums</a></li>
            </ul>
        </header>
    </div>
    @include('website.layout.header')
    @yield('content')
    @include('website.layout.footer')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</main>

<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

    @stack('page-scripts')
</body>
</html>
