@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Rajdy</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    </div>
                    <div class="float-right d-flex justify-content-between align-items-center flex-wrap">
                        @if($round->form->active)
                            <span>Formularz jest włączony</span>
                            <button class="btn btn-sm btn-danger ml-2" data-toggle="modal" data-target="#signFormStatus">Wyłącz</button>
                        @else
                            <span>Formularz jest wyłączony</span>
                            <button class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#signFormStatus">Włącz</button>
                        @endif

                        <button class="btn btn-sm btn-info ml-2" data-toggle="modal" data-target="#addSign">Dodaj uczestnika</button>

                        <button class="btn btn-sm btn-secondary ml-2" data-toggle="modal" data-target="#addSignSimple">Dodaj szybko</button>
                    </div>

                    <div>
                        <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#makeFileSign">Generuj plik</button>

                        @if(!$round->startList)
                            <button class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#generateList">Generuj listę startową</button>
                        @endif

                        @if($round->form->visible)
                            <button class="btn btn-sm btn-danger ml-2" data-toggle="modal" data-target="#changeFormVisibility">Ukryj listę zgłoszeń</button>
                        @else
                            <button class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#changeFormVisibility">Opulbikuj listę zgłoszeń</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $numer = 0;
                    @endphp
                    @foreach($klasy as $key => $klasa)
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                        <div class="row justify-content-between align-items-center flex-wrap">
                            <h6 class="m-0 col-1">
                                LP
                            </h6>
                            <h6 class="m-0 col-3">
                                Imię i nazwisko kierowcy<br>
                                <small>Imię i nazwisko pilota</small>
                            </h6>
                            <h6 class="m-0 col-3">
                                Samochód
                            </h6>
                            <h6 class="m-0 col-1 text-center">
                                Ilość punktów w rajdzie
                            </h6>
                            <h6 class="m-0 col-1 text-center">
                                Pozostało do  zapłaty
                            </h6>
                            <h6 class="m-0 col-3 text-center">
                                Edytuj
                            </h6>
                        </div> 
                        <hr>
                        <div class="sortable_items lista">
                            @foreach($signs->where('klasa', $klasa) as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap py-2" data-id={{ $sign->id }}>
                                    <h5 class="m-0 col-1">
                                        {{ ++$numer }}.
                                    </h5>
                                    <h5 class="m-0 col-3">
                                        {{ $sign->name }} {{ $sign->lastname }}<br>
                                        <small><strong>Pilot:</strong> {{ $sign->pilot_name }} {{ $sign->pilot_lastname }}</small>
                                    </h5>
                                    <h5 class="m-0 col-3">
                                        {{ $sign->marka }} {{ $sign->model }} - {{ $sign->ccm }}ccm<br>
                                        <small>{{ $sign->rok }}r. @if($sign->turbo) / <strong>Turbo</strong> @endif @if($sign->rwd) / <strong>RWD</strong> @endif</small>
                                    </h5>
                                    <h5 class="m-0 col-1 text-center">
                                        {{ $sign->race_points($round->race) }} pkt
                                    </h5>
                                    <h5 class="m-0 col-1 text-center">
                                        {{ $sign->remaining($round->price) }} zł
                                    </h5>
                                    <h5 class="m-0 col-3 text-right">
                                        @if($sign->payment)
                                            <a href="{{ url($sign->payment) }}" class="btn btn-sm btn-success" target="_blank">Potwierdzenie przelewu</a>
                                        @endif
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info editSign" data-toggle="modal" data-target="#editSign" data-id="{{ $sign->id }}"
                                                data-text=
                                                '{"id":"{{ $sign->id }}", "marka":"{{ $sign->marka }}", "model":"{{ $sign->model }}", "rok":"{{ $sign->rok }}", "ccm":"{{ $sign->ccm }}", "nr_rej":"{{ $sign->nr_rej }}", "driver_name":"{{ $sign->name }}", "driver_lastname":"{{ $sign->lastname }}", "driver_address":{!! json_encode($sign->address) !!}, "driver_id_card":"{{ $sign->id_card }}", "driver_phone":"{{ $sign->phone }}", "driver_email":"{{ $sign->email }}", "driver_driving_license":"{{ $sign->driving_license }}", "car_oc":"{{ $sign->oc }}", "car_nw":"{{ $sign->nw }}", "pilot_name":"{{ $sign->pilot_name }}", "pilot_lastname":"{{ $sign->pilot_lastname }}", "pilot_address":"{{ $sign->pilot_address }}", "pilot_id_card":"{{ $sign->pilot_id_card }}", "pilot_phone":"{{ $sign->pilot_phone }}", "pilot_email":"{{ $sign->pilot_email }}", "pilot_driving_license":"{{ $sign->pilot_driving_license }}", "pilot_oc":"{{ $sign->pilot_oc }}", "pilot_nw":"{{ $sign->pilot_nw }}", "klasa":"{{ $sign->klasa }}", "advance":"{{ $sign->advance }}"}'
                                                data-check='{"turbo":"{{ $sign->turbo }}", "rwd":"{{ $sign->rwd }}"}'
                                            >Edytuj</button>

                                            <button class="btn btn-sm btn-warning cancelSign" data-toggle="modal" data-target="#cancelSign" data-id="{{ $sign->id }}">Wyklucz</button>
                                            <button class="btn btn-sm btn-danger deleteSign" data-toggle="modal" data-target="#deleteSign" data-id="{{ $sign->id }}">Usuń</button>
                                        </div>
                                    </h5>
                                </div>  
                            @endforeach
                        </div>

                        @if($canceled->where('klasa', $klasa)->count())
                            <h5 class="text-center my-3 text-uppercase text-danger">..:: lista rezerwowa {{ $klasa }} ::..</h5>
                            @foreach($canceled->where('klasa', $klasa) as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap">
                                    <h6 class="m-0 col-3">
                                        {{ $sign->name }} {{ $sign->lastname }}<br>
                                        <small><strong>Pilot:</strong> {{ $sign->pilot_name }} {{ $sign->pilot_lastname }}</small>
                                    </h6>
                                    <h6 class="m-0 col-3">
                                        {{ $sign->marka }} {{ $sign->model }} - {{ $sign->ccm }}ccm<br>
                                        <small>{{ $sign->rok }}r. @if($sign->turbo) / <strong>Turbo</strong> @endif @if($sign->rwd) / <strong>RWD</strong> @endif</small>
                                    </h6>
                                    <h6 class="m-0 col-1">
                                        {{ $sign->klasa }}
                                    </h6>
                                    <h6 class="m-0 col-2">
                                        <button class="btn btn-sm btn-success enableSign" data-toggle="modal" data-target="#enableSign" data-id="{{ $sign->id }}">Dołącz do listy</button>
                                    </h6>
                                    <hr class="col-12 p-0 my-2">
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.signFormStatus')
@include('admin.modals.editSign')
@include('admin.modals.deleteSign')
@include('admin.modals.cancelSign')
@include('admin.modals.enableSign')
@include('admin.modals.addSign')
@include('admin.modals.addSignSimple')
@include('admin.modals.generateList')
@include('admin.modals.makeFileSign')
@include('admin.modals.changeFormVisibility')
@endsection