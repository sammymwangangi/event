@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb" mb-4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('venues.index') }}">Venues</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $venue->name }}</li>
            </ol>
        </nav>

        <h2 class="font-weight-bold mb-2">{{ $venue->name }}</h2>

        <hr class="p-2">

        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                @if($venue->image != 'car.png')
                    <img src="/storage/venue/{{ $venue->image }}" class="card-img-top" alt="service">
                @else
                    <img src="{{asset('/service/car.png')}}" class="card-img-top" alt="service">
                @endif
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0"><b>Venue Owner:</b> {{ $venue->user->name }}</h5>
                <p class="text-monospace text-justify">{{ $venue->address }}</p>
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Book Service</h4>
                        <p class="text-info">PRICE: <b>KSHs.{{ $venue->price }}</b></p>
                        <p class="text-info">Available Seats: <b>{{ $venue->seats }}</b></p>
                        <div class="text-right">
                            <button class="btn btn-outline-danger" type="submit">Book</button>
                            <a href="{{ route('venues.index') }}" class="btn btn-outline-info" type="submit">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
