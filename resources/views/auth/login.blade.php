<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>

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

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex justify-content-end mt-4">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary ms-2">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>