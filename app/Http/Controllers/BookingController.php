<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'event'])->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $events = Event::all();
        $users = User::all();
        return view('admin.bookings.create', compact('events', 'users'));
    }

    public function store(Request $request)
    {
        Booking::create($request->all());
        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $events = Event::all();
        $users = User::all();
        return view('admin.bookings.edit', compact('booking', 'events', 'users'));
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
