<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Your content here -->
        {{ __("You're logged in!") }}
        <div class="container">
            <h1>Organizer Dashboard</h1>
            <p>Welcome to your dashboard.</p>
        </div>
    </div>
</x-app-layout>
