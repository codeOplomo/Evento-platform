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
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>


    <div class="container d-flex justify-content-center align-items-center">
        <div class="form-container justify-content-center align-items-center">
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
            @error('password')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
        </div>
    </div>
</x-guest-layout>
