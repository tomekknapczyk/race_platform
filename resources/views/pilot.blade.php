@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ route('piloci') }}" class="text-white">Piloci</a> :
                    @if($user->profile->show_name){{ $user->profile->name }}@endif
                    @if($user->profile->show_lastname){{ $user->profile->lastname }}@endif
                    @if(!$user->profile->show_lastname && !$user->profile->show_name) Anonim @endif

                    @auth
                        @if(auth()->user()->team_admin() && !$user->team())
                            <button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#sendRequest">Zaproś do swojego Teamu</button>
                        @endif
                    @endauth
                </div>
                <div class="card-body">
                        <div class="col-sm-12">
                            <div class="row shadow p-3 bg-white">
                                <div class="col-md-3">
                                    @if($user->profile->file_id)
                                        <img src="{{ url('/public/driver', $user->profile->file->path) }}" class="img-fluid">
                                    @else
                                        <img src="{{ url('/images/driver.png') }}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h3 class="text-uppercase">
                                        @if($user->profile->show_name){{ $user->profile->name }}@endif
                                        @if($user->profile->show_lastname){{ $user->profile->lastname }}@endif
                                        @if(!$user->profile->show_lastname && !$user->profile->show_name) Anonim @endif
                                    </h3>
                                    <p>@if($user->profile->show_email){{ $user->email }}@endif</p>
                                    @if($user->team())
                                        <p><strong>Team: <a href="{{ route('team', $user->team()->id) }}">{{ $user->team()->title }}</a></strong></p>
                                    @endif
                                    <strong>O mnie:</strong>
                                    {!! $user->profile->desc !!}
                                </div>
                                <div class="col-md-3">
                                    @if($user->laurel_place(1)->count() || $user->laurel_place(2)->count() || $user->laurel_place(3)->count())
                                        <h6 class="text-center">Laury</h6>
                                    @endif
                                    @if($user->laurel_place(1)->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel gold">{{ $user->laurel_place(1)->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($user->laurel_place(1)->get() as $laurel)
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
                                    @if($user->laurel_place(2)->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel silver">{{ $user->laurel_place(2)->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($user->laurel_place(2)->get() as $laurel)
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
                                    @if($user->laurel_place(3)->count())
                                        <div class="mb-1">
                                            <p class="m-0 laurel brown">{{ $user->laurel_place(3)->count() }}</p>
                                            @php
                                                $klasa = '';
                                                $show = true;
                                            @endphp
                                            @foreach($user->laurel_place(3)->get() as $laurel)
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
                            </div>
                            
                            <div class="card border-0 shadow mt-4">
                                <div class="card-header bg-yellow">
                                    Rajdy
                                </div>
                                <div class="card-body lista p-0">
                                    @if($user->pilot_races()->count())
                                        @foreach($user->pilot_races() as $race)
                                        <div class="row d-flex align-items-center justify-content-between flex-wrap m-0 py-3">
                                            <h6 class="col-lg-4 m-0">
                                                {{ $race->startList->round->name }} @if($race->startList->round->sub_name) - {{ $race->startList->round->sub_name }}@endif<br>
                                                <small>{{ $race->startList->round->race->name }}</small></h5>
                                            </h6>
                                            <h6 class="col-lg-2 m-0">
                                                @if($race->sign->user)
                                                    @if($race->sign->user->profile->show_name && $race->sign->user->profile->show_lastname)
                                                        <a href="{{ route('kierowca', [$race->sign->user->id, str_slug($race->sign->user->profile->name.'-'.$race->sign->user->profile->lastname)]) }}">
                                                    @elseif($race->sign->user->profile->show_lastname)
                                                        <a href="{{ route('kierowca', [$race->sign->user->id, $race->sign->user->profile->lastname]) }}">
                                                    @else
                                                        <a href="{{ route('kierowca', $race->sign->user->id) }}">
                                                    @endif
                                                        {{ $race->sign->name }} {{ $race->sign->lastname }}
                                                    </a>
                                                @else
                                                    {{ $race->sign->name }} {{ $race->sign->lastname }}
                                                @endif
                                                <br>
                                                <small><strong>Pilot:</strong> {{ $race->sign->pilot_name }} {{ $race->sign->pilot_lastname }}</small>
                                            </h6>
                                            <h6 class="col-lg-3 m-0">
                                                {{ $race->sign->marka }} {{ $race->sign->model }}<br>
                                                <small>{{ $race->sign->ccm }}ccm</small>
                                            </h6>
                                            <h6 class="col-lg-3 m-0 d-flex align-items-center justify-content-between details-btn">
                                                <div>
                                                    Poz. w klasie {{ $race->sign->klasa }} :: <strong>{{ $race->sign->total_class_rank($race->startList->round->id) }}</strong>
                                                    <br>
                                                    Poz. w generalce :: <strong>{{ $race->sign->total_rank($race->startList->round->id) }}</strong>
                                                </div>
                                                @if($race->sign->result($race->startList->round->id))
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        Więcej<span class="arrow_down"></span>
                                                    </div>
                                                @endif
                                            </h6>
                                            <div class="details col-sm-12 mt-2 overflow-auto" style="display: none;">
                                                @if($race->sign->result($race->startList->round->id))
                                                    <div class="fixed-width bg-white d-flex align-items-center small text-center py-1">
                                                        <div class="col-1 px-1">
                                                            <strong>Os</strong>
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            <strong>Łączny czas</strong>
                                                        </div>
                                                        <div class="col-1 px-1">
                                                            <strong>Kara</strong>
                                                        </div>
                                                        <div class="col-2 px-2">
                                                            <strong>Strata do lidera w klasyfikacji generalnej</strong>
                                                        </div>
                                                        <div class="col-1 px-1">
                                                            <strong>Czas reakcji</strong>
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            <strong>Średnia prędkość</strong>
                                                        </div>
                                                        <div class="col-1 px-1">
                                                            <strong>Poz. w {{ $race->sign->klasa }}</strong>
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            <strong>Poz. w generalce</strong>
                                                        </div>
                                                    </div>
                                                    <div class="lista bg-secondary text-white fixed-width"> 
                                                    @foreach($race->startList->round->osy as $os)
                                                        <div class="w-100 mx-0 py-2 row align-items-center text-monospace text-center">
                                                            <div class="col-1 px-1">
                                                                OS {{ $loop->iteration }}
                                                            </div>
                                                            <div class="col-2 px-1">
                                                                {{ $race->sign->os($os->id)->brutto }}
                                                            </div>
                                                            <div class="col-1 px-1">
                                                                {{ $race->sign->os($os->id)->penalty }}
                                                            </div>
                                                            <div class="col-2 px-1">
                                                                {{ $race->sign->os($os->id)->leading_lose }}
                                                            </div>
                                                            <div class="col-1 px-1">
                                                                {{ $race->sign->os($os->id)->reaction }}s
                                                            </div>
                                                            <div class="col-2 px-1">
                                                                {{ $race->sign->os($os->id)->speed }}km/h
                                                            </div>
                                                            <div class="col-1 px-1">
                                                                {{ $race->sign->os_class_rank($os->id) }}
                                                            </div>
                                                            <div class="col-2 px-1">
                                                                {{ $race->sign->os_rank($os->id) }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="fixed-width py-2 d-flex align-items-center border-top text-monospace text-center bg-dark text-white bg-dark text-white">
                                                        <div class="col-1 px-1">
                                                            Total
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            {{ $race->sign->result($race->startList->round->id)->brutto }}
                                                        </div>
                                                        <div class="col-1 px-1">
                                                            {{ $race->sign->result($race->startList->round->id)->penalty }}
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            {{ $race->sign->result($race->startList->round->id)->leading_lose }}
                                                        </div>
                                                        <div class="col-1 px-1">
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            {{ $race->sign->result($race->startList->round->id)->speed }}km/h
                                                        </div>
                                                        <div class="col-1 px-1">
                                                            {{ $race->sign->total_class_rank($race->startList->round->id) }}
                                                        </div>
                                                        <div class="col-2 px-1">
                                                            {{ $race->sign->total_rank($race->startList->round->id) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
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

@auth
    @if(auth()->user()->team_admin() && !$user->team())
        @include('modals.sendRequest')
    @endif
@endauth
@endsection