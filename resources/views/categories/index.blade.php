@extends('layouts.app')

@section('content')
    <div class="container text-center m-4">
        <h4 class="text-muted mb-4">
            List of Categories
            <span>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">Add Category</button>
            </span>
        </h4>

        <div class="col-sm-12">

            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <ul class="list-group list-group-horizontal-sm">
            <div class="row row-cols-md-6">
                @foreach($categories as $category)
                    <div class="col mb-4">
                        <li class="list-group-item shadow ml-1 border-0 rounded">
                            <h5 class="text-muted">
                                <a href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a>
                            </h5>
                            <a href="" class="badge badge-primary badge-pill" data-toggle="modal" data-target="#editModal-{{ $category->id }}">Edit</a>
                            <a href="" class="badge badge-danger badge-pill" data-toggle="modal" data-target="#deleteModal-{{ $category->id }}">Delete</a>
                        </li>
                    </div>
                @endforeach
            </div>
        </ul>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categories.store')}}" class="form-inline" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name here" required>
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categories.update', $category->id)}}" class="form-inline" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-muted mb-4">Are You sure you want to delete this category?</h5>
                    <form action="{{route('categories.destroy', $category->id)}}" class="form-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer clearfix">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
