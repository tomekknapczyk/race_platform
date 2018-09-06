@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ url('/kierowcy') }}" class="text-white">Kierowcy</a> : 
                    @if($user->driver->show_name){{ $user->driver->name }}@endif
                    @if($user->driver->show_lastname){{ $user->driver->lastname }}@endif
                    @if(!$user->driver->show_lastname && !$user->driver->show_name) Anonim @endif
                </div>
                <div class="card-body">
                        <div class="col-sm-12">
                            <div class="row shadow p-3">
                                <div class="col-sm-3">
                                    @if($user->driver->file_id)
                                        <img src="{{ url('public/driver', $user->driver->file->path) }}" class="img-fluid">
                                    @else
                                        <img src="{{ url('images/driver.png') }}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="col-sm-9">
                                    <h3 class="text-uppercase">
                                        @if($user->driver->show_name){{ $user->driver->name }}@endif
                                        @if($user->driver->show_lastname){{ $user->driver->lastname }}@endif
                                        @if(!$user->driver->show_lastname && !$user->driver->show_name) Anonim @endif
                                    </h3>
                                    <p>@if($user->driver->show_email){{ $user->email }}@endif</p>
                                    <strong>O mnie:</strong>
                                    {!! $user->driver->desc !!}
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <div class="card border-0 shadow">
                                        <div class="card-header bg-yellow">
                                            Piloci
                                        </div>
                                        <div class="card-body pilots">
                                            @if($user->pilots->count())
                                                @foreach($user->pilots as $pilot)
                                                    <div class="d-flex justify-content-start align-items-center flex-wrap py-2">
                                                        <div class="col-sm-5">
                                                            @if($pilot->file_id)
                                                                <img src="{{ url('public/pilot', $pilot->file->path) }}" class="img-fluid">
                                                            @else
                                                                <img src="{{ url('images/driver.png') }}" class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-7">
                                                            @if($pilot->show_name){{ $pilot->name }}@endif
                                                            @if($pilot->show_lastname){{ $pilot->lastname }}@endif
                                                            @if(!$pilot->show_lastname && !$pilot->show_name) Anonim @endif
                                                            <p>@if($pilot->show_email){{ $pilot->email }}@endif</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card border-0 shadow">
                                        <div class="card-header bg-yellow">
                                            Samochody
                                        </div>
                                        <div class="card-body">
                                            @if($user->cars->count())
                                                @foreach($user->cars as $car)
                                                    <div class="d-flex justify-content-start align-items-center flex-wrap py-2">
                                                        <div class="col-sm-5">
                                                            @if($car->file_id)
                                                                <img src="{{ url('public/cars', $car->file->path) }}" class="img-fluid">
                                                            @else
                                                                <img src="{{ url('images/car.png') }}" class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <h5>
                                                                {{ $car->marka }} {{ $car->model }}
                                                                <br><small>{{ $car->ccm }}ccm</small>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card border-0 shadow mt-4">
                                <div class="card-header bg-yellow">
                                    Rajdy
                                </div>
                                <div class="card-body lista p-0">
                                    @if($user->races->count())
                                        @foreach($user->races as $race)
                                        <div class="row d-flex align-items-center justify-content-between flex-wrap m-0 py-3">
                                            <h6 class="col-sm-4 m-0">
                                                {{ $race->startList->round->race->name }}<br>
                                                <small>{{ $race->startList->round->name }}</small>
                                            </h6>
                                            <h6 class="col-sm-3 m-0">
                                                {{ $race->sign->name }} {{ $race->sign->lastname }}<br>
                                                <small><strong>Pilot:</strong>{{ $race->sign->pilot_name }} {{ $race->sign->pilot_lastname }}</small>
                                            </h6>
                                            <h6 class="col-sm-3 m-0">
                                                {{ $race->sign->marka }} {{ $race->sign->model }}<br>
                                                <small>{{ $race->sign->ccm }}ccm</small>
                                            </h6>
                                            <h6 class="col-sm-2 m-0">
                                                Miejsce: {{ $race->position }}
                                            </h6>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection