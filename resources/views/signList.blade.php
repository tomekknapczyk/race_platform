@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-xs-width">
                <div class="card-header bg-yellow text-center">
                    <h3>{{ $round->race->name }}</a> : {{ $round->name }} - Lista zgłoszeń</h3>
                </div>
                <div class="card-body">
                    @foreach($klasy as $klasa)
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                        <div class="lista">
                            @foreach($class[$klasa] as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap py-2">
                                    <h6 class="m-0 col-1">
                                        {{ $loop->iteration }}.
                                    </h6>
                                    <div class="col-1">
                                        @if($sign['sign']->user && $sign['sign']->user->driver->file_id)
                                            <img src="{{ url('public/driver', $sign['sign']->user->driver->file->path) }}" class="img-fluid thumb">
                                        @else
                                            <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                        @endif
                                    </div>
                                    <h6 class="m-0 col-5 text-left">
                                        @if($sign['sign']->user)
                                            <a href="{{ url('kierowca', $sign['sign']->user->id) }}">
                                                {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                            </a>
                                        @else
                                            {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                        @endif
                                        <br>
                                        <small><strong>Pilot:</strong> {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}</small>
                                    </h6>
                                    <div class="col-2">
                                        @if($sign['sign']->car && $sign['sign']->car->file_id)
                                            <img src="{{ url('public/car', $sign['sign']->car->file->path) }}" class="img-fluid thumb">
                                        @else
                                            <img src="{{ url('images/car.png') }}" class="img-fluid thumb">
                                        @endif
                                    </div>
                                    <h6 class="m-0 col-3">
                                        {{ $sign['sign']->marka }} {{ $sign['sign']->model }} - {{ $sign['sign']->ccm }}ccm<br>
                                        <small>{{ $sign['sign']->rok }}r. @if($sign['sign']->turbo) / <strong>Turbo</strong> @endif @if($sign['sign']->rwd) / <strong>RWD</strong> @endif</small>
                                    </h6>
                                </div>  
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection