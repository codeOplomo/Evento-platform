<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .badge {
            margin: 0 5px;
        }

        .card {
            margin-bottom: 30px;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
        }

        .project-item {
            margin-bottom: 10px;
        }

        .checkbox__label {
            margin-right: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
<x-app-layout>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center bg-dark text-white p-4 rounded">

                        <!-- Profile Picture -->
                        @if($organiser->getFirstMediaUrl('profile_pictures'))
                            <img src="{{ $organiser->getFirstMediaUrl('profile_pictures') }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        @else
                            <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        @endif
                        <h5>{{ $organiser->name }}</h5>
                        <p class="text-white">{{ $organiser->roles->first()->name ?? 'Role not set' }}</p>
                        <p class="text-white">{{ $organiser->email }}</p>
                        <!-- Update Profile Picture Button -->
                        <button class="btn btn-outline-light mt-3" onclick="document.getElementById('profilePictureUpload').click()">Update Profile Picture</button>

                        <!-- Hidden Form for Profile Picture Upload -->
                        <form action="{{ route('organizer.updateProfilePicture') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                            @csrf
                            <input type="file" name="profile_picture" id="profilePictureUpload" onchange="this.form.submit()">
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Your Events</h4>
                        <a href="{{ route('organizer.events.create') }}" class="btn btn-success mb-2">Create New Event</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Event Date</th>
                                    <th>Approved</th>
                                    <th>Details</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_date->format('Y-m-d') }}</td>
                                        <td>
                                            @if($event->is_approved)
                                                <span class="text-success">&#10004;</span> <!-- Approved -->
                                            @elseif($event->motif)
                                                <span class="text-danger">Rejected: {{ $event->motif }}</span> <!-- Rejected with a reason -->
                                            @else
                                                <span class="text-warning">Pending</span> <!-- Neither approved nor rejected -->
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#eventDetailModal-{{ $event->id }}">Details</button>
                                            <!-- Detail Modal -->
                                            <div class="modal fade" id="eventDetailModal-{{ $event->id }}" tabindex="-1" aria-labelledby="eventDetailModalLabel-{{ $event->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="eventDetailModalLabel-{{ $event->id }}">{{ $event->title }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" class="img-fluid mb-3" alt="Event Image">
                                                            <p><strong>Event Date:</strong> {{ $event->event_date->format('Y-m-d') }}</p>
                                                            <p><strong>Location:</strong> {{ $event->location }}</p>
                                                            <p><strong>Approved:</strong>
                                                                @if($event->is_approved)
                                                                    <span class="text-success">Yes</span>
                                                                @else
                                                                    <span class="text-danger">No</span>
                                                                @endif
                                                            </p>
                                                            @if($event->motif)
                                                                <p><strong>Motif:</strong> {{ $event->motif }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>


                                        <td>
                                            <a href="{{ route('organizer.events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEventModal-{{ $event->id }}">Delete</button>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteEventModal-{{ $event->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this event?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-body">
                        <h4>Incomming Bookings</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Tickets</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->event->title }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>{{ $booking->number_of_tickets }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">View Details</a>
                                            <form action="{{ route('organizer.bookings.confirm', $booking->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                                            </form>
                                            <form action="{{ route('organizer.bookings.cancel', $booking->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning">Cancel</button>
                                            </form>
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


