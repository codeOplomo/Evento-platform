{{-- resources/views/admin/events/create.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Event</h1>
        <form action="{{ route('admin.events.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Select a Category</option> <!-- Default prompt option -->
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Create Event</button>
        </form>
    </div>
@endsection
