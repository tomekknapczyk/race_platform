@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Partnerzy
                    <a class="btn btn-sm btn-primary float-right" href="{{ url('newPartner') }}">Dodaj nowego partnera</a>
                </div>
                <div class="card-body">
                    @foreach($partners as $partner)
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="col-sm-3">
                                <img src="{{ url('public/partner', $partner->file->path) }}" class="img-fluid img-thumbnail">
                            </div>
                            <h6 class="m-0 col-sm-3">
                                {{ $partner->name }}
                            </h6>
                            <div class="col-sm-3">
                                @if($partner->promoted)
                                    Promowany w popupie
                                @endif
                            </div>
                            <div class="col-sm-3 text-right">
                                <a href="{{ url('editPartner', $partner->id) }}" class="btn btn-sm btn-info">Edytuj</a>
                                <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deletePartner" data-id="{{ $partner->id }}">Usuń</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.deletePartner')
@endsection