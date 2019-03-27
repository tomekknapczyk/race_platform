@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 overflow-auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow text-center">
                    <h3>Klasyfikacja Generalna: {{ $race->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between align-items-center flex-wrap">
                        <h6 class="m-0 col text-left p-0 pl-1 max-w-40">
                            LP
                        </h6>
                        <h6 class="m-0 col-3 text-left px-1">
                            Nazwa Teamu
                        </h6>
                        <div class="m-0 col-5 d-flex justify-content-start p-0">
                            @foreach($race->rounds as $round)
                                <h6 class="m-0 col-2 text-center">
                                    <small>{{ $round->name }}</small>
                                </h6>
                            @endforeach
                        </div>
                        <h6 class="m-0 col-1 text-center px-2">
                            <p>PKT</p>
                        </h6>
                        <hr class="col-12 p-0">
                    </div>
                    <div class="lista"> 
                        @foreach($sorted_teams as $team)
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h6 class="m-0 col p-0 pl-1 max-w-40">
                                    {{ $loop->iteration }}.
                                </h6>
                                <h6 class="m-0 col-3 text-left px-1">
                                    <a href="{{ route('team', $team->id) }}">{{ $team->title }}</a>
                                </h6>
                                <div class="m-0 col-5 d-flex justify-content-start p-0">
                                    @foreach($race->rounds as $round)
                                        <h6 class="m-0 col-2 text-center">
                                            @if(isset($team['results']['rounds'][$round->id]))
                                                <small>{{ $team['results']['rounds'][$round->id]['points'] }} pkt.</small>
                                            @else
                                                <small> -- </small>
                                            @endif
                                        </h6>
                                    @endforeach
                                </div>
                                <h6 class="m-0 col-1 text-right px-2">
                                    <div class="d-flex justify-content-between"> 
                                        <div class="col text-center p-0">{{ $team['points'] }} pkt.</div>
                                    </div>
                                </h6>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection