@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12 pb-5">
            <div class="card border-dark" id="sign-list">
                <div class="card-header bg-yellow text-center">
                    <h3>{{ $round->race->name }}</a> : {{ $round->name }} - Lista zgłoszeń</h3>
                </div>
                <div class="row justify-content-center align-items-center p-3">
                    <div class="filter-box">
                        <button class="search-clear btn btn-warning m-1 active">Wszyscy</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k1">K1</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k2">K2</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k3">K3</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k4">K4</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k5">K5</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k6">K6</button>
                        <button class="search-class btn btn-warning m-1" data-klasa="k7">K7</button>
                        <button class="search-team btn btn-warning m-1" data-team="team">Teamy</button>
                    </div>
                </div>
                <div class="card-body pb-5 list">
                    @php
                        $numer = 0;
                    @endphp
                    @foreach($klasy as $klasa)
                    <div>
                        <h2 class="text-center mt-4 mb-3 text-uppercase klasa" data-klasa="{{ $klasa }}">..:: {{ $klasa }} ::..</h2>
                        <div class="lista">
                            @foreach($class[$klasa] as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap py-2">
                                    <h6 class="m-0 col-1 py-0 px-1 d-none d-md-block">
                                        {{ ++$numer }}.
                                    </h6>
                                    <h6 class="m-0 col-12 p-0 d-block d-md-none text-center">
                                        {{ $numer }}. 
                                        @if($sign['sign']->user && $sign['sign']->user->profile)
                                            @if($sign['sign']->user->profile->show_name && $sign['sign']->user->profile->show_lastname)
                                                <a href="{{ route('kierowca', [$sign['sign']->user->id, str_slug($sign['sign']->user->profile->name.'-'.$sign['sign']->user->profile->lastname)]) }}">
                                            @elseif($sign['sign']->user->profile->show_lastname)
                                                <a href="{{ route('kierowca', [$sign['sign']->user->id, $sign['sign']->user->profile->lastname]) }}">
                                            @else
                                                <a href="{{ route('kierowca', $sign['sign']->user->id) }}">
                                            @endif
                                                {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                            </a>
                                        @else
                                            {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                        @endif
                                        <br>
                                        @if($sign['sign']->pilot && $sign['sign']->pilot->profile)
                                            <small><strong>Pilot:</strong>
                                            @if($sign['sign']->pilot->profile->show_name && $sign['sign']->pilot->profile->show_lastname)
                                                <a href="{{ route('pilot', [$sign['sign']->pilot->id, str_slug($sign['sign']->pilot->profile->name.'-'.$sign['sign']->pilot->profile->lastname)]) }}">
                                            @elseif($sign['sign']->pilot->profile->show_lastname)
                                                <a href="{{ route('pilot', [$sign['sign']->pilot->id, $sign['sign']->pilot->profile->lastname]) }}">
                                            @else
                                                <a href="{{ route('pilot', $sign['sign']->pilot->id) }}">
                                            @endif
                                                {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}
                                            </a></small>
                                        @else
                                            <small><strong>Pilot:</strong> {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}</small>
                                        @endif
                                        @if($sign['sign']->team)
                                            <br>
                                            <small><strong>Team:</strong> <a href="{{ route('team',$sign['sign']->team->id) }}">{{ $sign['sign']->team->title }}</a></small>
                                        @endif
                                    </h6>
                                    <div class="col-6 col-md-2 col-lg-1 p-0 pr-1">
                                        @if($sign['sign']->user && $sign['sign']->user->profile && $sign['sign']->user->profile->file_id)
                                            {{-- <img src="{{ url('public/driver/thumb/', $sign['sign']->user->profile->file->path) }}" class="img-fluid thumb"> --}}
                                            <div class="img_with_hover">
                                                <img src="{{ url('public/driver/thumb/', $sign['sign']->user->profile->file->path) }}" class="img-fluid thumb">
                                                <img src="{{ url('public/driver/thumb/', $sign['sign']->user->profile->file->path) }}" class="img-fluid hovered">
                                            </div>
                                        @else
                                            <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                        @endif
                                    </div>
                                    <div class="col-6 col-md-2 col-lg-1 p-0 pl-1">
                                        @if($sign['sign']->pilot && $sign['sign']->pilot->profile && $sign['sign']->pilot->profile->file_id)
                                            <div class="img_with_hover">
                                                <img src="{{ url('public/driver/thumb/', $sign['sign']->pilot->profile->file->path) }}" class="img-fluid thumb">
                                                <img src="{{ url('public/driver/thumb/', $sign['sign']->pilot->profile->file->path) }}" class="img-fluid hovered">
                                            </div>
                                            {{-- <img src="{{ url('public/driver/thumb/', $sign['sign']->pilot->profile->file->path) }}" class="img-fluid thumb"> --}}
                                        @elseif($sign['sign']->pilotSimple && $sign['sign']->pilotSimple->file_id)
                                            <div class="img_with_hover">
                                                <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid hovered">
                                            </div>
                                            {{-- <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid thumb"> --}}
                                        @else
                                            <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                        @endif
                                    </div>
                                    <h6 class="m-0 col-3 col-md-2 col-lg-3 text-left py-0 px-2 d-none d-md-block">
                                        @if($sign['sign']->user && $sign['sign']->user->profile)
                                            @if($sign['sign']->user->profile->show_name && $sign['sign']->user->profile->show_lastname)
                                                <a href="{{ route('kierowca', [$sign['sign']->user->id, str_slug($sign['sign']->user->profile->name.'-'.$sign['sign']->user->profile->lastname)]) }}">
                                            @elseif($sign['sign']->user->profile->show_lastname)
                                                <a href="{{ route('kierowca', [$sign['sign']->user->id, $sign['sign']->user->profile->lastname]) }}">
                                            @else
                                                <a href="{{ route('kierowca', $sign['sign']->user->id) }}">
                                            @endif
                                                {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                            </a>
                                        @else
                                            {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}
                                        @endif
                                        <br>
                                        @if($sign['sign']->pilot && $sign['sign']->pilot->profile)
                                            <small><strong>Pilot:</strong>
                                            @if($sign['sign']->pilot->profile->show_name && $sign['sign']->pilot->profile->show_lastname)
                                                <a href="{{ route('pilot', [$sign['sign']->pilot->id, str_slug($sign['sign']->pilot->profile->name.'-'.$sign['sign']->pilot->profile->lastname)]) }}">
                                            @elseif($sign['sign']->pilot->profile->show_lastname)
                                                <a href="{{ route('pilot', [$sign['sign']->pilot->id, $sign['sign']->pilot->profile->lastname]) }}">
                                            @else
                                                <a href="{{ route('pilot', $sign['sign']->pilot->id) }}">
                                            @endif
                                                {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}
                                            </a></small>
                                        @else
                                            <small><strong>Pilot:</strong> {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}</small>
                                        @endif
                                        @if($sign['sign']->team)
                                            <br>
                                            <small class="team" data-team="team"><strong>Team:</strong> <a href="{{ route('team',$sign['sign']->team->id) }}">{{ $sign['sign']->team->title }}</a></small>
                                        @endif
                                    </h6>
                                    <div class="col-7 col-md-3 py-0 px-2">
                                        @if($sign['sign']->car && $sign['sign']->car->file_id)
                                        <div class="img_with_hover">
                                            <img src="{{ url('public/car/thumb/', $sign['sign']->car->file->path) }}" class="img-fluid thumb">
                                            <img src="{{ url('public/car/thumb/', $sign['sign']->car->file->path) }}" class="img-fluid hovered">
                                        </div>
                                        @else
                                            <img src="{{ url('images/car.png') }}" class="img-fluid thumb">
                                        @endif
                                    </div>
                                    <h6 class="m-0 col-5 col-md-2 col-lg-3 py-0 px-2">
                                        {{ $sign['sign']->marka }} {{ $sign['sign']->model }} - {{ $sign['sign']->ccm }}ccm<br>
                                        <small>@if($sign['sign']->turbo) <strong>Turbo</strong> @endif @if($sign['sign']->rwd) <strong>RWD</strong> @endif</small>
                                    </h6>
                                </div>  
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var options = {
      valueNames: [{ attr: 'data-klasa', name: 'klasa' }, { attr: 'data-team', name: 'team' }]
    };

    var userList = new List('sign-list', options);
</script>
@endsection