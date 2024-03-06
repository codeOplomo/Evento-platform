<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function profile()
    {
        // Retrieve the authenticated client
        $client = Auth::user();

        // Retrieve the bookings for the authenticated client
        // Make sure you have the relationship defined in your User model
        $bookings = $client->bookings()->with('event')->get();

        return view('client.profile', compact('client', 'bookings'));
    }

    public function listEvents()
    {
        $currentDate = now();

        // Fetch upcoming and approved events
        $upcomingEvents = Event::with('category', 'organizer')
            ->where('is_approved', true)
            ->where(function ($query) use ($currentDate) {
                $query->where('event_date', '>', $currentDate)
                    ->orWhere(function ($subQuery) use ($currentDate) {
                        $subQuery->where('end_date', '>', $currentDate)
                            ->orWhereNull('end_date');
                    });
            })
            ->paginate(6)
            ->withQueryString()
            ->appends(['finishedPage' => request()->input('finishedPage')]);

        // Fetch finished, approved events
        $finishedEvents = Event::with('category', 'organizer')
            ->where('is_approved', true)
            ->where(function ($query) use ($currentDate) {
                $query->whereNotNull('end_date')
                    ->where('end_date', '<=', $currentDate);
            })
            ->orWhere(function ($query) use ($currentDate) {
                $query->whereNull('end_date')
                    ->where('event_date', '<=', $currentDate);
            })
            ->paginate(6)
            ->withQueryString()
            ->appends(['upcomingPage' => request()->input('upcomingPage')]);

        return view('client.events.index', compact('upcomingEvents', 'finishedEvents'));
    }




    public function showEvent($eventId)
    {
        $event = Event::with('category', 'organizer')->findOrFail($eventId);
        // You might also want to load any other related data needed for the view

        return view('client.events.show', compact('event'));
    }


    public function createBooking(Request $request, Event $event)
    {

        $request->validate([
            'number_of_tickets' => 'required|integer|min:1',
            // Add other validation rules as needed
        ]);

        // Check event capacity before creating a new booking
        $totalBooked = $event->bookings()->sum('number_of_tickets');
        if ($totalBooked + $request->number_of_tickets > $event->capacity) {
            // Handle overbooking scenario, e.g., return with an error message
            dd($totalBooked, $event->capacity, $request->number_of_tickets, $totalBooked + $request->number_of_tickets, $event->capacity - $totalBooked - $request->number_of_tickets);
            return back()->with('error', 'Unable to book the requested number of tickets due to capacity limits.');
        }

        // Proceed with booking
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->event_id = $event->id;
        $booking->number_of_tickets = $request->number_of_tickets;
        $booking->status = 'pending';
        $booking->save();

        // Redirect back to the event details page with a success message
        return redirect()->back()->with('success', 'Booking successfully created.');
    }

    public function storeBooking(Request $request, Event $event)
    {

    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
