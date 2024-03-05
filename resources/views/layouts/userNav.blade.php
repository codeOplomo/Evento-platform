<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JobConnect') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                jobConnect
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left Side Of Navbar -->

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <!-- Display job offers link if the user is a Candidate -->
                    @if (Auth::check() && Auth::user()->hasRole('Candidate'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('job_offers.index') }}">Job Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.index') }}">Companies</a>
                        </li>
                    @endif

                    <!-- Add Profile link based on user's role -->
                    @if (Auth::check())
                        @if (Auth::user()->hasRole('Candidate'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('candidat.profile') }}">Profile</a>
                            </li>
                        @elseif (Auth::user()->hasRole('Representer'))
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('user.profile.show', ['userId' => Auth::user()->id]) }}">Profile</a>
                            </li>
                            <!-- Inside your navigation bar HTML, typically in a Blade template -->

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('recruiters.index') }}">Recruiters</a>
                            </li>

                        @endif
                    @endif
                </ul>




                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">


                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <!-- Settings Dropdown -->
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>

</html>
