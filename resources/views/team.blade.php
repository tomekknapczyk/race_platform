@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <h3>
                        {{ $team->title }}
                        @if(auth()->user()->team_admin())
                            <button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#editTeam">Edytuj</button>
                        @endif
                        <button class="btn btn-sm btn-danger float-right" data-toggle="modal" data-target="#leaveTeam">Opuść team</button>
                    </h3>
                    @if(auth()->user()->team_admin())
                        <small>Aby zmienić nazwę teamu, skontaktuj się z administratorem</small>
                    @endif
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

                        <div class="row drivers-container p-0">
                            <div class="col-sm-12 mt-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header bg-yellow">
                                        Kierowcy
                                    </div>
                                    <div class="card-body drivers">
                                        <div class="row justify-content-center">
                                            @if($team->members->count())
                                                @foreach($team->members as $member)
                                                    @if($member->user->driver)
                                                        <div class="col-md-4">
                                                            <div class="driver bg-white shadow pb-2">
                                                                @if($member->user->laurels->count())
                                                                    <div class="laurels">
                                                                        @if($member->user->laurel_place(1)->count())
                                                                            <div class="mb-1">
                                                                                <p class="m-0 laurel gold">{{ $member->user->laurel_place(1)->count() }}</p>
                                                                                @php
                                                                                    $klasa = '';
                                                                                    $show = true;
                                                                                @endphp
                                                                                @foreach($member->user->laurel_place(1)->get() as $laurel)
                                                                                    @php
                                                                                        if($laurel->klasa != $klasa){
                                                                                            $klasa = $laurel->klasa;
                                                                                            $show = true;
                                                                                        }
                                                                                        else
                                                                                            $show = false;
                                                                                    @endphp
                                                                                    @if($show)
                                                                                        <p class="m-0"></p>
                                                                                        <strong class="inline-block">{{ $klasa }}</strong>
                                                                                    @endif
                                                                                        <span>{{ $laurel->year }}</span>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                        @if($member->user->laurel_place(2)->count())
                                                                            <div class="mb-1">
                                                                                <p class="m-0 laurel silver">{{ $member->user->laurel_place(2)->count() }}</p>
                                                                                @php
                                                                                    $klasa = '';
                                                                                    $show = true;
                                                                                @endphp
                                                                                @foreach($member->user->laurel_place(2)->get() as $laurel)
                                                                                    @php
                                                                                        if($laurel->klasa != $klasa){
                                                                                            $klasa = $laurel->klasa;
                                                                                            $show = true;
                                                                                        }
                                                                                        else
                                                                                            $show = false;
                                                                                    @endphp
                                                                                    @if($show)
                                                                                        <p class="m-0"></p>
                                                                                        <strong class="inline-block">{{ $klasa }}</strong>
                                                                                    @endif
                                                                                        <span>{{ $laurel->year }}</span>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                        @if($member->user->laurel_place(3)->count())
                                                                            <div class="mb-1">
                                                                                <p class="m-0 laurel brown">{{ $member->user->laurel_place(3)->count() }}</p>
                                                                                @php
                                                                                    $klasa = '';
                                                                                    $show = true;
                                                                                @endphp
                                                                                @foreach($member->user->laurel_place(3)->get() as $laurel)
                                                                                    @php
                                                                                        if($laurel->klasa != $klasa){
                                                                                            $klasa = $laurel->klasa;
                                                                                            $show = true;
                                                                                        }
                                                                                        else
                                                                                            $show = false;
                                                                                    @endphp
                                                                                    @if($show)
                                                                                        <p class="m-0"></p>
                                                                                        <strong class="inline-block">{{ $klasa }}</strong>
                                                                                    @endif
                                                                                        <span>{{ $laurel->year }}</span>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif  
                                                                    </div>

                                                                    <div class="laurels-short">
                                                                        @if($member->user->laurel_place(1)->count())
                                                                            <span class="laurel gold mr-1">{{ $member->user->laurel_place(1)->count() }}</span>
                                                                        @endif
                                                                        @if($member->user->laurel_place(2)->count())
                                                                            <span class="laurel silver mr-1">{{ $member->user->laurel_place(2)->count() }}</span>
                                                                        @endif
                                                                        @if($member->user->laurel_place(3)->count())
                                                                            <span class="laurel brown">{{ $member->user->laurel_place(3)->count() }}</span>
                                                                        @endif  
                                                                    </div>
                                                                @endif
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
                                                                <h6 class="my-3 nazwisko" data-nazwisko="@if($member->user->profile->show_lastname){{ $member->user->profile->lastname }}@endif">@if($member->user->profile->show_name){{ $member->user->profile->name }}@endif @if($member->user->profile->show_lastname){{ $member->user->profile->lastname }}@endif @if(!$member->user->profile->show_lastname && !$member->user->profile->show_name) Anonim @endif</h6>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row drivers-container p-0">
                            <div class="col-sm-12 mt-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header bg-yellow">
                                        Piloci
                                    </div>
                                    <div class="card-body drivers">
                                        <div class="row justify-content-center">
                                            @if($team->members->count())
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
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row drivers-container p-0">
                            <div class="col-sm-12 mt-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header bg-yellow">
                                        Samochody
                                    </div>
                                    <div class="card-body d-flex flex-wrap align-items-start">
                                         @if($team->members->count())
                                            @foreach($team->members as $member)
                                                @if($member->user->driver)
                                                    @foreach($member->user->cars as $car)
                                                        <div class="col-6 d-flex justify-content-start align-items-center flex-wrap py-2">
                                                            <div class="col-md-5">
                                                                @if($car->file_id)
                                                                    <img src="{{ url('/public/car/thumb/', $car->file->path) }}" class="img-fluid">
                                                                @else
                                                                    <img src="{{ url('/images/car.png') }}" class="img-fluid">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-7">
                                                                <h5>
                                                                    {{ $car->marka }} {{ $car->model }}
                                                                    <br><small>{{ $car->ccm }}ccm</small>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->team_admin())
                            <div class="row">
                                <div class="col-sm-12 mt-4">
                                    <div class="card border-0 shadow">
                                        <div class="card-header bg-yellow">
                                            Wysłane zaproszenia
                                        </div>
                                        <div class="card-body drivers">
                                            <div class="row">
                                                @if($team->team_requests->count())
                                                    @foreach($team->team_requests as $request)
                                                    <div class="col-sm-12 d-flex justify-content-center mb-4">
                                                        <h4 class="col-md-6 m-0">
                                                            @if($request->user->driver)
                                                            <a href="{{ route('kierowca', $request->user->id) }}">
                                                                @if($request->user->profile->show_name){{ $request->user->profile->name }}@endif
                                                                @if($request->user->profile->show_lastname){{ $request->user->profile->lastname }}@endif
                                                                @if(!$request->user->profile->show_lastname && !$request->user->profile->show_name) Anonim @endif
                                                            </a>
                                                            @else
                                                            <a href="{{ route('pilot', $request->user->id) }}">
                                                                @if($request->user->profile->show_name){{ $request->user->profile->name }}@endif
                                                                @if($request->user->profile->show_lastname){{ $request->user->profile->lastname }}@endif
                                                                @if(!$request->user->profile->show_lastname && !$request->user->profile->show_name) Anonim @endif
                                                            </a>
                                                            @endif
                                                        </h4>
                                                        <div class="col-md-6 text-right">
                                                            <button class="btn btn-sm btn-outline-danger editBtn" data-toggle="modal" data-target="#deleteRequest" data-text='{"request_id":"{{ $request->id }}"}'>Usuń zaproszenie</button>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.newTeam')
@if(auth()->user()->team_admin())
    @include('modals.deleteRequest')
    @include('modals.editTeam')
@endif
@include('modals.leave')
@endsection