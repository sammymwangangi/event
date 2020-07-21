@extends('layouts.app')

@section('content')
    <div id="jumbo-bg" class="jumbotron jumbotron-events text-center text-white mb-4">
        <h1 class="display-4">Search Results</h1>
        <hr>
        <div class="d-flex justify-content-center">
            <form action="/search" method="get">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-success">Search</button>
                    </span>
                </div>
            </form>

        </div>
    </div>

    <div class="container align-content-around">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
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
                    @foreach($events as $event)

                        <div class="col mb-4">
                            <div class="card shadow border-0 rounded-lg h-100">
                                <img src="{{ $event->photo }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        <a href="#">{{ $event->name }}</a>
                                    </h4>
                                    <div class="row mb-4">
                                        <div class="col-6 text-muted text-nowrap">
{{--                                            @foreach($event->categories as $category)--}}
{{--                                                <h5 class="text-muted">{{ $category->name }}</h5>--}}
{{--                                            @endforeach--}}
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="#">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-light text-nowrap disabled">25 Dec 2016</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="#" class="btn btn-danger text-nowrap">
                                                Buy Tickets
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
