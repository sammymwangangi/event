@extends('layouts.app')

@section('content')
    <div id="jumbo-bg" class="jumbotron jumbotron-events text-center text-white mb-4">
        <h1 class="display-4 uppercase">{{ $category->name }}</h1>
        <hr>
        <div class="d-flex justify-content-center">
            <form action="" class="form-inline my-2 my-lg-0">
                <input type="email" class="form-control mr-sm-2" id="exampleInputEmail1" aria-describedby="emailHelp">
                <button class="btn btn-outline-success my-2 my-sm-0">Search</button>
            </form>

        </div>
    </div>

    <div class="container align-content-around">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $category->name }}</a>
            </li>
            <li class="nav-item dropdown" role="presentation">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" aria-selected="false">Categories</a>
                <div class="dropdown-menu">
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
        <div class="row pb-5">
            @forelse($events as $event)
                <div class="col-lg-3 col-md-6 mb-lg-4">
                    <div class="card shadow-sm mb-4 border-0 h-100">
                        <img src="{{ $event->photo }}" class="card-img-top" alt="...">
                        <div class="card-body p-4">
                            <h4 class="card-title text-center">
                                <a href="{{route('events.show', $event->id)}}">{{ $event->name }}</a>
                            </h4>
                            <p class="font-weight-light text-justify">
                                {{ Str::limit($event->description, 100, ' (...)') }}
                            </p>
                            <div>
                                @foreach($event->categories as $category)
                                    <a href="{{route('categories.show', $category->id)}}" class="badge badge-pill badge-warning">{{ $category->name }}</a>
                                @endforeach

                            </div>

                        </div>
                        <div class="card-footer border-0 bg-dark">

                            <div class="d-flex bd-highlight">
                                <div class="mr-auto bd-highlight text-info">
                                    {{--                                            {{$event->starts_at->diffForHumans()}} &nbsp;|&nbsp; {{$event->starts_at->format(' H:i')}}--}}
                                    {{--                                            {{ date('Y-m-d','H:i', strtotime($event->starts_at))}}--}}
                                    {{ \Carbon\Carbon::parse($event->starts_at)->format('j F') }}
                                </div>
                                <div class="bd-highlight">
                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                        Buy Tickets
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info alert-dismissible fade show ml-2 mb-10" role="alert">
                    <h2 class="alert-heading text-danger font-weight-bolder">
                        Oops!
                    </h2>
                    <p class="mb-0 font-weight-bold font-italic">
                        No Events available on this Category!
                    </p>
                    <hr>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark btn-sm text-uppercase">View other categories</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforelse
        </div>
    </div>
@endsection
