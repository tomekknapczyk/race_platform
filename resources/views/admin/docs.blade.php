@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Dokumenty
                    <a class="btn btn-sm btn-primary float-right" href="{{ url('newDoc') }}">Dodaj nowy dokument</a>
                </div>
                <div class="card-body">
                    @foreach($docs as $doc)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-4">
                                <a href="{{ url('public/docs', $doc->file->path) }}" target="_blank">Pobierz</a>
                            </div>
                            <h6 class="m-0 col-sm-4">
                                {{ $doc->name }}
                            </h6>
                            <div class="col-sm-4 text-right">
                                <a href="{{ url('editDoc', $doc->id) }}" class="btn btn-sm btn-info">Edytuj</a>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteDoc" data-id="{{ $doc->id }}">Usuń</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.deleteDoc')
@endsection