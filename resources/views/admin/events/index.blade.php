@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Events</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Add New Event</a>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Event Date</th>
                <th>Location</th>
                <th>Category</th>
                <th>Organizer</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->event_date->format('Y-m-d') }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->category->name }}</td>
                    <td>{{ $event->organizer->name }}</td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                        <!-- Trigger/Delete Button -->
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteEventModal-{{ $event->id }}">Delete</button>
                    </td>
                </tr>

                <!-- Delete Event Modal -->
                <div class="modal fade" id="deleteEventModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteEventModalLabel-{{ $event->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteEventModalLabel-{{ $event->id }}">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this event?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection
