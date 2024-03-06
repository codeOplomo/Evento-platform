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
        $organiser = Auth::user(); // Get the currently authenticated user
        $events = $organiser->events; // Assuming you have an 'events' relationship defined in your User model

        // Fetch bookings for the organizer's events
        $bookings = Booking::with('event', 'user')
            ->whereIn('event_id', $organiser->events->pluck('id'))
            ->get();

        // Pass the user, their events, and bookings to the view
        return view('organizer.profile', compact('organiser', 'events', 'bookings'));
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
            'end_date' => 'nullable|date|after_or_equal:event_date', // Allow nullable, but must be after start date if provided
            'location' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'capacity' => 'required|integer|min:1',
            'event_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $event = new Event($validatedData);
        $event->organizer_id = Auth::id();
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
