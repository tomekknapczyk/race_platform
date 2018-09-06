@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Wyniki
                </div>
                <div class="card-body">
                    @foreach($races as $race)
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h3>{{ $race->name }}</h3>
                            <div>
                                <a href="{{ url('rank', $race->id) }}" class="btn btn-success">Klasyfikacja Roczna</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            @foreach($race->rounds as $round)
                                @if($round->startList)
                                    <a href="{{ url('runda', $round->id) }}" class="btn btn-sm">{{ $round->name }}</a>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection