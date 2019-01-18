@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-xs-width">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('wyniki') }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }} @if($round->sub_name) - {{ $round->sub_name }}@endif
                    </div>
                    @if($round->details)
                        <a href="{{ $round->details }}" target="_blank" rel="nofollow" class="btn btn-info btn-sm">Szczegółowe wyniki</a>
                    @endif
                </div>
                <div class="card-body">
                    @if($is_someone)
                        @foreach($class as $klasa)
                            <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                            <div class="lista"> 
                                @foreach($endPositions->where('klasa', $klasa) as $position)
                                    <div class="row justify-content-between align-items-center flex-wrap py-2">
                                        <div class="col-1 p-0 pr-1">
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
                                        <div class="col-1 p-0 pl-1">
                                            @if($position->sign->pilot && $position->sign->pilot->profile->file_id)
                                                <div class="img_with_hover">
                                                    <img src="{{ url('public/driver/thumb/', $position->sign->pilot->profile->file->path) }}" class="img-fluid thumb">
                                                    <img src="{{ url('public/driver/thumb/', $position->sign->pilot->profile->file->path) }}" class="img-fluid hovered">
                                                </div>
                                                {{-- <img src="{{ url('public/driver/thumb/', $position->sign->pilot->profile->file->path) }}" class="img-fluid thumb"> --}}
                                            @elseif($position->sign->pilotSimple && $position->sign->pilotSimple->file_id)
                                                <div class="img_with_hover">
                                                    <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                    <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid hovered">
                                                </div>
                                                {{-- <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid thumb"> --}}
                                            @else
                                                <img src="{{ url('images/driver.png') }}" class="img-fluid thumb">
                                            @endif
                                        </div>
                                        <h6 class="m-0 col-3">
                                            @if($position->user)
                                                @if($position->user->profile->show_name && $position->user->profile->show_lastname)
                                                    <a href="{{ route('kierowca', [$position->user->id, str_slug($position->user->profile->name.'-'.$position->user->profile->lastname)]) }}">
                                                @elseif($position->user->profile->show_lastname)
                                                    <a href="{{ route('kierowca', [$position->user->id, $position->user->profile->lastname]) }}">
                                                @else
                                                    <a href="{{ route('kierowca', $position->user->id) }}">
                                                @endif
                                                    {{ $position->sign->name }} {{ $position->sign->lastname }}
                                                </a>
                                            @else
                                                {{ $position->sign->name }} {{ $position->sign->lastname }}
                                            @endif
                                            <br>
                                            @if($position->sign->pilot)
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
                                        </h6>
                                        <div class="col-2 p-0">
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
                                        <h6 class="m-0 col-3">
                                            {{ $position->sign->marka }} {{ $position->sign->model }} - {{ $position->sign->ccm }}ccm<br>
                                            <small>@if($position->sign->turbo) <strong>Turbo</strong> @endif @if($position->sign->rwd) <strong>RWD</strong> @endif</small>
                                        </h6>
                                        <h6 class="m-0 col-2">
                                            Miejsce {{ $position->rank() }}
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