@extends('layouts.app')

@section('content')
    <div id="jumbo-bg" class="jumbotron jumbotron-events text-center text-white mb-4">
        <h1 class="display-4">All Events</h1>
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

    <div class="container align-content-around">
        <ul class="nav nav-tabs text-muted" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
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
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row pb-5">
                    @foreach($events as $event)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <a href="{{route('events.show', $event->id)}}">
                                    @if($event->photo != 'car.png')
                                        <img src="/storage/service/{{ $event->photo }}" class="card-img-top" alt="event">
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
                                <div class="card-footer border-0 bg-dark">

                                    <div class="d-flex bd-highlight">
                                        <div class="mr-auto bd-highlight text-info">
                                            <small>
                                                {{ \Carbon\Carbon::parse($event->starts_at)->format('j F') }} &nbsp;|&nbsp; {{ \Carbon\Carbon::parse($event->starts_at)->format(' H:i') }}
                                            </small>
                                        </div>
                                        <div class="bd-highlight">
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-danger">
                                                Buy Tickets
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
