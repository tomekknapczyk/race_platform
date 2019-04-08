@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-dark">
                    <div class="card-header bg-yellow">
                        Przyszłe rajdy
                    </div>
                    <div class="card-body lista">
                        @if($rounds->count())
                            @foreach($rounds as $round)
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h5 class="col-md-8">
                                    <a href="{{ route('rajd', $round->id) }}">{{ $round->name }} @if($round->sub_name) - {{ $round->sub_name }}@endif</a><br>
                                    <small>{{ $round->race->name }}</small>
                                </h5>
                                <h6 class="col-md-4">
                                    {{ $round->date->format('Y-m-d H:i') }}
                                </h6>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-10 mt-5">
                <div class="card border-dark">
                    <div class="card-header bg-yellow">
                        Minione rajdy
                    </div>
                    <div class="card-body lista">
                        @if($rounds_old->count())
                            @foreach($rounds_old as $round)
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h5 class="col-md-8">
                                    <a href="{{ route('rajd', $round->id) }}">{{ $round->name }} @if($round->sub_name) - {{ $round->sub_name }}@endif</a><br>
                                    <small>{{ $round->race->name }}</small>
                                </h5>
                                <h6 class="col-md-4">
                                    {{ $round->date->format('Y-m-d H:i') }}
                                </h6>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection