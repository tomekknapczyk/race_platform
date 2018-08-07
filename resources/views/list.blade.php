@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark text-center">
                    <h3>Lista startowa {{ $round->race->name }}</a> : {{ $round->name }}</h3>
                </div>
                <div class="card-body">
                    @if($round->startPositions()->count())
                        @foreach($round->klasy() as $klasa)
                            <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                                @foreach($round->startPositions()->where('klasa', $klasa) as $position)
                                    <div class="row justify-content-between align-items-center flex-wrap">
                                        <h6 class="m-0 col-1">
                                            {{ $loop->iteration }}.
                                        </h6>
                                        <h6 class="m-0 col-6 text-left">
                                            {{ $position->sign->name }} {{ $position->sign->lastname }}<br>
                                            <small><strong>Pilot:</strong> {{ $position->sign->pilot_name }} {{ $position->sign->pilot_lastname }}</small>
                                        </h6>
                                        <h6 class="m-0 col-5">
                                            {{ $position->sign->marka }} {{ $position->sign->model }} - {{ $position->sign->ccm }}ccm<br>
                                            <small>{{ $position->sign->rok }}r. @if($position->sign->turbo) / <strong>Turbo</strong> @endif @if($position->sign->rwd) / <strong>RWD</strong> @endif</small>
                                        </h6>
                                        <hr class="col-12 p-0 my-2">
                                    </div>
                                @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection