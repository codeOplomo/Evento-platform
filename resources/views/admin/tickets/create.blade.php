@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Ticket</h1>
        <form action="{{ route('admin.tickets.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="booking_id">Booking ID</label>
                <input type="number" class="form-control" id="booking_id" name="booking_id" required>
            </div>

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="valid">Valid</option>
                    <option value="used">Used</option>
                    <option value="expired">Expired</option>
                </select>
            </div>

            <div class="form-group">
                <label for="expiration_date">Expiration Date</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
