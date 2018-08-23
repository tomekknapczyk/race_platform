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
                            @if(!$round->startList)
                                <h3 class="col-sm-4"><a href="{{ url('round', $round->id) }}" class="text-dark">{{ $round->name }}</a> <small>(max. {{ $round->max }} os.)</small></h3>
                            @else
                                <h3 class="col-sm-4"><a href="{{ url('list', $round->id) }}" class="text-dark">{{ $round->name }}</a> <small>(max. {{ $round->max }} os.)</small></h3>
                            @endif
                            <strong class="col-sm-2">{{ $round->date->format('Y-m-d') }}</strong>
                            <strong class="col-sm-2">
                                @if($round->file_id)
                                    <a href="{{ url('public/terms', $round->file->path) }}" class="btn btn-sm btn-secondary" target="_blank">Regulamin</a>
                                @endif
                            </strong>
                            <div class="col-sm-4 text-right">
                                @if(!$round->startList)
                                    <a href="{{ url('round', $round->id) }}" class="btn btn-sm btn-success">Zobacz zgłoszenia</a>
                                @else
                                    <a href="{{ url('list', $round->id) }}" class="btn btn-sm btn-success">Lista startowa</a>
                                @endif
                                <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editRound" 
                                    data-text='{"id":"{{ $round->id }}", "name":"{{ $round->name }}", "date":"{{ $round->date->format('Y-m-d') }}", "max":"{{ $round->max }}", "price":"{{ $round->price }}", "advance":"{{ $round->advance }}"}'
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