<nav class="navbar navbar-expand-lg navbar-light border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand custom-logo" href="{{ route('dashboard') }}">
            EV<span class="logo-accent">E</span>NT<span class="logo-accent">O</span>
        </a>


        <!-- Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Primary Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dynamic links for authenticated clients -->
                @auth
                    @if (auth()->user()->isClient())
                        <li class="nav-item"><a class="nav-link" href="{{ route('client.profile') }}">My Space</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('client.events.index') }}">Events</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Institutions</a></li>
                    @endif

                    <!-- Dynamic links for authenticated organizers -->
                    @if (auth()->user()->isOrganizer())
                            <li class="nav-item"><a class="nav-link" href="{{ route('organizer.profile') }}">My Space</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('organizer.statistics') }}">My Statistics</a></li>
                    @endif
                @endauth
            </ul>

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
        </div>
    </div>
</nav>
