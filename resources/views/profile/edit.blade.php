<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold text-dark mb-3">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Update Profile Information Card -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Update Profile Information</h5>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password Card -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Update Password</h5>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User Form Card -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Delete Account</h5>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
