<x-app-layout>
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6">
                <form action="{{ route('client.events.index') }}" method="GET" class="mb-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Search by event title" value="{{ request()->search }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>

                <!-- Adjusted Date Range Filter Form -->
                <form action="{{ route('client.events.index') }}" method="GET" class="form-inline">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label for="start_date" class="sr-only">Start Date</label>
                            <input type="date" class="form-control mb-2" id="start_date" name="start_date" placeholder="Start Date" value="{{ request()->start_date }}">
                        </div>
                        <div class="col-auto">
                            <label for="end_date" class="sr-only">End Date</label>
                            <input type="date" class="form-control mb-2" id="end_date" name="end_date" placeholder="End Date" value="{{ request()->end_date }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h2>Upcoming Events</h2>
        <div class="row">
            @foreach ($upcomingEvents as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" class="card-img-top" alt="Event Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <span class="badge bg-primary mb-2">{{ $event->city->name ?? 'No City' }}</span>
                            <!-- Display Event Date -->
                            <p class="text-muted">{{ $event->event_date->format('F d, Y') }}</p>
                            <!-- Event Details -->
                            <div class="mt-auto">
                                <a href="{{ route('client.events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                                @if($event->is_auto && ($event->end_date === null || $event->end_date->isFuture()))
                                    <form action="{{ route('client.bookings.book', ['event' => $event->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="number_of_tickets" value="1">
                                        <button type="submit" class="btn btn-success">Book Now</button>
                                    </form>
                                @elseif(!$event->is_auto && ($event->end_date === null || $event->end_date->isFuture()))
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $event->id }}">
                                        Book Now
                                    </button>
                                @else
                                    <button class="btn btn-secondary" disabled>Event Finished</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Booking Modal for Non-Auto Book Events -->
                @if(!$event->is_auto && ($event->end_date === null || $event->end_date->isFuture()))

                    <div class="modal fade" id="bookingModal{{ $event->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $event->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bookingModalLabel{{ $event->id }}">Book Tickets for {{ $event->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('client.bookings.book', ['event' => $event->id]) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="number_of_tickets{{ $event->id }}" class="form-label">Number of Tickets</label>
                                            <input type="number" class="form-control" id="number_of_tickets{{ $event->id }}" name="number_of_tickets" value="1" min="1" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Confirm Booking</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endif
            @endforeach

        </div>
        {{ $upcomingEvents->links() }}

        <h2>Finished Events</h2>
        <div class="row">
            @foreach ($finishedEvents as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <span class="badge bg-primary mb-2">{{ $event->city->name ?? 'No City' }}</span>
                            <span class="badge" style="background-color: {{ '#' . substr(md5($event->category->name ?? 'default'), 0, 6) }}">{{ $event->category->name ?? 'No Category' }}</span>
                            <p class="card-text mt-2">{{ Str::limit($event->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">Date: {{ $event->event_date->format('F d, Y') }}</small></p>
                            <a href="{{ route('client.events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                            <button class="btn btn-secondary" disabled>Booking Closed</button>
                            {{-- Example of encouraging future engagement --}}
                            <a href="" class="btn btn-outline-primary mt-2">See Upcoming Events</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $finishedEvents->links() }}
    </div>
</x-app-layout>
