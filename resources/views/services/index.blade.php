@extends('layouts.app')

@section('content')
    <div class="container text-center m-4">
        <h4 class="text-muted mb-4">
            List of Services
            <span>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">Add Service</button>
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

        <div class="row row-cols-1 row-cols-md-4">
                @foreach($services as $service)
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="{{ $service->avatar }}" class="card-img-top" alt="service">
                            <div class="card-body text-left">
                                <h5 class="card-title">
                                    <a href="{{route('services.show', $service->id)}}">{{ $service->title }}</a>
                                </h5>
                                <h6 class="card-subtitle mb-2 font-weight-bold">
                                    KSHs. {{ $service->price }}
                                </h6>
                                <p class="card-text">{{ $service->description }}</p>
                            </div>
                            <div class="card-body">
                                <a href="" class="card-link" data-toggle="modal" data-target="#editModal-{{ $service->id }}">Edit</a>
                                <a href="" class="card-link" data-toggle="modal" data-target="#deleteModal-{{ $service->id }}">Delete</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Service Provider: <b>{{ $service->user->name }}</b></small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">New Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('services.store')}}" class="form-inline" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="title">Title</label>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter service title here" required>
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
    <div class="modal fade" id="editModal-{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('services.update', $service->id)}}" class="form-inline" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="title">Title</label>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" name="title" id="title" value="{{ $service->title }}">
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
    <div class="modal fade" id="deleteModal-{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-muted mb-4">Are You sure you want to delete this service?</h5>
                    <form action="{{route('services.destroy', $service->id)}}" class="form-inline" method="post">
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
