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
@include('layouts.userNav')

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>{{ $organiser->name }}</h5>
                        <p class="text-muted">{{ $organiser->roles->first()->name ?? 'Role not set' }}</p>
                        <p class="text-muted">{{ $organiser->email }}</p>
                        <!-- Social links or additional user info can go here -->
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
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_date->format('Y-m-d') }}</td>
                                        <td>{{ $event->location }}</td>
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
                                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
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
                        <h4>Your Bookings</h4>
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
                                            <!-- You can add action buttons here -->
                                            <a href="#" class="btn btn-sm btn-info">View Details</a>
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

</body>

</html>


