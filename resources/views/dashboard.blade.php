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
                    <h3 class="mb-3">Formularze zgłoszeniowe</h3>
                    @if($forms->count())
                        @foreach($forms as $form)
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <h5 class="m-0 col-5">
                                    {{ $form->round->race->name }} :: {{ $form->round->name }}
                                    <br>
                                    @if(auth()->user()->signed($form->id))
                                        <span class="text-success mt-2 d-block">zgłoszenie wysłane</span>
                                    @endif
                                </h5>
                                <strong class="col-2">{{ $form->round->termin }}</strong>
                                @if(auth()->user()->signed($form->id))
                                    <div class="col-5 text-right">
                                        <a href="{{ url('register_form', $form->id) }}" class="btn btn-sm btn-outline-danger">Pobierz formularz</a>
                                    </div>
                                @else
                                    <div class="col-5 text-right">
                                        @if(auth()->user()->ready())
                                            <button class="btn btn-sm btn-outline-info signBtn" data-toggle="modal" data-target="#sign" data-id="{{ $form->id }}">Zgłoś swój udział</button>
                                        @else
                                            <p class="m-0 text-white bg-secondary p-2 text-center">Aby zgłosić się do rajdu musisz uzpełnić dane <a href="{{ url('driver-profile') }}" class="text-warning">kierowcy</a>, <a href="{{ url('pilots') }}" class="text-warning">pilota</a> i <a href="{{ url('cars') }}" class="text-warning">samochodu</a></p>
                                        @endif
                                    </div>
                                @endif
                                <hr class="col-12 p-0 my-2">
                            </div>
                        @endforeach
                    @else
                        <h5 class="text-center">Aktualnie brak dostępnych formularzy</h5>
                    @endif

                    <h3 class="mt-5 mb-3">Wyniki</h3>
                    @if($races->count())
                        @foreach($races as $race)
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <h6 class="m-0 col-6">{{ $race->name }}</h6>
                                <div class="m-0 col-6 text-right">
                                    <a href="{{ url('rank', $race->id) }}" class="btn btn-sm btn-outline-success">Zobacz wyniki</a>
                                </div>
                                <hr class="col-12 p-0 my-2">
                            </div>
                        @endforeach
                    @else
                        <h5 class="text-center">Aktualnie brak dostępnych wyników</h5>
                    @endif

                    <h3 class="mt-5 mb-3">Listy startowe</h3>
                    @if($lists->count())
                        @foreach($lists as $list)
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <h6 class="m-0 col-5">{{ $list->round->race->name }} :: {{ $list->round->name }}</h6>
                                <span class="col-2">{{ $list->round->termin }}</span>
                                <div class="col-5 text-right">
                                    <a href="{{ url('start-list', $list->round->id) }}" class="btn btn-sm btn-outline-info">Zobacz listę</a>
                                    @if(auth()->user()->onList($list->id))
                                        <a href="{{ url('register_form', $list->round->form->id) }}" class="btn btn-sm btn-outline-danger">Pobierz formularz</a>
                                    @endif
                                </div>
                                <hr class="col-12 p-0 my-2">
                            </div>
                        @endforeach
                    @else
                        <h5 class="text-center">Aktualnie brak dostępnych list startowych</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.sign')
@endsection
