<x-guest-layout>

    <style>
        :root {
            --dark-shade: #1c1e21;
            --input-bg: #333639;
            --input-text-color: #ffffff;
            --input-border-color: #505357;
            --input-focus-border-color: #ffbf00;
            --card-bg-color: #242628;
        }

        body, html {
            height: 100%; /* Ensure full viewport height */
        }

        .full-height {
            min-height: 100vh; /* Minimum height to fill the viewport */
            display: flex;
            align-items: center; /* Vertically center the content */
            justify-content: center; /* Horizontally center the content */
        }

        .form-container {
            background-color: var(--card-bg-color);
            color: var(--input-text-color);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 100%; /* Max width to control the form size */
            max-width: 500px; /* Adjust this value based on your preference */
        }

        .card {
            background-color: var(--card-bg-color); /* Change card background */
            color: var(--input-text-color); /* Ensure text is readable on dark background */
        }

        .form-control {
            background-color: var(--input-bg);
            color: var(--input-text-color);
            border: 1px solid var(--input-border-color);
        }

        .form-control:focus {
            border-color: var(--input-focus-border-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 191, 0, 0.25);
        }

        .btn-primary {
            background-color: var(--input-focus-border-color);
            border-color: var(--input-focus-border-color);
        }

        .btn-primary:hover {
            background-color: #e6b800; /* Slightly darker shade for hover effect */
            border-color: #e6b800;
        }

        .btn-link {
            color: var(--input-text-color);
        }

        .btn-link:hover {
            color: #ffffff;
        }

        label {
            color: var(--input-text-color);
        }

        .invalid-feedback {
            color: #ff6b6b;
        }
    </style>
    
    <div class="mb-4 text-muted">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center">
        <div class="form-container justify-content-center align-items-center">
    <div class="mt-4 d-flex align-items-center justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link text-decoration-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
        </div>
    </div>
</x-guest-layout>
