@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12 pb-5">
            <div class="card border-dark" id="sign-list">
                <div class="card-header bg-yellow text-center">
                    <h3>{{ $round->race->name }}</a> : {{ $round->name }} - Lista zgłoszeń</h3>
                </div>
                <button class="switch-img btn btn-default">UKRYJ ZDJĘCIA</button>
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
                <div class="card-body pb-5 list wszyscy">
                    @php
                        $numer = 0;
                    @endphp
                    @foreach($klasy as $klasa)
                    <div id="{{ $klasa }}-lista">
                        <h2 class="text-center mt-4 mb-3 text-uppercase klasa" data-klasa="{{ $klasa }}">..:: {{ $klasa }} ::..</h2>
                        <div class="lista list">
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
                                        @elseif($sign['sign']->pilot_email && $sign['sign']->pilotSimple && $sign['sign']->pilotSimple->file_id)
                                            <div class="img_with_hover">
                                                <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid hovered">
                                            </div>
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
                                            <small><strong>Team:</strong> <a href="{{ route('team',$sign['sign']->team->id) }}">{{ $sign['sign']->team->title }}</a></small>
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

                <div class="card-body pb-5 teamy" style="display: none;">
                    @foreach($teams as $team)
                    <div>
                        <a href="{{ route('team',$team['team']->id) }}" class="d-flex align-items-center justify-content-center text-dark mb-3" @if(!$loop->first) style="margin-top: 100px;" @else style="margin-top: 1.5rem;"  @endif>
                            @if($team['team']->file_id)
                                <img src="{{ url('/public/team/thumb/', $team['team']->file->path) }}" class="img-fluid mr-2" style="width: 100px;">
                            @endif
                            <h2 class="text-center mb-0 text-uppercase">..:: {{ $team['team']->title }} ::..</h2>
                        </a>
                        {{-- <h2 class="text-center mb-3 text-uppercase" @if(!$loop->first) style="margin-top: 100px;" @else style="margin-top: 1.5rem;"  @endif>..:: {{ $team->title }} ::..</h2> --}}
                        <div class="lista">
                            @foreach($klasy as $klasa)
                                @foreach($class[$klasa] as $sign)
                                    @if($sign['sign']->team && $sign['sign']->team->title == $team['team']->title)
                                    <div class="row justify-content-between align-items-center flex-wrap py-2">
                                        <h6 class="m-0 col-1 py-0 px-1 d-none d-md-block text-center">
                                            {{ $klasa }}
                                        </h6>
                                        <h6 class="m-0 col-12 p-0 d-block d-md-none text-center">
                                            {{ $klasa }} 
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
                                            @elseif($sign['sign']->pilot_email && $sign['sign']->pilotSimple && $sign['sign']->pilotSimple->file_id)
                                                <div class="img_with_hover">
                                                    <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid thumb">
                                                    <img src="{{ url('public/pilot/thumb/', $sign['sign']->pilotSimple->file->path) }}" class="img-fluid hovered">
                                                </div>
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
                                                <small><strong>Team:</strong> <a href="{{ route('team',$sign['sign']->team->id) }}">{{ $sign['sign']->team->title }}</a></small>
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
                                    @endif
                                @endforeach
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
      valueNames: [{ attr: 'data-klasa', name: 'klasa' }]
    };

    var userList = new List('sign-list', options);
</script>
@endsection