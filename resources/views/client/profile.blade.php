


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<x-app-layout>
<div class="container py-5">
    <div class="row">
        <!-- Client Information Section -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Client Profile Picture -->
                    @if($client->getFirstMediaUrl('profile_pictures'))
                        <img src="{{ $client->getFirstMediaUrl('profile_pictures') }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    @else
                        <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    @endif
                    <h5>{{ $client->name }}</h5>
                    <p class="text-muted">{{ $client->email }}</p>
                    <!-- Update Profile Picture Button -->
                    <button class="btn btn-primary mt-3" onclick="document.getElementById('profilePictureUpload').click()">Update Profile Picture</button>

                    <!-- Hidden Form for Profile Picture Upload -->
                    <form action="{{ route('client.updateProfilePicture') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <input type="file" name="profile_picture" id="profilePictureUpload" onchange="this.form.submit()">
                    </form>
                </div>
            </div>
        </div>

        <!-- Booked Events Section -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4>Booked Events</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Event Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Tickets</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->event->title }}</td>
                                    <td>{{ $booking->event->event_date->format('Y-m-d') }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>{{ $booking->number_of_tickets }}</td>
                                    <td>
                                        <!-- Cancel Booking Button (only for pending bookings) -->
                                        @if($booking->status == 'pending')
                                            <form action="{{ route('client.bookings.cancel', $booking->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel Booking</button>
                                            </form>
                                        @endif

                                        <!-- View Ticket Button (only for confirmed bookings) -->
                                        @if($booking->status == 'confirmed')
                                            <a href="{{ route('client.tickets.view', $booking->id) }}" class="btn btn-info btn-sm">View Ticket</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
</body>
</html>
