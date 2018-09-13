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
                    @foreach($klasy as $klasa)
                        @php
                            $before_points = 0;
                            $rank = 0;
                        @endphp
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <h6 class="m-0 col text-left">
                                    LP
                                </h6>
                                <h6 class="m-0 col-2 text-left">
                                    Imię i nazwisko
                                </h6>
                                <h6 class="m-0 col-2 text-left">
                                    Samochód
                                </h6>
                                <div class="m-0 col-5 d-flex justify-content-start">
                                    @foreach($race->rounds as $round)
                                        <h6 class="m-0 col-2 text-center">
                                            <small>{{ $round->name }}</small>
                                        </h6>
                                    @endforeach
                                </div>
                                <h6 class="m-0 col text-right">
                                    PKT
                                </h6>
                                <h6 class="m-0 col text-right">
                                    Miejsce
                                </h6>
                                <hr class="col-12 p-0">
                            </div>
                            <div class="lista"> 
                                @foreach($race->klasa_rank($klasa) as $position)
                                    <div class="row justify-content-between align-items-center flex-wrap py-2">
                                        <h6 class="m-0 col">
                                            {{ $loop->iteration }}.
                                        </h6>
                                        <h6 class="m-0 col-2 text-left">
                                            @if($position->user)
                                                @if($position->user->driver->show_name && $position->user->driver->show_lastname)
                                                    <a href="{{ route('kierowca', [$position->user->id, str_slug($position->user->driver->name.'-'.$position->user->driver->lastname)]) }}">
                                                @elseif($position->user->driver->show_lastname)
                                                    <a href="{{ route('kierowca', [$position->user->id, $position->user->driver->lastname]) }}">
                                                @else
                                                    <a href="{{ route('kierowca', $position->user->id) }}">
                                                @endif
                                                    {{ $position->user->driver->name }} {{ $position->user->driver->lastname }}
                                                </a>
                                            @else
                                                {{ $position->sign->name }} {{ $position->sign->lastname }}
                                            @endif
                                        </h6>
                                        <h6 class="m-0 col-2 text-left">
                                            {{ $position->sign->marka }} {{ $position->sign->model }}
                                        </h6>
                                        <div class="m-0 col-5 d-flex justify-content-start">
                                            @foreach($race->rounds as $round)
                                                @php
                                                    $round_points = $position->sign->round_points($round);
                                                @endphp
                                                <h6 class="m-0 col-2">
                                                    <small>{{ $round_points }} pkt.</small>
                                                </h6>
                                            @endforeach
                                        </div>
                                        <h6 class="m-0 col text-right">
                                            {{ $position->rp }} pkt.
                                        </h6>
                                        <h6 class="m-0 col text-center">
                                            @if($before_points != $position->rp)
                                                @php
                                                    $rank++;
                                                @endphp
                                            @endif

                                            {{ $rank }}

                                            @php
                                                $before_points = $position->rp;
                                            @endphp
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