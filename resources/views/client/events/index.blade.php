<x-app-layout>
    <div class="container">
        <h2>Upcoming Events</h2>
        <div class="row">
            @foreach ($upcomingEvents as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $event->image_url }}" class="card-img-top" alt="Event Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <!-- Display the category as a badge -->
                            <span class="badge" style="background-color: {{ '#' . substr(md5($event->category->name ?? 'default'), 0, 6) }}">{{ $event->category->name ?? 'No Category' }}</span>
                            <p class="card-text mt-2">{{ Str::limit($event->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">Date: {{ $event->event_date->format('F d, Y') }}</small></p>
                            <div class="mt-auto">
                                <a href="{{ route('client.events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                                @if($event->end_date === null || $event->end_date->isFuture())
                                    <a href="{{ route('client.bookings.create', ['event' => $event->id]) }}" class="btn btn-success">Book Now</a>
                                @else
                                    <button class="btn btn-secondary" disabled>Event Finished</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $upcomingEvents->links() }}

        <h2>Finished Events</h2>
        <div class="row">
            @foreach ($finishedEvents as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $event->image_url }}" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
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
