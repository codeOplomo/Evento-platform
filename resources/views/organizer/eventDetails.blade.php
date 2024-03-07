<x-app-layout>
    <div class="container py-4">
        <h2>Bookings for {{ $event->title }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Number of Tickets</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($event->bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->number_of_tickets }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
