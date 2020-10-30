@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Total Income</h4>
    {{$bookings->sum('total')}}
    <hr>

    <h4>My Expenses</h4>
    <h6>Venue Bookings Expenses</h6>
    {{$venue_bookings->sum('venue.price')}}

    <h6>Service Bookings Expenses</h6>

    {{ $service_bookings->sum('service.price') }}

    <hr>
    <h2>Total Expenses</h2>
    {{ $venue_bookings->sum('venue.price') + $service_bookings->sum('service.price') }}

    <hr>
    <h1>Balance</h1>
    
    <p>
        {{$bookings->sum('total') - ($venue_bookings->sum('venue.price') + $service_bookings->sum('service.price')) }}
    </p>
</div>

@endsection
