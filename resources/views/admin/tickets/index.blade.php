@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tickets</h1>
        <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary mb-3">Create Ticket</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>Code</th>
                <th>Status</th>
                <th>Expiration Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->booking_id }}</td>
                    <td>{{ $ticket->code }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->expiration_date }}</td>
                    <td>
                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning">Edit</a>
                        <!-- Trigger/Delete Button -->
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteTicketModal-{{ $ticket->id }}">Delete</a>
                    </td>
                </tr>

                <!-- Delete Ticket Modal -->
                <div class="modal fade" id="deleteTicketModal-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTicketModalLabel-{{ $ticket->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteTicketModalLabel-{{ $ticket->id }}">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this ticket?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
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
        {{ $tickets->links() }}
    </div>
@endsection
