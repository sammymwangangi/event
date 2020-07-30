@extends('layouts.app')

@section('content')
    <div id="jumbo-bg" class="jumbotron jumbotron-events text-center text-white mb-4">
        <h1 class="display-4">All Venues</h1>
        <hr>
        <div class="d-flex justify-content-center">
            <form action="/search" method="get">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-success">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid">
        <ul class="nav nav-tabs text-muted" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Venues</a>
            </li>
            <li class="nav-item dropdown px-1 border-b-0" role="presentation">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" aria-selected="false">Categories</a>
                <div class="dropdown-menu border-0 shadow-sm">
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
        @if(Auth::id())
            <h4 class="text-muted text-center mx-4 my-4">
                <span>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Venue</button>
                </span>
            </h4>
        @endif
        {{-- PRINT ERRORS --}}
        <div class="col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        {{-- END --}}

        {{-- PRINT SUCCESS MESSAGE --}}
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
        {{-- END --}}
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row row-cols-4">
                    @foreach($venues as $venue)
                        <div class="col mb-4">
                            <div class="card border-0 shadow rounded h-100">
                                @if($venue->image != 'car.png')
                                    <img src="{{asset('/storage/venue/'.$venue->image)}}" class="card-img-top" alt="venue">
                                @else
                                    <img src="{{asset('/service/car.png')}}" class="card-img-top" alt="venue">
                                @endif
                                <div class="card-body text-left">
                                    <h5 class="card-title text-uppercase">
                                        <a href="{{route('venues.show', $venue->id)}}">{{ $venue->name }}</a>
                                    </h5>
                                    <div class="d-flex justify-content-between align-items-center card-subtitle mb-2">
                                        <h4 class="mr-auto bd-highlight font-weight-light">
                                            KSHs. {{ $venue->price }}
                                        </h4>
                                        <h6 class="text-secondary">
                                            By: <b>{{ $venue->user->name }}</b>
                                        </h6>
                                    </div>
                                    <div class="d-flex flex-row card-subtitle mb-2">
                                        <div>
                                            <svg width="20px" height="20px" fill="#ef63ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div class="text-info">
                                            {{ $venue->address }}
                                        </div>
                                    </div>
                                    <h5><span class="badge bg-warning">{{ $venue->seats }}</span> Seats</h5>
                                </div>
                                    @if(Auth::id() == $venue->user->id)
                                        <div class="card-footer border-0 bg-dark">
                                    <div class="d-flex justify-content-between align-items-center bd-highlight">
                                        <div class="mr-auto bd-highlight">
                                            <a href="" class="card-link btn btn-sm btn-outline-info" data-toggle="modal" data-target="#editModal-{{ $venue->id }}">Edit</a>
                                        </div>
                                        <div class="bd-highlight">
                                            <a href="" class="card-link btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal-{{ $venue->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                            </div>
                        </div>

                        @if(Auth::id() == $venue->user->id)
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{ $venue->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Venue</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('venues.update', $venue->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $venue->name }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" value="{{ $venue->price }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" name="address" id="address" cols="30" rows="6">{{ $venue->address }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="seats">No. of Seats</label>
                                                <input type="number" class="form-control" name="seats" id="seats" value="{{ $venue->seats }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="image">Choose file</label>
                                                <input type="file" class="form-control-file" id="image" name="image" value="{{ $venue->image }}">
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
                            <div class="modal fade" id="deleteModal-{{ $venue->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Venue</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="text-muted mb-4">Are You sure you want to delete this venue?</h5>
                                        <form action="{{route('venues.destroy', $venue->id)}}" class="form-inline" method="post">
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">New Venue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('venues.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="seats">No. of Seats</label>
                            <input type="number" class="form-control" name="seats" id="seats">
                        </div>
                        <div class="form-group mb-2">
                            <label for="image">Choose file</label>
                            <input type="file" class="form-control-file" id="image" name="image">
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
