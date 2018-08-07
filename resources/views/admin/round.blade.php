@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Rajdy</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    </div>
                    <div class="float-right d-flex justify-content-between align-items-center">
                        @if($round->form->active)
                            <span>Formularz zgłoszeniowy jest włączony</span>
                            <button class="btn btn-sm btn-danger ml-2" data-toggle="modal" data-target="#signFormStatus">Wyłącz</button>
                        @else
                            <span>Formularz zgłoszeniowy jest wyłączony</span>
                            <button class="btn btn-sm btn-success ml-2" data-toggle="modal" data-target="#signFormStatus">Włącz</button>
                        @endif
                        
                        <button class="btn btn-sm btn-info ml-2" data-toggle="modal" data-target="#addSign">Dodaj uczestnika</button>
                    </div>
                    @if(!$round->startList)
                        <button class="btn btn btn-success ml-2" data-toggle="modal" data-target="#generateList">Generuj listę startową</button>
                    @endif
                </div>
                <div class="card-body">
                    @if($round->signs()->count())
                        @foreach($klasy as $klasa)
                            <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $klasa }} ::..</h2>
                            <div class="sortable_items">
                                @foreach($round->signs()->where('klasa', $klasa) as $sign)
                                    <div class="row justify-content-between align-items-center flex-wrap" data-id={{ $sign->id }}>
                                        <h5 class="m-0 col-4">
                                            {{ $sign->name }} {{ $sign->lastname }} <small>// {{ $sign->email }}</small><br>
                                            <small><strong>Pilot:</strong> {{ $sign->pilot_name }} {{ $sign->pilot_lastname }}</small>
                                        </h5>
                                        <h5 class="m-0 col-3">
                                            {{ $sign->marka }} {{ $sign->model }} - {{ $sign->ccm }}ccm<br>
                                            <small>{{ $sign->rok }}r. @if($sign->turbo) / <strong>Turbo</strong> @endif @if($sign->rwd) / <strong>RWD</strong> @endif</small>
                                        </h5>
                                        <h5 class="m-0 col-1">
                                            {{ $sign->klasa }}
                                        </h5>
                                        <h5 class="m-0 col-1">
                                            {{ $sign->points() }} pkt
                                        </h5>
                                        <h5 class="m-0 col-3 text-right">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info editSign" data-toggle="modal" data-target="#editSign" data-id="{{ $sign->id }}"
                                                    data-text=
                                                    '{"id":"{{ $sign->id }}", "marka":"{{ $sign->marka }}", "model":"{{ $sign->model }}", "rok":"{{ $sign->rok }}", "ccm":"{{ $sign->ccm }}", "nr_rej":"{{ $sign->nr_rej }}", "driver_name":"{{ $sign->name }}", "driver_lastname":"{{ $sign->lastname }}", "driver_address":"{{ $sign->address }}", "driver_id_card":"{{ $sign->id_card }}", "driver_phone":"{{ $sign->phone }}", "driver_email":"{{ $sign->email }}", "driver_driving_license":"{{ $sign->driving_license }}", "driver_oc":"{{ $sign->oc }}", "driver_nw":"{{ $sign->nw }}", "pilot_name":"{{ $sign->pilot_name }}", "pilot_lastname":"{{ $sign->pilot_lastname }}", "pilot_address":"{{ $sign->pilot_address }}", "pilot_id_card":"{{ $sign->pilot_id_card }}", "pilot_phone":"{{ $sign->pilot_phone }}", "pilot_email":"{{ $sign->pilot_email }}", "pilot_driving_license":"{{ $sign->pilot_driving_license }}", "pilot_oc":"{{ $sign->pilot_oc }}", "pilot_nw":"{{ $sign->pilot_nw }}", "klasa":"{{ $sign->klasa }}"}'
                                                    data-check='{"turbo":"{{ $sign->turbo }}", "rwd":"{{ $sign->rwd }}"}'
                                                >Edytuj</button>

                                                <button class="btn btn-sm btn-warning cancelSign" data-toggle="modal" data-target="#cancelSign" data-id="{{ $sign->id }}">Wyklucz</button>
                                                <button class="btn btn-sm btn-danger deleteSign" data-toggle="modal" data-target="#deleteSign" data-id="{{ $sign->id }}">Usuń</button>
                                            </div>
                                        </h5>
                                        <hr class="col-12 p-0 my-2">
                                    </div>
                                @endforeach
                            </div>
                            @if($round->canceled()->where('klasa', $klasa)->count())
                                <h5 class="text-center my-3 text-uppercase text-danger">..:: lista rezerwowa {{ $klasa }} ::..</h5>
                                @foreach($round->canceled()->where('klasa', $klasa) as $sign)
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
                    @endif
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
@include('admin.modals.generateList')
@endsection