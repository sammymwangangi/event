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
                <img src="{{ $event->photo }}" class="w-100" alt="...">
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0 font-weight-bold">Venue: <a href="{{ route('venues.show', $event->venue->id) }}">{{ $event->venue->name }}</a></h5>
                <p class="lead">{{ $event->description }}</p>
                <p><b>Starting From:</b> {{ $event->starts_at }}</p>
                <p><b>Ending at: </b>{{ $event->ends_at }}</p>
                <h4>Tickets left: <b>{{$event->tickets}}</b></h4>
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Buy Tickets</h4>
                        <p><b>Entry Fee:</b> {{ $event->entry_fee }}</p>
                        <form action="" method="post">
                            <div class="form-group row justify-content-between">
                                <label for="inputPassword" class="col-sm-4 col-form-label"><b>Choose No. of Tickets</b></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-outline-danger" type="submit">Book</button>
                                <a href="{{ route('events.index') }}" class="btn btn-outline-info" type="submit">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
