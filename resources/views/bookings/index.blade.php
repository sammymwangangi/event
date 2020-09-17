@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
    <div class="container">
        <h1 class="my-2">Approved Bookings</h1>

        <div class="row">
            @forelse($approved_bookings as $approved)
            <div class="col-6 col-md-4">
                <div class="card rounded border-0 shadow-sm mb-3" style="max-width: 540px;">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-success">
                                Approved
                            </button>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @if($approved->event->photo != 'car.png')
                                <img src="/storage/event/{{ $approved->event->photo }}" class="card-img" alt="event">
                            @else
                                <img src="{{asset('/service/car.png')}}" class="card-img" alt="service">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$approved->event->name}}</h5>
                                <p class="card-text">{{$approved->event->description}}</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                No Bookings Yet!
            @endforelse
        </div>

        <h1 class="my-2">Pending Bookings</h1>

        <div class="row">
            @forelse($bookings as $booking)
                <div class="col-6 col-md-4">
                    <div class="card rounded border-0 shadow-sm mb-3" style="max-width: 540px;">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-danger">
                                    Pending
                                </button>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if($booking->event->photo != 'car.png')
                                    <img src="/storage/event/{{ $booking->event->photo }}" class="card-img" alt="event">
                                @else
                                    <img src="{{asset('/service/car.png')}}" class="card-img" alt="service">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$booking->event->name}}</h5>
                                    <p class="card-text">{{$booking->event->description}}</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                No Bookings Yet!
            @endforelse
        </div>

    </div>
@endsection
