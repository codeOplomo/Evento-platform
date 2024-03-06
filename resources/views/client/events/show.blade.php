<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        @if($event->category) {{-- Check if an event has a category --}}
                        <span class="badge" style="background-color: {{ '#' . substr(md5($event->category->name), 0, 6) }}">{{ $event->category->name }}</span>
                        @endif
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="card-text"><small class="text-muted">Date: {{ $event->event_date->format('F d, Y') }}</small></p>
                        @if($event->end_date)
                            <p class="card-text"><small class="text-muted">End Date: {{ $event->end_date->format('F d, Y') }}</small></p>
                        @endif
                        @if($event->event_date > now())
                            <a href="{{ route('client.bookings.create', $event->id) }}" class="btn btn-success">Book Now</a>
                        @else
                            <button class="btn btn-secondary" disabled>Event Finished</button>
                            {{-- Example of encouraging future engagement --}}
                            <a href="" class="btn btn-outline-primary mt-2">See Upcoming Events</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
