@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Piloci
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newPilot">Dodaj pilota</button>
                </div>
                <div class="card-body">
                    @if(auth()->user()->pilots)
                        @foreach(auth()->user()->pilots as $pilot)
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="col-5">{{ $pilot->name }} {{ $pilot->lastname }}</h3>
                                <span>{{ $pilot->phone }}</span>
                                <span>{{ $pilot->email }}</span>
                                <div>
                                    <button class="btn btn-sm btn-outline-info editBtn" data-toggle="modal" data-target="#editPilot" 
                                        data-text='{"id":"{{ $pilot->id }}", "name":"{{ $pilot->name }}", "lastname":"{{ $pilot->lastname }}", "phone":"{{ $pilot->phone }}", "email":"{{ $pilot->email }}", "id_card":"{{ $pilot->id_card }}", "address":"{{ $pilot->address }}", "driving_license":"{{ $pilot->driving_license }}", "oc":"{{ $pilot->oc }}", "nw":"{{ $pilot->nw }}"}'
                                        data-check='{"showName":"{{ $pilot->show_name }}", "showLastname":"{{ $pilot->show_lastname }}", "showEmail":"{{ $pilot->show_email }}"}'
                                        @if($pilot->file_id)
                                            data-img='{"photo":"{{ url('public/pilot', $pilot->file->path) }}"}'
                                        @else
                                            data-img='{"photo":""}'
                                        @endif
                                        >Edytuj</button>
                                    <button class="btn btn-sm btn-outline-danger deleteBtn" data-toggle="modal" data-target="#deletePilot" data-id="{{ $pilot->id }}">Usuń</button>
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

@include('modals.newPilot')
@include('modals.editPilot')
@include('modals.deletePilot')
@endsection