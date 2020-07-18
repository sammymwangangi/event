@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb" mb-4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $venue->name }}</li>
            </ol>
        </nav>

        <h2 class="font-weight-bold mb-2">{{ $venue->name }}</h2>

        <hr class="p-2">

        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                <img src="{{ $venue->image }}" class="w-100" alt="...">
                <p><b>Venue Owner:</b> {{ $venue->user->name }}</p>
                <p><b>Address:</b> {{ $venue->address }}</p>
                <p><b>Seat Capacity: </b>{{ $venue->seats }}</p>
                <p><b>Venue Price:</b> {{ $venue->price }}</p>
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
