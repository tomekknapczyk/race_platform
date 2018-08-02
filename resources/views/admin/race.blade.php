@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    <a href="{{ url('races') }}" class="text-white">Rajdy</a> : {{ $race->name }}
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newRound">Dodaj nową rundę</button>
                </div>
                <div class="card-body">
                    @foreach($race->rounds as $round)
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h3><a href="{{ url('round', $round->id) }}" class="text-dark">{{ $round->name }}</a></h3>
                            <strong>{{ $round->termin }}</strong>
                            <div>
                                <a href="{{ url('round', $round->id) }}" class="btn btn-sm btn-secondary">Zobacz</a>
                                <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editRound" 
                                    data-text='{"id":"{{ $round->id }}", "name":"{{ $round->name }}", "termin":"{{ $round->termin }}"}'
                                    >Edytuj</button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteRound" data-id="{{ $round->id }}">Usuń</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.newRound')
@include('admin.modals.editRound')
@include('admin.modals.deleteRound')
@endsection