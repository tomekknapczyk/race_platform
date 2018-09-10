@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow text-center">
                    <h3>{{ $round->race->name }}</a> : {{ $round->name }} - Lista startowa</h3>
                </div>
                <div class="card-body">
                    @if($is_someone)
                        @foreach($class as $klasa)
                            <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                            <div class="lista">
                                @foreach($round->startPositions($start_list_id)->where('klasa', $klasa)->load('sign.user.driver.file') as $position)
                                    <div class="row justify-content-between align-items-center flex-wrap py-2">
                                        <h6 class="m-0 col-1">
                                            {{ $loop->iteration }}.
                                        </h6>
                                        <div class="col-1">
                                            @if($position->sign->user && $position->sign->user->driver->file_id)
                                                <img src="{{ url('public/driver', $position->sign->user->driver->file->path) }}" class="img-fluid thumb">
                                            @else
                                                <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                            @endif
                                        </div>
                                        <h6 class="m-0 col-5 text-left">
                                            @if($position->user)
                                                <a href="{{ url('kierowca', $position->user->id) }}">
                                                    {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                                </a>
                                            @else
                                                {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                            @endif
                                            {{ $position->sign->name }} {{ $position->sign->lastname }}<br>
                                            <small><strong>Pilot:</strong> {{ $position->sign->pilot_name }} {{ $position->sign->pilot_lastname }}</small>
                                        </h6>
                                        <div class="col-1">
                                            @if($position->sign->car && $position->sign->car->file_id)
                                                <img src="{{ url('public/car', $position->sign->car->file->path) }}" class="img-fluid thumb">
                                            @else
                                                <img src="{{ url('images/car.png') }}" class="img-fluid thumb">
                                            @endif
                                        </div>
                                        <h6 class="m-0 col-4">
                                            {{ $position->sign->marka }} {{ $position->sign->model }} - {{ $position->sign->ccm }}ccm<br>
                                            <small>{{ $position->sign->rok }}r. @if($position->sign->turbo) / <strong>Turbo</strong> @endif @if($position->sign->rwd) / <strong>RWD</strong> @endif</small>
                                        </h6>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection