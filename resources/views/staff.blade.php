@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Dziennikarze
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newStaff">Dodaj dziennikarza</button>
                </div>
                <div class="card-body">
                    @if(auth()->user()->staff)
                        @foreach(auth()->user()->staff as $person)
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="col-md-3">{{ $person->name }}<br><small>{{ $person->type }}</small></h3>
                                <span class="col-md-2">{{ $person->email }}</span>
                                <span class="col-md-2">{{ $person->phone }}</span>
                                <span class="col-md-2">{{ $person->ice }}</span>
                                <div class="col-md-3 text-right">
                                    <button class="btn btn-sm btn-outline-info editBtn" data-toggle="modal" data-target="#editStaff" 
                                        data-text='{"id":"{{ $person->id }}", "name":"{{ $person->name }}", "email":"{{ $person->email }}", "phone":"{{ $person->phone }}", "ice":"{{ $person->ice }}"}'
                                        data-radio='{"type":"{{ $person->type }}"}'
                                        >Edytuj</button>
                                    <button class="btn btn-sm btn-outline-danger deleteBtn" data-toggle="modal" data-target="#deleteStaff" data-id="{{ $person->id }}">Usuń</button>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.newStaff')
@include('modals.editStaff')
@include('modals.deleteStaff')
@endsection