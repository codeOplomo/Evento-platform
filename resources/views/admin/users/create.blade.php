@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create User</h1>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <!-- User details fields here -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role" id="role" required>
                    <option value="">Select Role</option>
                    <option value="organiser">Organiser</option>
                    <option value="client">Client</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
