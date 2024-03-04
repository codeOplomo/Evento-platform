@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Booking</h1>
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select class="form-control" id="user_id" name="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="event_id" class="form-label">Event</label>
                <select class="form-control" id="event_id" name="event_id">
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="confirmed">Confirmed</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="number_of_tickets" class="form-label">Number of Tickets</label>
                <input type="number" class="form-control" id="number_of_tickets" name="number_of_tickets" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
