<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function approve(Event $event)
    {
        $event->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Event has been approved successfully.');
    }

    public function reject(Event $event)
    {
        $event->motif = request()->input('motif');
        $event->save();

        return redirect()->back()->with('success', 'Event has been rejected successfully.');
    }

    public function notApprovedEvents()
    {
        $notApprovedEvents = Event::where('is_approved', false)->get();

        return view('admin.adminDashboard', ['notApprovedEvents' => $notApprovedEvents]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with(['category', 'organizer'])->paginate(10);
        return view('admin.events.index', compact('events'));
    }


    public function create()
    {
        $categories = Category::all(); 
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'organizer_id' => 'required|integer|exists:users,id',
        ]);

        Event::create($validatedData);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }


    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $categories = Category::all(); 
        return view('admin.events.edit', compact('event', 'categories'));
    }


    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
        ]);

        $event->update($validatedData);

        return redirect()->route('admin.events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index');
    }
}
