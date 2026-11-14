<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Institute of Emerging Technologies</title>
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
        /* Apply the background gradient */
        footer {
            /*background: linear-gradient(356deg, rgba(247, 246, 255, 1) 0%, rgba(225, 225, 255, 1) 50%, rgba(204, 242, 250, 1) 100%);*/
            border-top: 2px solid #d9d9d9;
            padding-top: 60px !important;
        }

        /* Style the links and text color */
        footer a {
            color: #333; /* Adjust this color to match the text contrast */
            text-decoration: none;
        }

        /* Style the link hover state */
        footer a:hover {
            color: #007bff; /* Change this color to your preferred hover color */
        }

        footer img {
            max-width: 80px !important;
        }


        .institute {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0.33rem;
            background: linear-gradient(356deg, rgba(247,246,255,1) 0%, rgba(225,225,255,1) 50%, rgba(204,242,250,1) 100%);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgb(239 233 233 / 80%);
        }

        .institute .institute--name {
            font-size: 20px;
            text-decoration: none !important;
        }

        section {
            padding-top: 70px;
            padding-bottom: 70px;
        }

        .banner {
            background: #5e5eff;
            padding: 1rem 0;
        }

        .banner--title {
            margin: 0;
            color: #FFF;
            font-weight: lighter;
            text-align: center;
        }
    </style>
    @stack('page-styles')
</head>
<body>
<main>
    @include('sales.layout.header')
    @yield('content')
    @include('sales.layout.footer')
</main>

<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

@stack('page-scripts')
</body>
</html>
