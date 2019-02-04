@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <h3>
                        {{ $team->title }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row shadow p-3 bg-white">
                            <div class="col-md-4">
                                @if($team->file_id)
                                    <img src="{{ url('/public/team', $team->file->path) }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <strong>O teamie:</strong>
                                {!! $team->text !!}
                            </div>
                        </div>

                        @if($team->members->count())
                            <div class="row drivers-container p-0">
                                <div class="col-sm-12 mt-4">
                                    <div class="card border-0 shadow">
                                        <div class="card-header bg-yellow">
                                            Kierowcy
                                        </div>
                                        <div class="card-body drivers">
                                            <div class="row justify-content-center">
                                                @foreach($team->members as $member)
                                                    @if($member->user->driver)
                                                        <div class="col-md-4">
                                                            <div class="driver bg-white shadow pb-2">
                                                                @if($member->user->profile->show_name && $member->user->profile->show_lastname)
                                                                    <a href="{{ route('kierowca', [$member->user->id, str_slug($member->user->profile->name.'-'.$member->user->profile->lastname)]) }}">
                                                                @elseif($member->user->profile->show_lastname)
                                                                    <a href="{{ route('kierowca', [$member->user->id, $member->user->profile->lastname]) }}">
                                                                @else
                                                                    <a href="{{ route('kierowca', $member->user->id) }}">
                                                                @endif
                                                                @if($member->user->profile->file_id)
                                                                    <img src="{{ url('/public/driver/thumb/', $member->user->profile->file->path) }}" class="img-fluid">
                                                                @else
                                                                    <img src="{{ url('/images/driver.png') }}" class="img-fluid">
                                                                @endif
                                                                <h6 class="mt-2 mb-0 nazwisko text-center">@if($member->user->profile->show_name){{ $member->user->profile->name }}@endif @if($member->user->profile->show_lastname){{ $member->user->profile->lastname }}@endif @if(!$member->user->profile->show_lastname && !$member->user->profile->show_name) Anonim @endif</h6>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($team->members->count())
                            <div class="row drivers-container p-0">
                                <div class="col-sm-12 mt-4">
                                    <div class="card border-0 shadow">
                                        <div class="card-header bg-yellow">
                                            Piloci
                                        </div>
                                        <div class="card-body drivers">
                                            <div class="row justify-content-center">
                                                @foreach($team->members as $member)
                                                    @if(!$member->user->driver)
                                                        <div class="col-md-4">
                                                            <div class="driver bg-white shadow pb-2">
                                                                @if($member->user->profile->show_name && $member->user->profile->show_lastname)
                                                                    <a href="{{ route('pilot', [$member->user->id, str_slug($member->user->profile->name.'-'.$member->user->profile->lastname)]) }}">
                                                                @elseif($member->user->profile->show_lastname)
                                                                    <a href="{{ route('pilot', [$member->user->id, $member->user->profile->lastname]) }}">
                                                                @else
                                                                    <a href="{{ route('pilot', $member->user->id) }}">
                                                                @endif
                                                                @if($member->user->profile->file_id)
                                                                    <img src="{{ url('/public/driver/thumb/', $member->user->profile->file->path) }}" class="img-fluid">
                                                                @else
                                                                    <img src="{{ url('/images/driver.png') }}" class="img-fluid">
                                                                @endif
                                                                <h6 class="mt-2 mb-0 nazwisko text-center">@if($member->user->profile->show_name){{ $member->user->profile->name }}@endif @if($member->user->profile->show_lastname){{ $member->user->profile->lastname }}@endif @if(!$member->user->profile->show_lastname && !$member->user->profile->show_name) Anonim @endif</h6>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!$team->members->count())
                        <h3 class="text-center mt-4">Aktualnie brak załóg</h3>
                        @endif

                        <div class="row drivers-container p-0">
                            <div class="col-sm-12 mt-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header bg-yellow">
                                        Wyniki
                                    </div>
                                    <div class="card-body drivers">
                                        @if($team->results())
                                            @foreach($team->results() as $round)
                                                <div class="mb-3">
                                                    <h6 class="m-0">
                                                        {{ $round['round']->name }} @if($round['round']->sub_name) - {{ $round['round']->sub_name }}@endif<br>
                                                        <small>{{ $round['round']->race->name }}</small></h5>
                                                        <hr>
                                                    </h6>
                                                    @foreach($round['crew'] as $crew)
                                                        <div class="row d-flex align-items-center justify-content-between flex-wrap m-0 py-2">
                                                            <h6 class="col-md-3 m-0">
                                                                {{ $crew->sign->name }} {{ $crew->sign->lastname }}<br>
                                                                @if($crew->sign->pilot)
                                                                    <small><strong>Pilot:</strong>
                                                                    @if($crew->sign->pilot->profile->show_name && $crew->sign->pilot->profile->show_lastname)
                                                                        <a href="{{ route('pilot', [$crew->sign->pilot->id, str_slug($crew->sign->pilot->profile->name.'-'.$crew->sign->pilot->profile->lastname)]) }}">
                                                                    @elseif($crew->sign->pilot->profile->show_lastname)
                                                                        <a href="{{ route('pilot', [$crew->sign->pilot->id, $crew->sign->pilot->profile->lastname]) }}">
                                                                    @else
                                                                        <a href="{{ route('pilot', $crew->sign->pilot->id) }}">
                                                                    @endif
                                                                        {{ $crew->sign->pilot_name }} {{ $crew->sign->pilot_lastname }}
                                                                    </a></small>
                                                                @else
                                                                    <small><strong>Pilot:</strong> {{ $crew->sign->pilot_name }} {{ $crew->sign->pilot_lastname }}</small>
                                                                @endif
                                                            </h6>
                                                            <h6 class="col-md-3 m-0">
                                                                {{ $crew->sign->marka }} {{ $crew->sign->model }}<br>
                                                                <small>{{ $crew->sign->ccm }}ccm</small>
                                                            </h6>
                                                            <h6 class="col-md-2 m-0">
                                                                Klasa: {{ $crew->klasa }}
                                                            </h6>
                                                            <h6 class="col-md-2 m-0">
                                                                Miejsce: {{ $crew->rank() }}
                                                            </h6>
                                                            <h6 class="col-md-2 m-0">
                                                                Punkty: {{ $crew->points }}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection