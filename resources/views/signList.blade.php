@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark text-center">
                    <h3>Lista zgłoszeń {{ $round->race->name }}</a> : {{ $round->name }}</h3>
                </div>
                <div class="card-body">
                    @foreach($class as $key => $klasa)
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $key }} ::..</h2>
                        <div class="sortable_items">
                            @foreach($klasa as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap pt-1" data-id={{ $sign['sign']->id }}>
                                    <h6 class="m-0 col-1">
                                        {{ $loop->iteration }}.
                                    </h6>
                                    <h6 class="m-0 col-6 text-left">
                                        {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}<br>
                                        <small><strong>Pilot:</strong> {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}</small>
                                    </h6>
                                    <h6 class="m-0 col-5">
                                        {{ $sign['sign']->marka }} {{ $sign['sign']->model }} - {{ $sign['sign']->ccm }}ccm<br>
                                        <small>{{ $sign['sign']->rok }}r. @if($sign['sign']->turbo) / <strong>Turbo</strong> @endif @if($sign['sign']->rwd) / <strong>RWD</strong> @endif</small>
                                    </h6>
                                    <hr class="col-12 p-0 my-2">
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