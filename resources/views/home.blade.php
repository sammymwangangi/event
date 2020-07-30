@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>My Venues</h4>
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Seats</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myvenues as $venue)
                            <tr>
                                <td>{{$venue->name}}</td>
                                <td>{{$venue->address}}</td>
                                <td>{{$venue->seats}}</td>
                            </tr>
                            @empty
                                <div class="alert alert-danger" role="alert">
                                    You currently don't own any venue! <a href="{{'/venues'}}" class="alert-link">Create one</a>
                                </div>
                            @endforelse
                        </tbody>
                    </table>

                    <hr>
                    <h4>My Events</h4>
                    <table class="table table-success table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Entry Fee</th>
                            <th scope="col">Starts At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($myevents as $event)
                            <tr>
                                <td>{{$event->name}}</td>
                                <td>{{$event->location}}</td>
                                <td>{{$event->entry_fee}}</td>
                                <td>{{$event->starts_at}}</td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                You haven't created any event! <a href="{{'/events'}}" class="alert-link">Create one</a>
                            </div>
                        @endforelse
                        </tbody>
                    </table>

                    <hr>
                    <h4>My Services</h4>
                    <table class="table table-info table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($myservices as $service)
                            <tr>
                                <td>{{$service->title}}</td>
                                <td>{{$service->price}}</td>
                                <td>

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                You currently don't provide any services! <a href="{{'/services'}}" class="alert-link">Create one</a>
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
