@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ url('races') }}" class="text-white">Rajdy</a> : {{ $race->name }}
                    {{-- <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newRound">Dodaj nową rundę</button> --}}
                    <a href="{{ url('newRound', $race->id) }}" class="btn btn-sm btn-primary float-right">Dodaj nową rundę</a>
                    <a href="{{ url('bk', $race->id) }}" class="btn btn-sm btn-info float-right mr-2">Badania kontrolne</a>
                </div>
                <div class="card-body">
                    @foreach($race->rounds as $round)
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            @if(!$round->startList)
                                <h3 class="col-md-3"><a href="{{ url('round', $round->id) }}" class="text-dark">{{ $round->name }}</a>
                                    <small>(max. {{ $round->max }} os.)<br>
                                        {{ $round->sub_name }}
                                    </small>
                                </h3>
                            @else
                                <h3 class="col-md-3"><a href="{{ url('list', $round->id) }}" class="text-dark">{{ $round->name }}</a>
                                    <small>(max. {{ $round->max }} os.)<br>
                                        {{ $round->sub_name }}
                                    </small>
                                </h3>
                            @endif
                            <strong class="col-md-2">{{ $round->date->format('Y-m-d') }}</strong>
                            <strong class="col-md-2">
                                @if($round->file_id)
                                    <a href="{{ url('public/terms', $round->file->path) }}" class="btn btn-sm btn-secondary" target="_blank">Regulamin</a>
                                @endif
                            </strong>
                            <div class="col-md-5 text-right">
                                @if(!$round->startList)
                                    <a href="{{ url('round', $round->id) }}" class="btn btn-sm btn-success">Zgłoszenia</a>
                                @else
                                    <a href="{{ url('list', $round->id) }}" class="btn btn-sm btn-success">Lista startowa</a>
                                    <a href="{{ url('osy', $round->id) }}" class="btn btn-sm btn-success">Os-y</a>
                                @endif
                                <a href="{{ url('accreditations', $round->id) }}" class="btn btn-sm btn-primary">Akredytacje</a>
                                <a href="{{ url('editRound', $round->id) }}" class="btn btn-sm btn-info">Edytuj</a>
                                {{-- <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editRound" 
                                    data-text='{"round_id":"{{ $round->id }}", "round_name":"{{ $round->name }}", "sub_name":"{{ $round->sub_name }}", "details":"{{ $round->details }}", "date":"{{ $round->date->format('Y-m-d H:i') }}", "sign_date":"{{ $round->sign_date->format('Y-m-d H:i') }}", "max":"{{ $round->max }}", "price":"{{ $round->price }}", "advance":"{{ $round->advance }}"}'
                                    data-order='{"items":"{{ $round->order }}"}'
                                    >Edytuj</button> --}}
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