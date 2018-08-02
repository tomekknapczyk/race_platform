@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Samochody
                    <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newCar">Dodaj samochód</button>
                </div>
                <div class="card-body">
                    @if(auth()->user()->cars)
                        @foreach(auth()->user()->cars as $car)
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="col-5">{{ $car->marka }} {{ $car->model }} <small>{{ $car->turbo?'/ Turbo':'' }} {{ $car->rwd?'/ RWD':'' }}</small></h3>
                                <span>{{ $car->rok }} r.</span>
                                <span>{{ $car->ccm }} ccm</span>
                                <strong class="text-uppercase">{{ $car->nr_rej }}</strong>
                                <div>
                                    <button class="btn btn-sm btn-info editBtn" data-toggle="modal" data-target="#editCar" 
                                        data-text='{"id":"{{ $car->id }}", "marka":"{{ $car->marka }}", "model":"{{ $car->model }}", "rok":"{{ $car->rok }}", "ccm":"{{ $car->ccm }}", "nr_rej":"{{ $car->nr_rej }}"}'
                                        data-check='{"turbo":"{{ $car->turbo }}", "rwd":"{{ $car->rwd }}"}'
                                        >Edytuj</button>
                                    <button class="btn btn-sm btn-danger deleteBtn" data-toggle="modal" data-target="#deleteCar" data-id="{{ $car->id }}">Usuń</button>
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

@include('modals.newCar')
@include('modals.editCar')
@include('modals.deleteCar')
@endsection