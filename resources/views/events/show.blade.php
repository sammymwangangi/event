@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb" mb-4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('events.index')}}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $event->name }}</li>
            </ol>
        </nav>

        <h2 class="font-weight-bold mb-2">{{ $event->name }}</h2>

        <hr class="p-2">

        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                @if($event->photo != 'car.png')
{{--                    <img src="/storage/events/{{ $event->photo }}" class="card-img-top" alt="event">--}}
                    <img src="{{ asset('events/'.$event->photo) }}" class="card-img-top" alt="event" />
                @else
                    <img src="{{asset('/service/car.png')}}" class="card-img-top" alt="service">
                @endif
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0 font-weight-bold">Venue: <a href="{{ route('venues.show', $event->venue->id) }}">{{ $event->venue->name }}</a></h5>
                <p class="lead">{{ $event->description }}</p>
                <p><b>Starting From:</b> {{ $event->starts_at }}</p>
                <p><b>Ending at: </b>{{ $event->ends_at }}</p>
                <h4>Tickets left: <b>{{$event->tickets_left}}</b></h4>
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Buy Tickets</h4>
                        <p><b>Entry Fee:</b> {{ $event->amount }}</p>
                        <form action="{{route('bookings.store')}}" method="post">
                            @csrf
                            <div class="form-group row justify-content-between">
                                <label for="inputPassword" class="col-sm-4 col-form-label"><b>Choose No. of Tickets</b></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="exampleFormControlSelect1" name="tickets">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="event_id" value="{{$event->id}}">

                            <div class="form-group">
                                @auth
                                <button class="btn btn-outline-danger" type="submit">Book</button>
                                @endauth
                                @guest
                                <div class="alert alert-warning">You must be logged in to book an event!!!</div>
                                @endguest
                                <a href="{{ route('events.index') }}" class="btn btn-outline-info" type="submit">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
