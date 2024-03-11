<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClientController extends Controller
{

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048', 
        ]);

        $client = auth()->user(); 

        $client->clearMediaCollection('profile_pictures');

        
        $client->addMediaFromRequest('profile_picture')->toMediaCollection('profile_pictures');

        return back()->with('success', 'Profile picture updated successfully.');
    }

    public function profile()
    {
        $client = Auth::user();

        $bookings = $client->bookings()->with('event')->get();

        return view('client.profile', compact('client', 'bookings'));
    }

    public function listEvents(Request $request)
{
    $currentDate = now();
    $searchTerm = $request->query('search');
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');
    $selectedCity = $request->query('city_id'); 

    
    $cities = City::orderBy('name')->get();

    
    $dateFilter = function ($query) use ($startDate, $endDate) {
        if ($startDate && $endDate) {
            $query->whereBetween('event_date', [$startDate, $endDate]);
        }
    };

    
    $upcomingEvents = Event::with('category', 'organizer', 'city')
        ->whereHas('organizer', function ($query) {
            $query->where('is_banned', false); 
        })
        ->where('is_approved', true)
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('title', 'LIKE', '%' . $searchTerm . '%');
        })
        ->when($selectedCity, function ($query, $selectedCity) { 
            return $query->where('city_id', $selectedCity);
        })
        ->where(function ($query) use ($currentDate, $dateFilter) {
            $query->where('event_date', '>', $currentDate)
                ->orWhere(function ($subQuery) use ($currentDate) {
                    $subQuery->where('end_date', '>', $currentDate)
                        ->orWhereNull('end_date');
                });
        })
        ->where($dateFilter)
        ->paginate(6)
        ->withQueryString()
        ->appends(['finishedPage' => $request->input('finishedPage')]);

        
    $finishedEvents = Event::with('category', 'organizer', 'city')
        ->whereHas('organizer', function ($query) {
            $query->where('is_banned', false); 
        })
        ->where('is_approved', true)
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('title', 'LIKE', '%' . $searchTerm . '%');
        })
        ->when($selectedCity, function ($query, $selectedCity) {
            return $query->where('city_id', $selectedCity);
        })
        ->where($dateFilter)
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
        ->appends(['upcomingPage' => $request->input('upcomingPage')]);

    return view('client.events.index', compact('upcomingEvents', 'finishedEvents', 'searchTerm', 'startDate', 'endDate', 'cities', 'selectedCity'));
}



    public function showEvent($eventId)
    {
        $event = Event::with('category', 'organizer')->findOrFail($eventId);

        return view('client.events.show', compact('event'));
    }


    public function createBooking(Request $request, Event $event)
    {
        $request->validate([
            'number_of_tickets' => 'required|integer|min:1',
        ]);

        
        $totalBookedTickets = $event->bookings()->where('status', 'confirmed')->sum('number_of_tickets');
        $remainingCapacity = $event->capacity - $totalBookedTickets;

        if ($request->number_of_tickets > $remainingCapacity) {
            return back()->with('error', 'Unable to book the requested number of tickets due to capacity limits.');
        }

        
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->event_id = $event->id;
        $booking->number_of_tickets = $request->number_of_tickets;
        
        if ($event->is_auto) {
            $booking->status = 'confirmed';
        } else {
            $booking->status = 'pending';
        }
        $booking->save();

        return redirect()->back()->with('success', 'Booking successfully created.');
    }


    public function cancelBooking($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id()) 
            ->firstOrFail();

            
        $booking->status = 'cancelled';
        $booking->save();

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function viewTicket($bookingId)
    {
        $booking = Booking::with('event', 'user')->findOrFail($bookingId);
        if($booking->user_id != Auth::id()) {
            abort(403);
        }
        return view('client.tickets.ticket', compact('booking'));
    }


    public function downloadTicket($bookingId)
    {
        $booking = Booking::with('event', 'user')->findOrFail($bookingId);

        
        $qrCodeSvg = QrCode::size(200)->generate(url('/validate-booking/' . $bookingId));

        $pdf = PDF::loadView('client.tickets.pdf', compact('booking', 'qrCodeSvg'));

        return $pdf->download('ticket.pdf');
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
