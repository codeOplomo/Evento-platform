<x-app-layout>
    <div class="container">
        <div class="bg-dark text-white p-4 rounded mb-4">
            <div class="row align-items-end">
                <!-- Search Form -->
                <div class="col-md-4">
                    <form action="{{ route('client.events.index') }}" method="GET">
                        <div class="input-group mb-3 mb-md-0">
                            <input type="text" class="form-control" name="search" placeholder="Search by event title" value="{{ request()->search }}">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <!-- Date Range Filter Form -->
                <div class="col-md-4">
                    <form action="{{ route('client.events.index') }}" method="GET" class="form-inline">
                        <div class="input-group mb-3 mb-md-0">
                            <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" value="{{ request()->start_date }}">
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" value="{{ request()->end_date }}">
                            <button type="submit" class="btn btn-outline-light">Filter</button>
                        </div>
                    </form>
                </div>

                <!-- City Filter Form -->
                <div class="col-md-4">
                    <form action="{{ route('client.events.index') }}" method="GET">
                        <div class="input-group mb-3 mb-md-0">
                            <select class="form-select" id="city_id" name="city_id">
                                <option value="">Select a City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ $selectedCity == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-outline-light">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="text-light">Upcoming Events</h2>
        <div class="row">
            @foreach ($upcomingEvents as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" class="card-img-top" alt="Event Image" style="width:350; height:200; fit-content:cover">
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

        <h2 class="text-light">Finished Events</h2>
        <div class="row">
            @foreach ($finishedEvents as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" class="card-img-top" alt="Event Image" style="width:350; height:200; fit-content:cover">
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
