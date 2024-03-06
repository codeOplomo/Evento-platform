{{-- resources/views/admin/events/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Event</h1>
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Display Event Image -->
            <div class="mt-4 text-center">
                @if($event->getFirstMediaUrl('event_pictures'))
                    <img src="{{ $event->getFirstMediaUrl('event_pictures') }}" alt="Event Image" class="img-fluid rounded" style="max-width: 300px; max-height: 300px;">
                @else
                    <p>No event image available.</p>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" required>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" value="{{ $event->event_date->format('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
@endsection
