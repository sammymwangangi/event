@extends('layouts.app')

@section('content')
    <div id="jumbo-bg" class="jumbotron jumbotron-events text-center text-white mb-4">
        <h1 class="display-4">All Events</h1>
        <hr>
        <div class="d-flex justify-content-center">
            <form action="" class="form-inline my-2 my-lg-0">
                <input type="email" class="form-control mr-sm-2" id="exampleInputEmail1" aria-describedby="emailHelp">
                <button class="btn btn-outline-success my-2 my-sm-0">Search</button>
            </form>

        </div>
    </div>

    <div class="container align-content-around">
        {{-- TABS --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Events</a>
            </li>
            <li class="nav-item dropdown" role="presentation">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" aria-selected="false">Categories</a>
                <div class="dropdown-menu">
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
        {{-- END TABS --}}
        @if(Auth::id())
            <h4 class="text-muted text-center mx-4 my-4">
                <span>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Event</button>
                </span>
            </h4>
        @endif

        {{-- TAB CONTENT --}}
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row pb-5">
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

                    @foreach($events as $event)
                        <div class="col-lg-3 col-md-6 mb-lg-4">
                            <div class="card shadow border-0 h-100">
                                <a href="{{route('events.show', $event->id)}}">
                                    @if($event->photo != 'car.png')
                                        <img src="{{url('storage/events/'.$event->photo)}}" class="card-img-top img-fluid" alt="event">
                                    @else
                                        <img src="{{asset('/service/car.png')}}" class="card-img-top" alt="service">
                                    @endif
                                </a>
                                <div class="card-body p-4">
                                    <h5 class="card-title text-left">
                                        <a href="{{route('events.show', $event->id)}}" class="text-decoration-none text-dark">{{ $event->name }}</a>
                                    </h5>
                                    <div class="d-flex flex-row card-subtitle mb-2">
                                        <div>
                                            <svg width="20px" height="20px" fill="#ef63ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div class="text-info">
                                            <small>{{$event->location}}</small>
                                        </div>
                                    </div>
                                    <p class="font-weight-light text-justify">
                                        {{ Str::limit($event->description, 70, ' (...)') }}
                                    </p>
                                    <div>
                                        @foreach($event->categories as $category)
                                            <a href="{{route('categories.show', $category->id)}}" class="badge badge-pill badge-warning">{{ $category->name }}</a>
                                        @endforeach
                                    </div>

                                </div>
                                @if(Auth::id() == $event->user->id)
                                    <div class="card-footer border-0 bg-dark">
                                    <div class="d-flex justify-content-between align-items-center bd-highlight">
                                        <div class="mr-auto bd-highlight">
                                            <a href="" class="card-link btn btn-sm btn-outline-info" data-toggle="modal" data-target="#editModal-{{ $event->id }}">Edit</a>
                                        </div>
                                        <div class="bd-highlight">
                                            <a href="" class="card-link btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal-{{ $event->id }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('events.update', $event->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">Event Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $event->name }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="location">Event Location</label>
                                                    <input type="text" class="form-control" name="location" id="location" value="{{ $event->location }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="starts_at">Starts At</label>
                                                    <input type="datetime-local" class="form-control" name="starts_at" id="starts_at" value="{{ \Carbon\Carbon::parse($event->starts_at)->format('Y-m-d\TH:i:s') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="ends_at">Ends At</label>
                                                    <input type="datetime-local" class="form-control" name="ends_at" id="ends_at" value="{{ \Carbon\Carbon::parse($event->ends_at)->format('Y-m-d\TH:i:s') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="amount">Entry Fee</label>
                                                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $event->amount }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tickets">No. of Tickets</label>
                                                    <select class="form-control" id="tickets_left" name="tickets_left">
                                                        <option value="{{$event->tickets_left}}" {{$event->tickets_left ? 'selected' : ''}}>{{$event->tickets_left}}</option>
                                                        <option value="250" {{($event->tickets_left ==='250') ? 'selected' : ''}}>250</option>
                                                        <option value="500" {{($event->tickets_left ==='500') ? 'selected' : ''}}>500</option>
                                                        <option value="800" {{($event->tickets_left ==='800') ? 'selected' : ''}}>800</option>
                                                        <option value="1000" {{($event->tickets_left ==='1000') ? 'selected' : ''}}>1000</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="venue_id">Venue</label>
                                                    <select class="form-control" id="venue_id" name="venue_id">
                                                        @foreach($venues as $venue)
                                                        <option value="{{$venue->id}}">{{ $venue->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="categories">Categories</label>
                                                    <select class="form-control" id="categories" name="categories[]"
                                                            multiple>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}" {{$category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="6">{{ $event->description }}</textarea>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="photo">Choose file</label>
                                                <input type="file" class="form-control-file" id="photo" name="photo" value="{{ $event->photo }}">
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
                        <div class="modal fade" id="deleteModal-{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="text-muted mb-4">Are You sure you want to delete this event?</h5>
                                        <form action="{{route('events.destroy', $event->id)}}" class="form-inline" method="post">
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
        </div>
        {{-- END TAB CONTENT --}}
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Event Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location">Event Location</label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="starts_at">Starts At</label>
                                <input type="datetime-local" class="form-control" name="starts_at" id="starts_at">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ends_at">Ends At</label>
                                <input type="datetime-local" class="form-control" name="ends_at" id="ends_at">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="amount">Entry Fee</label>
                                <input type="number" class="form-control" id="amount" name="amount">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tickets">No. of Tickets</label>
                                <select class="form-control" id="tickets" name="tickets_left">
                                    <option>Select No. of Tickets</option>
                                    <option value="250" {{($event->tickets_left ==='250') ? 'selected' : ''}}>250</option>
                                    <option value="500" {{($event->tickets_left ==='500') ? 'selected' : ''}}>500</option>
                                    <option value="800" {{($event->tickets_left ==='800') ? 'selected' : ''}}>800</option>
                                    <option value="1000" {{($event->tickets_left ==='1000') ? 'selected' : ''}}>1000</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="venue_id">Venue</label>
                                <select class="form-control" id="venue_id" name="venue_id">
                                    @foreach($venues as $venue)
                                        <option value="{{$venue->id}}">{{ $venue->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="categories">Categories</label>
                                <select class="form-control" id="categories" name="categories[]"
                                        multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="6"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="photo">Choose file</label>
                            <input type="file" class="form-control-file" id="photo" name="photo" value="{{ $event->photo }}">
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
