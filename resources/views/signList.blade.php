@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow text-center">
                    <h3>{{ $round->race->name }}</a> : {{ $round->name }} - Lista zgłoszeń</h3>
                </div>
                <div class="card-body">
                    @foreach($class as $key => $klasa)
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $key }} ::..</h2>
                        <div class="lista">
                            @foreach($klasa as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap py-2" data-id={{ $sign['sign']->id }}>
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
                                        {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}<br>
                                        <small><strong>Pilot:</strong> {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}</small>
                                    </h6>
                                    <h6 class="m-0 col-5">
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