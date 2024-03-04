@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Manage Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-2">Add New Category</a>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <!-- Trigger/Delete Button -->
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal-{{ $category->id }}">Delete</a>
                    </td>
                </tr>

                <!-- Delete Category Modal -->
                <div class="modal fade" id="deleteCategoryModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel-{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCategoryModalLabel-{{ $category->id }}">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this category?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
