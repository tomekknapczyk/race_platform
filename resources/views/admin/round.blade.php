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

                        <button class="btn btn-sm btn-warning ml-2" data-toggle="modal" data-target="#addSignSimple">Dodaj szybko</button>
                    </div>
                    @if(!$round->startList)
                        <button class="btn btn btn-success ml-2" data-toggle="modal" data-target="#generateList">Generuj listę startową</button>
                    @endif
                </div>
                <div class="card-body">
                    @foreach($class as $key => $klasa)
                        <h2 class="text-center mt-4 mb-3 text-uppercase">..:: {{ $key }} ::..</h2>
                        <div class="sortable_items">
                            @foreach($klasa as $sign)
                                <div class="row justify-content-between align-items-center flex-wrap pt-1 @if(!$sign['active']) bg-warning op-3 @endif" data-id={{ $sign['sign']->id }}>
                                    <h5 class="m-0 col-1">
                                        {{ $loop->iteration }}
                                    </h5>
                                    <h5 class="m-0 col-3">
                                        {{ $sign['sign']->name }} {{ $sign['sign']->lastname }}<br>
                                        <small><strong>Pilot:</strong> {{ $sign['sign']->pilot_name }} {{ $sign['sign']->pilot_lastname }}</small>
                                    </h5>
                                    <h5 class="m-0 col-3">
                                        {{ $sign['sign']->marka }} {{ $sign['sign']->model }} - {{ $sign['sign']->ccm }}ccm<br>
                                        <small>{{ $sign['sign']->rok }}r. @if($sign['sign']->turbo) / <strong>Turbo</strong> @endif @if($sign['sign']->rwd) / <strong>RWD</strong> @endif</small>
                                    </h5>
                                    <h5 class="m-0 col-1">
                                        {{ $sign['sign']->klasa }}
                                    </h5>
                                    <h5 class="m-0 col-1">
                                        {{ $sign['sign']->points() }} pkt
                                    </h5>
                                    <h5 class="m-0 col-2 text-right">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info editSign" data-toggle="modal" data-target="#editSign" data-id="{{ $sign['sign']->id }}"
                                                data-text=
                                                '{"id":"{{ $sign['sign']->id }}", "marka":"{{ $sign['sign']->marka }}", "model":"{{ $sign['sign']->model }}", "rok":"{{ $sign['sign']->rok }}", "ccm":"{{ $sign['sign']->ccm }}", "nr_rej":"{{ $sign['sign']->nr_rej }}", "driver_name":"{{ $sign['sign']->name }}", "driver_lastname":"{{ $sign['sign']->lastname }}", "driver_address":"{{ $sign['sign']->address }}", "driver_id_card":"{{ $sign['sign']->id_card }}", "driver_phone":"{{ $sign['sign']->phone }}", "driver_email":"{{ $sign['sign']->email }}", "driver_driving_license":"{{ $sign['sign']->driving_license }}", "driver_oc":"{{ $sign['sign']->oc }}", "driver_nw":"{{ $sign['sign']->nw }}", "pilot_name":"{{ $sign['sign']->pilot_name }}", "pilot_lastname":"{{ $sign['sign']->pilot_lastname }}", "pilot_address":"{{ $sign['sign']->pilot_address }}", "pilot_id_card":"{{ $sign['sign']->pilot_id_card }}", "pilot_phone":"{{ $sign['sign']->pilot_phone }}", "pilot_email":"{{ $sign['sign']->pilot_email }}", "pilot_driving_license":"{{ $sign['sign']->pilot_driving_license }}", "pilot_oc":"{{ $sign['sign']->pilot_oc }}", "pilot_nw":"{{ $sign['sign']->pilot_nw }}", "klasa":"{{ $sign['sign']->klasa }}"}'
                                                data-check='{"turbo":"{{ $sign['sign']->turbo }}", "rwd":"{{ $sign['sign']->rwd }}"}'
                                            >Edytuj</button>

                                            <button class="btn btn-sm btn-warning cancelSign" data-toggle="modal" data-target="#cancelSign" data-id="{{ $sign['sign']->id }}">Wyklucz</button>
                                            <button class="btn btn-sm btn-danger deleteSign" data-toggle="modal" data-target="#deleteSign" data-id="{{ $sign['sign']->id }}">Usuń</button>
                                        </div>
                                    </h5>
                                    <hr class="col-12 p-0 pt-1 m-0">
                                </div>  
                            @endforeach
                        </div>

                        @if($round->canceled()->where('klasa', $key)->count())
                            <h5 class="text-center my-3 text-uppercase text-danger">..:: lista rezerwowa {{ $key }} ::..</h5>
                            @foreach($round->canceled()->where('klasa', $key) as $sign)
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
@endsection