@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-xs-width" id="sign-list">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('wyniki') }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }} @if($round->sub_name) - {{ $round->sub_name }}@endif
                    </div>
                    @if($round->details)
                        <a href="{{ $round->details }}" target="_blank" rel="nofollow" class="btn btn-info btn-sm">Szczegółowe wyniki</a>
                    @endif
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
                        <button class="search-team btn btn-warning m-1">Teamy</button>
                        @if($accreditations->count())
                            <button class="search-press btn btn-warning m-1">Media</button>
                        @endif
                    </div>
                </div>
                <div class="card-body list wszyscy">
                    @if($is_someone)
                        @foreach($class as $klasa)
                        <div id="{{ $klasa }}-lista">
                            <h2 class="text-center mt-4 mb-3 text-uppercase klasa" data-klasa="{{ $klasa }}">..:: {{ $klasa }} ::..</h2>
                            <div class="lista list"> 
                                @foreach($endPositions->where('klasa', $klasa) as $position)
                                    <div class="row justify-content-between align-items-center flex-wrap py-2">
                                        <div class="col-1 p-0 pr-1">
                                            @if($position->user && $position->user->profile->file_id)
                                                <div class="img_with_hover">
                                                    <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid thumb">
                                                    <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid hovered">
                                                </div>
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
                                            @elseif($position->sign->pilot_email && $position->sign->pilotSimple && $position->sign->pilotSimple->file_id)
                                                <div class="img_with_hover">
                                                    <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                    <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid hovered">
                                                </div>
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
                                            @if($position->sign->team)
                                                <br>
                                                <small><strong>Team:</strong> <a href="{{ route('team',$position->sign->team->id) }}">{{ $position->sign->team->title }}</a></small>
                                            @endif
                                        </h6>
                                        <div class="col-2 p-0">
                                            @if($position->sign->car && $position->sign->car->file_id)
                                                <div class="img_with_hover">
                                                    <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid thumb">
                                                    <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid hovered">
                                                </div>
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
                        </div>
                        @endforeach
                    @endif
                </div>

                @if($accreditations->count())
                    <div class="card-body pb-5 press" style="display: none;">
                        <h2 class="text-center mt-4 mb-3 text-uppercase klasa" data-klasa="media">..:: Media ::..</h2>
                        @foreach($accreditations as $accreditation)
                        <div class="row justify-content-start align-items-center flex-wrap py-2 mb-3">
                            <div class="col-12 col-lg-3"></div>
                            <div class="col-6 col-lg-2">
                                <a href="{{ route('redakcja', $accreditation[0]->user->id) }}"> 
                                    @if($accreditation[0]->user && $accreditation[0]->user->profile->file_id)
                                        <div class="img_with_hover">
                                            <img src="{{ url('public/driver/thumb/', $accreditation[0]->user->profile->file->path) }}" class="img-fluid">
                                            <img src="{{ url('public/driver/thumb/', $accreditation[0]->user->profile->file->path) }}" class="img-fluid hovered">
                                        </div>
                                    @else
                                        <img src="{{ url('images/press.png') }}" class="img-fluid">
                                    @endif
                                </a>
                            </div>
                            <h3 class="col-6 col-lg-3 text-center mt-4 mb-3 text-uppercase">
                                <a href="{{ route('redakcja', $accreditation[0]->user->id) }}" class="text-dark"> 
                                    {{ $accreditation[0]->user->profile->name }}
                                </a>
                            </h3>
                        </div>
                        @endforeach
                    </div>
                @endif

                <div class="card-body teamy" style="display: none;">
                    @if($is_someone)
                        @foreach($teams as $team)
                            <div>
                                <a href="{{ route('team',$team->id) }}" class="d-flex align-items-center justify-content-center text-dark mb-3" @if(!$loop->first) style="margin-top: 100px;" @else style="margin-top: 1.5rem;"  @endif>
                                    @if($team->file_id)
                                        <img src="{{ url('/public/team/thumb/', $team->file->path) }}" class="img-fluid mr-2" style="width: 100px;">
                                    @endif
                                    <h2 class="text-center mb-0 text-uppercase">..:: {{ $team->title }} ::..</h2>
                                </a>
                                <div class="lista"> 
                                    @foreach($class as $klasa)
                                        @foreach($endPositions->where('klasa', $klasa) as $position)
                                            @if($position->team && $position->team->title == $team->title)
                                                <div class="row justify-content-between align-items-center flex-wrap py-2">
                                                    <div class="col-1 p-0 pr-1 d-flex align-items-center justify-content-between">
                                                        @if($position->user && $position->user->profile->file_id)
                                                            <div class="img_with_hover">
                                                                <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid thumb">
                                                                <img src="{{ url('public/driver/thumb/', $position->user->profile->file->path) }}" class="img-fluid hovered">
                                                            </div>
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
                                                        @elseif($position->sign->pilot_email && $position->sign->pilotSimple && $position->sign->pilotSimple->file_id)
                                                            <div class="img_with_hover">
                                                                <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                                <img src="{{ url('public/pilot/thumb/', $position->sign->pilotSimple->file->path) }}" class="img-fluid hovered">
                                                            </div>
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
                                                        @if($position->sign->team)
                                                            <br>
                                                            <small><strong>Team:</strong> <a href="{{ route('team',$position->sign->team->id) }}">{{ $position->sign->team->title }}</a></small>
                                                        @endif
                                                    </h6>
                                                    <div class="col-2 p-0">
                                                        @if($position->sign->car && $position->sign->car->file_id)
                                                            <div class="img_with_hover">
                                                                <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid thumb">
                                                                <img src="{{ url('public/car/thumb/', $position->sign->car->file->path) }}" class="img-fluid hovered">
                                                            </div>
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
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
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