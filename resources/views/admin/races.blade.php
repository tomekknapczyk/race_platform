@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Rajdy
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newRace">Dodaj nowy rajd</button>
                </div>
                <div class="card-body">
                    @foreach($races as $race)
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h3><a href="{{ url('race', $race->id) }}" class="text-dark">{{ $race->name }}</a></h3>
                            <div>
                                <a href="{{ url('race', $race->id) }}" class="btn btn-sm btn-secondary">Zobacz</a>
                                <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editRace" 
                                    data-text='{"id":"{{ $race->id }}", "name":"{{ $race->name }}"}'
                                    >Edytuj nazwę</button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteRace" data-id="{{ $race->id }}">Usuń</button>
                                <a href="{{ url('rank', $race->id) }}" class="btn btn-sm btn-success">Ranking</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            @foreach($race->rounds as $round)
                                @if(!$round->startList)
                                    <a href="{{ url('round', $round->id) }}" class="btn btn-sm">{{ $round->name }} - zgłoszenia</a>
                                @else
                                    <a href="{{ url('list', $round->id) }}" class="btn btn-sm">{{ $round->name }} - lista startowa</a>
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

@include('admin.modals.newRace')
@include('admin.modals.editRace')
@include('admin.modals.deleteRace')
@endsection