<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{

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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $validatedData['organizer_id'] = Auth::id(); // Automatically set organizer_id to the current user

        Event::create($validatedData);

        return redirect()->route('organizer.events.index')->with('success', 'Event created successfully.');
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
    public function store(Request $request)
    {
        //
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
