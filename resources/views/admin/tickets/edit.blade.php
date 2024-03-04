@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Ticket</h1>
        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="booking_id">Booking ID</label>
                <input type="number" class="form-control" id="booking_id" name="booking_id" value="{{ $ticket->booking_id }}" required>
            </div>

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ $ticket->code }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="valid" {{ $ticket->status == 'valid' ? 'selected' : '' }}>Valid</option>
                    <option value="used" {{ $ticket->status == 'used' ? 'selected' : '' }}>Used</option>
                    <option value="expired" {{ $ticket->status == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>

            <div class="form-group">
                <label for="expiration_date">Expiration Date</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ $ticket->expiration_date }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
