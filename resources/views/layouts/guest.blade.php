

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .custom-logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            background: -webkit-linear-gradient(45deg, #ff89b3, #ffbf00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 28px;
            text-decoration: none;
        }

        .logo-accent {
            font-family: 'Dancing Script', cursive;
            font-weight: 700;
        }

        /* Dark Navbar Styles */
        .navbar {
            background-color: #343a40 !important; /* Dark gray background */
            border-bottom: none; /* Remove the border */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ffffff; /* Light color for text links to stand out */
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link:focus {
            color: #ffbf00; /* Highlight color for hover and focus states */
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.1); /* Lighten the toggle border color */
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            /* Customizing the toggler icon color to be lighter */
        }

        .dropdown-menu {
            background-color: #343a40; /* Dark background for dropdown */
        }

        .dropdown-item {
            color: #ffffff; /* Light color for dropdown items */
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #495057; /* Darker background on hover/focus for dropdown items */
        }

        .min-vh-100 {
            background-color: #252525; /* Darker background for the whole page */
            color: #ffffff; /* Light text color for better readability on dark background */
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-vh-100">
    {{-- @include('layouts.navigation') --}}

    <div class="container d-flex flex-column align-items-center justify-content-center py-4">
        <div class="text-center">
            <a href="/" class="custom-logo">
                EV<span class="logo-accent">E</span>NT<span class="logo-accent">O</span>
            </a>
        </div>

        <div class="w-100" style="max-width: 28rem;">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
