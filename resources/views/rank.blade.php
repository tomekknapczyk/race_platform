@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow text-center">
                    <h3>Klasyfikacja Generalna: {{ $race->name }}</h3>
                </div>
                <button class="switch-img btn btn-default">UKRYJ ZDJĘCIA</button>
                <div class="card-body">
                    @foreach($klasy as $klasa)
                        @php
                            $before_points = 0;
                            $rank = 0;
                        @endphp
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <h6 class="m-0 col text-left p-0 pl-1 max-w-40">
                                    LP
                                </h6>
                                <h6 class="m-0 col-3 text-left px-1">
                                    Imię i nazwisko
                                </h6>
                                <h6 class="m-0 col-2 text-left px-1">
                                    Samochód
                                </h6>
                                <div class="m-0 col-5 d-flex justify-content-start p-0">
                                    @foreach($race->rounds as $round)
                                        <h6 class="m-0 col-2 text-center">
                                            <small>{{ $round->name }}</small>
                                        </h6>
                                    @endforeach
                                </div>
                                <h6 class="m-0 col-1 text-right px-2">
                                    <div class="d-flex justify-content-between">
                                        <p>PKT</p>
                                        <p>Miejsce</p>
                                    </div>
                                </h6>
                                <hr class="col-12 p-0">
                            </div>
                            <div class="lista"> 
                                @foreach($race->klasa_rank($klasa) as $position)
                                    <div class="row justify-content-between align-items-center flex-wrap py-2">
                                        <h6 class="m-0 col p-0 pl-1 max-w-40">
                                            {{ $loop->iteration }}.
                                        </h6>
                                        <h6 class="m-0 col-3 text-left px-1">
                                            <div class="d-flex align-items-center">
                                                <div class="col-3 p-1">
                                                    @if($position->user && $position->user->profile->file_id)
                                                        <div class="img_with_hover">
                                                            <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid thumb">
                                                            <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid hovered">
                                                        </div>
                                                        {{-- <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid thumb"> --}}
                                                    @else
                                                        <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                                    @endif
                                                </div>
                                                <div class="col-3 p-1">
                                                    @if($position->sign->pilot && $position->sign->pilot->profile && $position->sign->pilot->profile->file_id)
                                                        <div class="img_with_hover">
                                                            <img src="{{ url('public/driver/thumb/', $position->sign->pilot->profile->file->path) }}" class="img-fluid thumb">
                                                            <img src="{{ url('public/driver/thumb/', $position->sign->pilot->profile->file->path) }}" class="img-fluid hovered">
                                                        </div>
                                                        {{-- <img src="{{ url('public/driver/thumb/', $position->sign->pilot->profile->file->path) }}" class="img-fluid thumb"> --}}
                                                    @elseif($position->sign->pilot_email && $position->sign->pilotSimple && $position->sign->pilotSimple->file_id)
                                                        <div class="img_with_hover">
                                                            <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                            <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid hovered">
                                                        </div>
                                                        {{-- <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid thumb"> --}}
                                                    @else
                                                        <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                                    @endif
                                                </div>
                                                <div class="col-6 p-0 pl-1"> 
                                                    @if($position->user)
                                                        @if($position->user->profile->show_name && $position->user->profile->show_lastname)
                                                            <a href="{{ route('kierowca', [$position->user->id, str_slug($position->user->profile->name.'-'.$position->user->profile->lastname)]) }}">
                                                        @elseif($position->user->profile->show_lastname)
                                                            <a href="{{ route('kierowca', [$position->user->id, $position->user->profile->lastname]) }}">
                                                        @else
                                                            <a href="{{ route('kierowca', $position->user->id) }}">
                                                        @endif
                                                            {{ $position->user->profile->name }} {{ $position->user->profile->lastname }}
                                                        </a>
                                                    @else
                                                        {{ $position->sign->name }} {{ $position->sign->lastname }}
                                                    @endif
                                                    <br>
                                                    @if($position->sign->pilot && $position->sign->pilot->profile)
                                                        <small><strong>Pilot:</strong>
                                                        @if($position->sign->pilot->profile->show_name && $position->sign->pilot->profile->show_lastname)
                                                            <a href="{{ route('pilot', [$position->sign->pilot->id, str_slug($position->sign->pilot->profile->name.'-'.$position->sign->pilot->profile->lastname)]) }}">
                                                        @elseif($position->sign->pilot->profile->show_lastname)
                                                            <a href="{{ route('pilot', [$position->sign->pilot->id, $position->sign->pilot->profile->lastname]) }}">
                                                        @else
                                                            <a href="{{ route('pilot', $position->sign->pilot->id) }}">
                                                        @endif
                                                            {{ $position->sign->pilot_name }} {{ $position->sign->pilot_lastname }}
                                                        </a></small>
                                                    @else
                                                        <small><strong>Pilot:</strong> {{ $position->sign->pilot_name }} {{ $position->sign->pilot_lastname }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </h6>
                                        <h6 class="m-0 col-2 text-left px-1">
                                            <div class="d-flex align-items-center"> 
                                                <div class="col-sm-7 p-1">
                                                    @if($position->sign->car && $position->sign->car->file_id)
                                                        <div class="img_with_hover">
                                                            <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid thumb">
                                                            <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid hovered">
                                                        </div>
                                                        {{-- <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid thumb"> --}}
                                                    @else
                                                        <img src="{{ url('images/car.png') }}" class="img-fluid thumb">
                                                    @endif
                                                </div>
                                                <div class="col-sm-5 pl-1"> 
                                                    {{ $position->sign->marka }} {{ $position->sign->model }}
                                                </div>
                                            </div>
                                        </h6>
                                        <div class="m-0 col-5 d-flex justify-content-start p-0">
                                            @foreach($race->rounds as $round)
                                                @php
                                                    $round_points = $position->sign->round_points($round);
                                                @endphp
                                                <h6 class="m-0 col-2 text-center">
                                                    <small>{{ $round_points }} pkt.</small>
                                                </h6>
                                            @endforeach
                                        </div>
                                        <h6 class="m-0 col-1 text-right px-2">
                                            <div class="d-flex justify-content-between"> 
                                                <div class="col text-center p-0">{{ $position->rp }} pkt.</div>
                                                <div class="col text-center p-0">
                                                @if($before_points != $position->rp)
                                                    @php
                                                        $rank++;
                                                    @endphp
                                                @endif

                                                {{ $rank }}

                                                @php
                                                    $before_points = $position->rp;
                                                @endphp
                                                </div>
                                            </div>
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