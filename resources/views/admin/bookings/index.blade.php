@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Bookings</h1>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">Add New Booking</a>
        <table class="table">
            <thead>
            <tr>
                <th>User</th>
                <th>Event</th>
                <th>Status</th>
                <th>Number of Tickets</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->event->title }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->number_of_tickets }}</td>
                    <td>
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
                        <!-- Trigger Modal Button -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBookingModal-{{ $booking->id }}">Delete</button>

                        <!-- Delete Booking Modal -->
                        <div class="modal fade" id="deleteBookingModal-{{ $booking->id }}" tabindex="-1" aria-labelledby="deleteBookingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteBookingModalLabel">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this booking?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
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
        <!-- Pagination -->
        {{ $bookings->links() }}
    </div>
@endsection
