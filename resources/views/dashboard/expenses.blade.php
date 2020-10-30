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
    <h1>Net Profit</h1>
    <p>
        {{$bookings->sum('total') - ($venue_bookings->sum('venue.price') + $service_bookings->sum('service.price')) }}
    </p>


    {{-- <table class="table">
      <thead>
        <tr>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table> --}}

</div>

@endsection