@extends('dashboard.partials.master')

@section('body')

	<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <a href="{{url('/print-bookings')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User Name</th>
                      <th>Event Name</th>
                      <th>Amount</th>
                      <th>Tickets</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>User Name</th>
                      <th>Event Name</th>
                      <th>Amount</th>
                      <th>Tickets</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                      <td>{{$booking->user->name}}</td>
                      <td>{{$booking->event->name}}</td>
                      <td>{{$booking->total}}</td>
                      <td>{{$booking->tickets}}</td>
                      <td>
                        <input data-id="{{$booking->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $booking->approved ? 'checked' : '' }}>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

  </div>

@endsection