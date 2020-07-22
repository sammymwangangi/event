@extends('layouts.app')

@section('content')
    <div class="container-fluid mx-4 my-4">
        <h4 class="text-muted text-center">
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

        <div class="row row-cols-4">
                @foreach($services as $service)
                    <div class="col mb-4">
                        <div class="card border-0 shadow rounded h-100">
                            @if($service->avatar != 'car.png')
                                <img src="{{asset('/storage/service/'.$service->avatar)}}" class="card-img-top" alt="service">
                            @else
                                <img src="{{asset('/service/car.png')}}" class="card-img-top" alt="service">
                            @endif
                            <div class="card-body text-left">
                                <h5 class="card-title">
                                    <a href="{{route('services.show', $service->id)}}">{{ $service->title }}</a>
                                </h5>
                                <div class="d-flex justify-content-between align-items-center card-subtitle mb-2">
                                    <div class="mr-auto bd-highlight font-weight-bold">
                                        KSHs. {{ $service->price }}
                                    </div>
                                    <div class="">
                                        <small class="text-info">By: <b>{{ $service->user->name }}</b></small>
                                    </div>
                                </div>
                                <p class="card-text text-muted">
                                    {{ Str::limit($service->description, 70, ' (...)') }}
                                </p>
                            </div>
                            <div class="card-footer border-0 bg-dark">
                                <div class="d-flex justify-content-between align-items-center bd-highlight">
                                    <div class="mr-auto bd-highlight">
                                        <a href="" class="card-link btn btn-sm btn-outline-info" data-toggle="modal" data-target="#editModal-{{ $service->id }}">Edit</a>
                                    </div>
                                    <div class="bd-highlight">
                                        <a href="" class="card-link btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal-{{ $service->id }}">Delete</a>
                                    </div>
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
                                <form action="{{route('services.update', $service->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="{{ $service->title }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" value="{{ $service->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="6">{{ $service->description }}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="avatar">Choose file</label>
                                        <input type="file" class="form-control-file" id="avatar" name="avatar" value="{{ $service->avatar }}">
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
                    <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter service title here" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="2000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="6"></textarea>
                        </div>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input form-control-file" id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar">Choose file</label>
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

@endsection
