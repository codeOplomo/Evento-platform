<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $bookings = Booking::all(); // Assuming you want to select from existing bookings
        return view('admin.tickets.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'code' => 'required|unique:tickets,code',
            'status' => 'required',
            'expiration_date' => 'required|date',
        ]);

        $ticket = Ticket::create($validated);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function edit(Ticket $ticket)
    {
        $bookings = Booking::all();
        return view('admin.tickets.edit', compact('ticket', 'bookings'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'code' => 'required|unique:tickets,code,' . $ticket->id,
            'status' => 'required',
            'expiration_date' => 'required|date',
        ]);

        $ticket->update($validated);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return back()->with('success', 'Ticket deleted successfully.');
    }
}
