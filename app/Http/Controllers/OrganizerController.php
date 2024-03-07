<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048', // 2MB Max
        ]);

        $organizer = auth()->user(); // Assuming the authenticated user is the organizer

        // Remove old profile picture if exists
        $organizer->clearMediaCollection('profile_pictures');

        // Add new profile picture
        $organizer->addMediaFromRequest('profile_picture')->toMediaCollection('profile_pictures');

        return back()->with('success', 'Profile picture updated successfully.');
    }

    public function profile()
    {
        $organiser = Auth::user(); // Get the currently authenticated organizer

        // Fetch only pending bookings for the organizer's events
        $bookings = Booking::with('event', 'user')
            ->whereHas('event', function($query) use ($organiser) {
                $query->where('organizer_id', $organiser->id);
            })
            ->where('status', 'pending')
            ->get();

        // Assuming you already have a way to fetch events for the organizer
        $events = $organiser->events;

        return view('organizer.profile', compact('organiser', 'bookings', 'events'));
    }


    public function confirmBooking(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $event = $booking->event;

        $totalBookedTickets = $event->bookings()->where('status', 'confirmed')->sum('number_of_tickets');
        $remainingCapacity = $event->capacity - $totalBookedTickets;

        if ($booking->number_of_tickets > $remainingCapacity) {
            return back()->with('error', 'Confirming this booking exceeds the event capacity.');
        }

        $booking->status = 'confirmed';
        $booking->save();

        return back()->with('success', 'Booking confirmed successfully.');
    }


    public function cancelBooking(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->status = 'cancelled';
        $booking->save();

        return back()->with('success', 'Booking cancelled successfully.');
    }


    public function createEvent()
    {
        $categories = Category::all();
        return view('organizer.events.create', compact('categories'));
    }

    public function storeEvent(Request $request)
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
        // Assuming you might want to select categories for an event
        $categories = Category::all();

        // Return the view with necessary data
        return view('organizer.events.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:event_date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'capacity' => 'required|integer|min:1',
            'event_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // If the checkbox is unchecked, 'is_auto' won't be present, so set it to true by default
        $is_auto = $request->has('is_auto') ? false : true;

        $event = new Event($validatedData);
        $event->organizer_id = Auth::id();
        // Set the is_auto attribute based on the checkbox
        $event->is_auto = $is_auto;
        $event->save();

        if ($request->hasFile('event_picture')) {
            $event->addMediaFromRequest('event_picture')->toMediaCollection('event_pictures');
        }

        return redirect()->route('organizer.profile')->with('success', 'Event created successfully.');
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
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all(); // Assuming you use categories

        return view('organizer.events.edit', compact('event', 'categories'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:event_date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Assuming the category_id is submitted in the form
            'capacity' => 'required|integer|min:1', // Assuming the capacity is submitted in the form
        ]);

        // Update the event details
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'capacity' => $request->capacity,
        ]);

        // Redirect back with success message
        return redirect()->route('organizer.events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        // Perform any authorization checks here to ensure the user can delete this event
        $event->delete();
        return redirect()->route('organizer.profile')->with('success', 'Event deleted successfully.');
    }

}
