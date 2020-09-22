@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb" mb-4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
            </ol>
        </nav>

        <h2 class="font-weight-bold mb-2">{{ $service->title }}</h2>

        <hr class="p-2">

        <div class="row no-gutters bg-light position-relative">
            <div class="col-md-6 mb-md-0 p-md-4">
                @if($service->avatar != 'car.png')
                    <img src="/storage/service/{{ $service->avatar }}" class="card-img-top" alt="service">
                @else
                    <img src="{{asset('/service/car.png')}}" class="card-img-top" alt="service">
                @endif
            </div>
            <div class="col-md-6 position-static p-4 pl-md-0">
                <h5 class="mt-0"><b>Service Provider:</b> {{ $service->user->name }}</h5>
                <p class="text-monospace text-justify">{{ $service->description }}</p>
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Book Service</h4>
                        <p class="text-info">PRICE: <b>KSHs.{{ $service->price }}</b></p>
                        <div class="text-right">
                            <form action="{{route('book_service')}}" method="post">
                                @csrf
                                <input type="hidden" name="service_id" value="{{$service->id}}">
                                <button class="btn btn-outline-info" type="submit">Book</button>
                            </form>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-info" type="submit">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
