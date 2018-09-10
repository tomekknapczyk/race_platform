@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-dark">
                    <div class="card-header bg-yellow">
                        Terminarz
                    </div>
                    <div class="card-body lista">
                        @if($rounds->count())
                            @foreach($rounds as $round)
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h5 class="col-sm-8">
                                    {{ $round->name }} @if($round->sub_name) - {{ $round->sub_name }}@endif<br>
                                    <small>{{ $round->race->name }}</small>
                                </h5>
                                <h5 class="col-sm-4">
                                    {{ $round->date->format('Y-m-d H:i') }}
                                </h5>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection