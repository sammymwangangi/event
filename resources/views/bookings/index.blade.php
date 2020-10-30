@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
    <div class="container-fluid mt-5">
        <div class="p-4 mb-5 card bg-light">
            
            <h1 class="my-2">Approved Bookings</h1>

                <h4>Events Bookings</h4>
            <div class="row mb-4">
                @forelse($approved_bookings as $approved)
                <div class="col-md-6 col-md-4">
                    <div class="card rounded border-0 shadow-sm mb-3" style="max-width: 540px;">
                        <div class="row">
                            <div class="col">
                                <h3 class="px-2"><span class="badge bg-success text-white">Approved</span></h3>
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
                                    <h5 class="card-title text-muted">Ticket No: {{'#' . str_pad($approved->id, 4, "0", STR_PAD_LEFT)}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$approved->event->name}}</h5>
                            <p class="card-text">{{$approved->event->description}}</p>
                        </div>
                    </div>
                </div>
                @empty
                    No Bookings Yet!
                @endforelse
            </div>
        </div>

        <div class="p-4 mb-5 card bg-light">
            <h1 class="mt-2">Pending Bookings</h1>

                <h4>Events Bookings</h4>
            <div class="row mb-4">
                @forelse($bookings as $booking)
                    <div class="col-6 col-md-4">
                        <div class="card rounded border-0 shadow-sm mb-3" style="max-width: 540px;">
                            <div class="row">
                                <div class="col">
                                    <h3 class="px-2"><span class="badge bg-danger text-white">Pending</span></h3>
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
                                        <p class="card-text">Total:<small class="text-muted"> KSH {{$booking->total}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Pending Bookings!
                @endforelse
            </div>
        </div>

        <div class="p-4 mb-5 card bg-light">
            <h1 class="mt-2">Other Bookings</h1>

                <h4>Venue Bookings</h4>
            <div class="row mb-4">
                @forelse($venue_bookings as $booking)
                    <div class="col-6 col-md-4">
                        <div class="card rounded border-0 shadow-sm mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">

                                    @if($booking->venue->image != 'car.png')
                                        <img src="{{asset('/storage/venue/'.$booking->venue->image)}}" class="card-img" alt="venue">
                                    @else
                                        <img src="{{asset('/service/car.png')}}" class="card-img" alt="venue">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$booking->venue->name}}</h5>
                                        <p class="card-text">{{$booking->venue->address}}</p>
                                        <p class="card-text">Total:<small class="text-muted"> KSH {{$booking->venue->price}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Pending Venue Bookings!
                @endforelse
            </div>

                <h4>Services Bookings</h4>
            <div class="row mb-4">
                @forelse($service_bookings as $booking)
                    <div class="col-6 col-md-4">
                        <div class="card rounded border-0 shadow-sm mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">

                                    @if($booking->service->avatar != 'car.png')
                                        <img src="/storage/service/{{ $booking->service->avatar }}" class="card-img-top" alt="service">
                                    @else
                                        <img src="{{asset('/service/car.png')}}" class="card-img" alt="service">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$booking->service->title}}</h5>
                                        <p class="card-text">{{$booking->service->description}}</p>
                                        <p class="card-text">Total:<small class="text-muted"> KSH {{$booking->total}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    No Pending Bookings!
                @endforelse
            </div>
        </div>

    </div>
@endsection
