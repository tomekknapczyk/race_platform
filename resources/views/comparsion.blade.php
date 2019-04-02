@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Porównanie wyników w rundzie {{ $round->name }} {{ $round->subname}}
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <div class="@if($c3) col-xl-4 @else col-lg-6 @endif">
                            @if($c1->user && $c1->user->profile && $c1->user->profile->file_id)
                                <img src="{{ url('public/driver/thumb/', $c1->user->profile->file->path) }}" class="img-fluid thumb-bigger">
                            @else
                                <img src="{{ url('images/driver.png') }}" class="img-fluid thumb-bigger">
                            @endif

                            <div class="text-center">
                                @if($c1->user && $c1->user->profile)
                                    <a href="{{ route('kierowca', $c1->user->id) }}">
                                        {{ $c1->name }} {{ $c1->lastname }}
                                    </a>
                                @else
                                    {{ $c1->name }} {{ $c1->lastname }}
                                @endif
                                <br>
                                @if($c1->pilot && $c1->pilot->profile)
                                    <small><strong>Pilot:</strong>
                                    <a href="{{ route('pilot', $c1->pilot->id) }}">
                                        {{ $c1->pilot_name }} {{ $c1->pilot_lastname }}
                                    </a></small>
                                @else
                                    <small><strong>Pilot:</strong> {{ $c1->pilot_name }} {{ $c1->pilot_lastname }}</small>
                                @endif
                                @if($c1->team)
                                    <br>
                                    <small><strong>Team:</strong> <a href="{{ route('team', $c1->team->id) }}">{{ $c1->team->title }}</a></small>
                                @else
                                    <br>
                                    <small><strong>Team:</strong> -- </small>
                                @endif
                            </div>

                            @foreach($oesy as $os)
                                <div class="card">
                                    <h5 class="text-center card-header bg-yellow py-1">OS {{ $loop->iteration}}</h5>
                                    <div class="col-sm-12 lista bg-secondary text-white">
                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Łączny czas</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c1']['brutto'] == $os['brutto']) bg-success @else bg-danger @endif">
                                                {{ $os['c1']['brutto'] }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Kara</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c1']['penalty'] == $os['penalty']) bg-success @else bg-danger @endif">
                                                {{ substr($os['c1']['penalty'],3,5) }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Czas reakcji</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c1']['reaction'] == $os['reaction']) bg-success @else bg-danger @endif">
                                                {{ $os['c1']['reaction'] }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Średnia prędkość</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c1']['speed'] == $os['speed']) bg-success @else bg-danger @endif">
                                                {{ $os['c1']['speed'] }}km/h
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Strata do lidera w generalce</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c1']['leading_lose'] == $os['leading_lose']) bg-success @else bg-danger @endif">
                                                {{ $os['c1']['leading_lose'] }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Pozycja w klasie</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center">
                                                {{ $c1->klasa }} : {{ $c1->total_class_rank($round->id) }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Pozycja w generalce</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c1']['total_rank'] == $os['total_rank']) bg-success @else bg-danger @endif">
                                                {{ $os['c1']['total_rank'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="@if($c3) col-xl-4 @else col-lg-6 @endif">
                            @if($c2->user && $c2->user->profile && $c2->user->profile->file_id)
                                <img src="{{ url('public/driver/thumb/', $c2->user->profile->file->path) }}" class="img-fluid thumb-bigger">
                            @else
                                <img src="{{ url('images/driver.png') }}" class="img-fluid thumb-bigger">
                            @endif

                            <div class="text-center">
                                @if($c2->user && $c2->user->profile)
                                    <a href="{{ route('kierowca', $c2->user->id) }}">
                                        {{ $c2->name }} {{ $c2->lastname }}
                                    </a>
                                @else
                                    {{ $c2->name }} {{ $c2->lastname }}
                                @endif
                                <br>
                                @if($c2->pilot && $c2->pilot->profile)
                                    <small><strong>Pilot:</strong>
                                    <a href="{{ route('pilot', $c2->pilot->id) }}">
                                        {{ $c2->pilot_name }} {{ $c2->pilot_lastname }}
                                    </a></small>
                                @else
                                    <small><strong>Pilot:</strong> {{ $c2->pilot_name }} {{ $c2->pilot_lastname }}</small>
                                @endif
                                @if($c2->team)
                                    <br>
                                    <small><strong>Team:</strong> <a href="{{ route('team', $c2->team->id) }}">{{ $c2->team->title }}</a></small>
                                @else
                                    <br>
                                    <small><strong>Team:</strong> -- </small>
                                @endif
                            </div>

                            @foreach($oesy as $os)
                                <div class="card">
                                    <h5 class="text-center card-header bg-yellow py-1">OS {{ $loop->iteration}}</h5>
                                    <div class="col-sm-12 lista bg-secondary text-white">
                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Łączny czas</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c2']['brutto'] == $os['brutto']) bg-success @else bg-danger @endif">
                                                {{ $os['c2']['brutto'] }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Kara</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c2']['penalty'] == $os['penalty']) bg-success @else bg-danger @endif">
                                                {{ substr($os['c2']['penalty'],3,5) }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Czas reakcji</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c2']['reaction'] == $os['reaction']) bg-success @else bg-danger @endif">
                                                {{ $os['c2']['reaction'] }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Średnia prędkość</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c2']['speed'] == $os['speed']) bg-success @else bg-danger @endif">
                                                {{ $os['c2']['speed'] }}km/h
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Strata do lidera w generalce</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c2']['leading_lose'] == $os['leading_lose']) bg-success @else bg-danger @endif">
                                                {{ $os['c2']['leading_lose'] }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Pozycja w klasie</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center">
                                                {{ $c2->klasa }} : {{ $c2->total_class_rank($round->id) }}
                                            </p>
                                        </div>

                                        <div class="row flex-wrap justify-content-between border-bottom">
                                            <p class="m-0 py-1 px-2 w-50 small">Pozycja w generalce</p>
                                            <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c2']['total_rank'] == $os['total_rank']) bg-success @else bg-danger @endif">
                                                {{ $os['c2']['total_rank'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($c3)
                            <div class="col-xl-4">
                                @if($c3->user && $c3->user->profile && $c3->user->profile->file_id)
                                    <img src="{{ url('public/driver/thumb/', $c3->user->profile->file->path) }}" class="img-fluid thumb-bigger">
                                @else
                                    <img src="{{ url('images/driver.png') }}" class="img-fluid thumb-bigger">
                                @endif

                                <div class="text-center">
                                    @if($c3->user && $c3->user->profile)
                                        <a href="{{ route('kierowca', $c3->user->id) }}">
                                            {{ $c3->name }} {{ $c3->lastname }}
                                        </a>
                                    @else
                                        {{ $c3->name }} {{ $c3->lastname }}
                                    @endif
                                    <br>
                                    @if($c3->pilot && $c3->pilot->profile)
                                        <small><strong>Pilot:</strong>
                                        <a href="{{ route('pilot', $c3->pilot->id) }}">
                                            {{ $c3->pilot_name }} {{ $c3->pilot_lastname }}
                                        </a></small>
                                    @else
                                        <small><strong>Pilot:</strong> {{ $c3->pilot_name }} {{ $c3->pilot_lastname }}</small>
                                    @endif
                                    @if($c3->team)
                                        <br>
                                        <small><strong>Team:</strong> <a href="{{ route('team', $c3->team->id) }}">{{ $c3->team->title }}</a></small>
                                    @else
                                        <br>
                                        <small><strong>Team:</strong> -- </small>
                                    @endif
                                </div>

                                @foreach($oesy as $os)
                                    <div class="card">
                                        <h5 class="text-center card-header bg-yellow py-1">OS {{ $loop->iteration}}</h5>
                                        <div class="col-sm-12 lista bg-secondary text-white">
                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Łączny czas</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c3']['brutto'] == $os['brutto']) bg-success @else bg-danger @endif">
                                                    {{ $os['c3']['brutto'] }}
                                                </p>
                                            </div>

                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Kara</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c3']['penalty'] == $os['penalty']) bg-success @else bg-danger @endif">
                                                    {{ substr($os['c3']['penalty'],3,5) }}
                                                </p>
                                            </div>

                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Czas reakcji</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c3']['reaction'] == $os['reaction']) bg-success @else bg-danger @endif">
                                                    {{ $os['c3']['reaction'] }}
                                                </p>
                                            </div>

                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Średnia prędkość</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c3']['speed'] == $os['speed']) bg-success @else bg-danger @endif">
                                                    {{ $os['c3']['speed'] }}km/h
                                                </p>
                                            </div>

                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Strata do lidera w generalce</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c3']['leading_lose'] == $os['leading_lose']) bg-success @else bg-danger @endif">
                                                    {{ $os['c3']['leading_lose'] }}
                                                </p>
                                            </div>

                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Pozycja w klasie</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center">
                                                    {{ $c3->klasa }} : {{ $c3->total_class_rank($round->id) }}
                                                </p>
                                            </div>

                                            <div class="row flex-wrap justify-content-between border-bottom">
                                                <p class="m-0 py-1 px-2 w-50 small">Pozycja w generalce</p>
                                                <p class="m-0 py-1 px-2 w-50 d-flex justify-content-center align-items-center @if($os['c3']['total_rank'] == $os['total_rank']) bg-success @else bg-danger @endif">
                                                    {{ $os['c3']['total_rank'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection