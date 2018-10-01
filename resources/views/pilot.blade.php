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
                                <div class="col-md-9">
                                    <h3 class="text-uppercase">
                                        @if($user->profile->show_name){{ $user->profile->name }}@endif
                                        @if($user->profile->show_lastname){{ $user->profile->lastname }}@endif
                                        @if(!$user->profile->show_lastname && !$user->profile->show_name) Anonim @endif
                                    </h3>
                                    <p>@if($user->profile->show_email){{ $user->email }}@endif</p>
                                    <strong>O mnie:</strong>
                                    {!! $user->profile->desc !!}
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
                                            <h6 class="col-md-4 m-0">
                                                {{ $race->startList->round->name }} @if($race->startList->round->sub_name) - {{ $race->startList->round->sub_name }}@endif<br>
                                                <small>{{ $race->startList->round->race->name }}</small></h5>
                                            </h6>
                                            <h6 class="col-md-3 m-0">
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
                                            <h6 class="col-md-3 m-0">
                                                {{ $race->sign->marka }} {{ $race->sign->model }}<br>
                                                <small>{{ $race->sign->ccm }}ccm</small>
                                            </h6>
                                            <h6 class="col-md-2 m-0">
                                                Miejsce: {{ $race->rank() }}
                                            </h6>
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
@endsection