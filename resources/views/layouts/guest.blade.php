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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

<div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
    <div class="text-center">
        <a href="/">
            <!-- Replace x-application-logo with your logo's HTML or an img tag -->
            <img src="/logo-path" class="mb-4" alt="Application Logo" style="width: 80px; height: auto;">
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

<!-- Bootstrap JS, Popper.js, and jQuery (Optional for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
