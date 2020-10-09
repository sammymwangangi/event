@extends('dashboard.partials.master')

@section('body')

<div class="container-fluid text-center">
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Expenses Tracker</h1>
      <a href="{{url('dashboard/print-expenses')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

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
    @if($bookings->sum('total') - ($venue_bookings->sum('venue.price') + $service_bookings->sum('service.price')) < 0)
        <div class="alert alert-danger" role="alert">
            Your account is on Credit. You need to generate more income!!!
        </div>
    @else
        <p>Your balance is KSh. {{$bookings->sum('total') - ($venue_bookings->sum('venue.price') + $service_bookings->sum('service.price')) }}
            <span>You can book 1 or 2 services or venues</span>
        </p>
    @endif
</div>

@endsection