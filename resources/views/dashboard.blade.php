@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Witaj
                </div>
                <div class="card-body">
                    <h3 class="mb-3">Formularze zgłoszeniowe</h3>
                    @if($forms->count())
                        @foreach($forms as $form)
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <div class="col-md-4">
                                    <h4>{{ $form->round->name }}
                                        @if($form->round->sub_name)<br><small>{{ $form->round->sub_name }}</small>@endif
                                    </h4>
                                    <p class="my-1"><strong>{{ $form->round->date->format('Y-m-d H:i') }}</strong></p>
                                    @if(auth()->user()->driver != 2)
                                    <h6>
                                        <p class="text-info my-1 d-block">Koszt uczestnictwa <strong>{{ $form->round->price }} PLN.</strong></p>
                                        @if($form->round->advance) 
                                            <p  class="text-info my-1 d-block">Wymagana zaliczka <strong>{{ $form->round->advance }} PLN.</strong></p>
                                        @endif
                                    </h6>
                                    @endif
                                    @if(auth()->user()->signed($form->id))
                                        <h6 class="text-success mt-1 d-block">Zgłoszenie wysłane</h6>
                                    @endif
                                </div>
                                @if(auth()->user()->signed($form->id))
                                    <div class="col-md-8 text-right">
                                        <a href="{{ route('rajd', $form->round->id) }}" class="ml-3 btn btn-sm btn-outline-primary">Szczegóły rajdu</a>
                                        @if(auth()->user()->driver == 1)
                                            <button class="btn btn-sm btn-outline-info editSignUser" data-toggle="modal" data-target="#editSignUser" data-form-id="{{ $form->id }}" data-pilot-id="{{ auth()->user()->signId($form->id)->pilot_id }}" data-pilot-name="{{ auth()->user()->signId($form->id)->pilot_name }}" data-pilot-lastname="{{ auth()->user()->signId($form->id)->pilot_lastname }}" data-car="{{ auth()->user()->signId($form->id)->nr_rej }}">
                                                Edytuj zgłoszenie
                                            </button>
                                        @elseif(auth()->user()->driver == 0)
                                            <button class="btn btn-sm btn-outline-info editSignPilot" data-toggle="modal" data-target="#editSignPilot" data-form-id="{{ $form->id }}" data-user-id="{{ auth()->user()->signId($form->id)->user_id }}" data-car="{{ auth()->user()->signId($form->id)->nr_rej }}">
                                                Edytuj zgłoszenie
                                            </button>
                                        @endif
                                        <a href="{{ url('register_form', $form->id) }}" class="btn btn-sm btn-outline-danger">Pobierz formularz</a>
                                        @if($form->round->file_id)
                                            <a href="{{ url('public/terms', $form->round->file->path) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Regulamin</a>
                                        @endif
                                        @if($form->round->startList)
                                            <button class="btn btn-sm btn-outline-info editSignPilot" data-toggle="modal" data-target="#editSignPilot" data-form-id="{{ $form->id }}" data-user-id="{{ auth()->user()->signId($form->id)->user_id }}" data-car="{{ auth()->user()->signId($form->id)->nr_rej }}">
                                                Park serwisowy
                                            </button>
                                        @endif

                                        <button class="btn btn-sm btn-outline-danger deleteSign" data-toggle="modal" data-target="#deleteSign" data-id="{{ auth()->user()->signId($form->id)->id }}">
                                            Usuń
                                        </button>
                                    </div>
                                @else
                                    <div class="col-md-8 text-right">
                                        <a href="{{ route('rajd', $form->round->id) }}" class="ml-3 btn btn-sm btn-outline-primary">Szczegóły rajdu</a>
                                        @if(auth()->user()->driver == 1)
                                            @if(auth()->user()->ready())
                                                <button class="btn btn-sm btn-outline-info signBtn" data-toggle="modal" data-target="#sign" data-id="{{ $form->id }}">Zgłoś swój udział</button>
                                            @else
                                                <p class="m-0 text-white bg-secondary p-2 text-center">Aby zgłosić się do rajdu musisz uzpełnić <a href="{{ url('profile') }}" class="text-warning">swoje dane</a> i <a href="{{ url('cars') }}" class="text-warning">dane samochodu</a></p>
                                            @endif
                                        @elseif(auth()->user()->driver == 2)
                                            @if(auth()->user()->profile)
                                                @if(auth()->user()->accreditation($form->round->id))
                                                    <button class="btn btn-sm btn-outline-info editSignPress" data-toggle="modal" data-target="#editSignPress" data-id="{{ $form->round->id }}"
                                                        data-staff = "{!! auth()->user()->roundStaff($form->round->id) !!}">
                                                        Edytuj zgłoszenie
                                                    </button>
                                                    <a href="{{ route('accreditation_pdf',$form->round->id) }}" class="btn btn-sm btn-outline-danger">
                                                        Drukuj zgłoszenie
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-outline-info signBtn" data-toggle="modal" data-target="#signPress" data-id="{{ $form->round->id }}">
                                                        Zgłoś swój udział
                                                    </button>
                                                @endif
                                            @else
                                                <p class="m-0 text-white bg-secondary p-2 text-center">Aby zgłosić się do rajdu musisz uzpełnić <a href="{{ url('profile') }}" class="text-warning">swoje dane</a></p>
                                            @endif
                                        @else
                                            @if(auth()->user()->profile)
                                                <button class="btn btn-sm btn-outline-info signBtn" data-toggle="modal" data-target="#signPilot" data-id="{{ $form->id }}">Zgłoś swój udział</button>
                                            @else
                                                <p class="m-0 text-white bg-secondary p-2 text-center">Aby zgłosić się do rajdu musisz uzpełnić <a href="{{ url('profile') }}" class="text-warning">swoje dane</a></p>
                                            @endif
                                        @endif
                                        @if($form->round->file_id)
                                            <a href="{{ url('public/terms', $form->round->file->path) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Regulamin</a>
                                        @endif
                                    </div>
                                @endif
                                <hr class="col-12 p-0 my-2">
                            </div>
                        @endforeach
                    @elseif($start_lists->count())
                        @if(auth()->user()->driver == 1)
                            @foreach($start_lists as $start_list)
                                <div class="row justify-content-between align-items-center flex-wrap">
                                    <div class="col-md-4">
                                        <h4>{{ $start_list->round->name }}
                                            @if($start_list->round->sub_name)<br><small>{{ $start_list->round->sub_name }}</small>@endif
                                        </h4>
                                        <p class="my-1"><strong>{{ $start_list->round->date->format('Y-m-d H:i') }}</strong></p>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <a href="{{ route('rajd', $start_list->round->id) }}" class="ml-3 btn btn-sm btn-outline-primary">Szczegóły rajdu</a>
                                        @if(auth()->user()->onListId($start_list->id) && !auth()->user()->onService($start_list->round->id, auth()->user()->onListId($start_list->id)))
                                            <button class="btn btn-sm btn-outline-danger editSignService" data-toggle="modal" data-target="#editSignService" data-sign-id="{{ auth()->user()->onListId($start_list->id) }}" data-round-id="{{ $start_list->round->id }}">
                                                    Park serwisowy
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <h5 class="text-center">Aktualnie brak dostępnych formularzy</h5>
                    @endif

                    <h3 class="mt-5 mb-3">Wyniki</h3>
                    @if($races->count())
                        @foreach($races as $race)
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <h6 class="m-0 col-md-6">{{ $race->name }}</h6>
                                <div class="m-0 col-md-6 text-right">
                                    <a href="{{ url('rank', $race->id) }}" class="btn btn-sm btn-outline-success">Zobacz wyniki</a>
                                </div>
                                <hr class="col-12 p-0 my-2">
                            </div>
                        @endforeach
                    @else
                        <h5 class="text-center">Aktualnie brak dostępnych wyników</h5>
                    @endif

                    <h3 class="mt-5 mb-3">Listy zgłoszeń</h3>
                    @if($lists->count())
                        @foreach($lists as $list)
                            <div class="row justify-content-between align-items-center flex-wrap">
                                <div class="col-md-7">
                                    <h5 class="m-0">
                                        {{ $list->round->name }} @if($list->round->sub_name) - {{ $list->round->sub_name }}@endif
                                        <br>
                                        <small>{{ $list->round->race->name }}</small>
                                    </h5>
                                </div>
                                <div class="col-md-5 text-right">
                                    <a href="{{ url('sign-list', $list->round->id) }}" class="btn btn-sm btn-outline-info">Zobacz listę</a>
                                    
                                    @if($list->round->file_id)
                                        <a href="{{ url('public/terms', $list->round->file->path) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Regulamin</a>
                                    @endif
                                    @if(auth()->user()->signed($list->id))
                                        <a href="{{ url('register_form', $list->round->id) }}" class="btn btn-sm btn-outline-danger">Pobierz formularz</a>
                                    @endif
                                </div>
                                <hr class="col-12 p-0 my-2">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->driver == 1)
    @include('modals.sign')
    @include('modals.editSignUser')
@elseif(auth()->user()->driver == 2)
    @include('modals.signPress')
    @include('modals.editSignPress')
@else
    @include('modals.signPilot')
    @include('modals.editSignPilot')
@endif
@include('modals.deleteSign')
@include('modals.editSignService')
@endsection
