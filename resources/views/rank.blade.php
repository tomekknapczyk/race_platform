@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark text-center">
                    <h3>Ranking {{ $race->name }}</h3>
                </div>
                <div class="card-body">
                    @foreach($race->klasy() as $klasa)
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
                                        <h6 class="m-0 col-2">
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
                            @foreach($race->klasa_rank($klasa) as $position)
                                <div class="row justify-content-between align-items-center flex-wrap">
                                    <h6 class="m-0 col">
                                        {{ $loop->iteration }}.
                                    </h6>
                                    <h6 class="m-0 col-2 text-left">
                                        {{ $position->sign->name }} {{ $position->sign->lastname }}<br>
                                    </h6>
                                    <h6 class="m-0 col-2 text-left">
                                        {{ $position->sign->marka }} {{ $position->sign->model }}<br>
                                    </h6>
                                    <div class="m-0 col-5 d-flex justify-content-start">
                                        @foreach($race->rounds as $round)
                                            <h6 class="m-0 col-2">
                                                <small>{{ $position->sign->round_points($round->id) }} pkt.</small>
                                            </h6>
                                        @endforeach
                                    </div>
                                    <h6 class="m-0 col text-right">
                                        {{ $position->sign->points() }} pkt.
                                    </h6>
                                    <h6 class="m-0 col text-center">
                                        @if($before_points != $position->sign->points())
                                            @php
                                                $rank++;
                                            @endphp
                                        @endif

                                        {{ $rank }}

                                        @php
                                            $before_points = $position->sign->points();
                                        @endphp
                                    </h6>
                                    <hr class="col-12 p-0 my-2">
                                </div>
                            @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection