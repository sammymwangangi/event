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
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row row-cols-1 row-cols-md-4">
                    @forelse($events as $event)
                        <div class="col mb-4">
                            <div class="card shadow border-0 rounded-lg h-100">
                                <img src="{{ $event->photo }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        <a href="{{ route('events.show', $event->id) }}" CLASS="stretched-link">{{ $event->name }}</a>
                                    </h4>
                                    <div class="row mb-4">
                                        <div class="col-6 text-muted text-nowrap">
                                            @foreach($event->categories as $category)
                                                <h5 class="text-muted">{{ $category->name }}</h5>
                                            @endforeach
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="{{ route('events.show', $event->id) }}">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-6">
                                            <button class="btn btn-light text-nowrap disabled">{{ $event->starts_at }}</button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-danger text-nowrap">
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
        </div>
    </div>
@endsection
