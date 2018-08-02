@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Witaj
                </div>
                <div class="card-body">
                    <h3 class="mb-3">Dostępne formularze zgłoszeniowe:</h3>
                    @if($forms->count())
                        @foreach($forms as $form)
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h5 class="m-0 col-6">{{ $form->round->race->name }} :: {{ $form->round->name }}</h5>
                                <strong class="col-2">{{ $form->round->termin }}</strong>
                                <div>
                                    @if(auth()->user()->ready())
                                        <button class="btn btn-info editBtn" data-toggle="modal" data-target="#editRound">Zgłoś swój udział</button>
                                    @else
                                        <p class="m-0 text-white bg-secondary p-2">Aby zgłosić się do rajdu musisz uzpełnić dane <a href="{{ url('driver-profile') }}" class="text-warning">kierowcy</a>, <a href="{{ url('pilots') }}" class="text-warning">pilota</a> i <a href="{{ url('cars') }}" class="text-warning">samochodu</a></p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <h5 class="text-center">Aktualnie brak dostępnych formularzy</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
