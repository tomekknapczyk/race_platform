@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Rajdy</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    </div>
                    <div>
                        <div class="btn-group">
                            <a href="{{ url('makeServiceList', $round->id) }}" class="btn btn-secondary">Generuj plik</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="text-center mt-4 mb-3 text-uppercase">Park serwisowy</h2>
                    @if($collection)
                        @foreach($collection as $item)
                        <div class="mb-4">
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h6 class="m-0 col-1 @if($item['item']->services($round->id) > 1) bg-warning @endif">
                                    {{ $item['item']->start_nr() }}.
                                </h6>
                                <h6 class="m-0 col-4">
                                    {{ $item['item']->name }} {{ $item['item']->lastname }}<br>
                                    <small><strong>Pilot:</strong> {{ $item['item']->pilot_name }} {{ $item['item']->pilot_lastname }}</small>
                                </h6>
                                <h6 class="m-0 col-4">
                                    {{ $item['item']->marka }} {{ $item['item']->model }} - {{ $item['item']->ccm }}ccm<br>
                                    <small>{{ $item['item']->rok }}r. @if($item['item']->turbo) / <strong>Turbo</strong> @endif @if($item['item']->rwd) / <strong>RWD</strong> @endif</small>
                                </h6>
                                <h6 class="m-0 col-3">
                                    <button class="btn btn-sm btn-success editSignServiceAdmin" data-toggle="modal" data-target="#editSignServiceAdmin" data-sign-id="{{ $item['item']->id }}" data-round-id="{{ $round->id }}">
                                        Dodaj uczestników
                                    </button>
                                </h6>
                            </div>
                            @foreach($item['partners'] as $partner)
                                <div class="row justify-content-between align-items-center flex-wrap py-2">
                                    <h6 class="m-0 col-2">
                                    </h6>
                                    <h6 class="m-0 col-1 @if($partner->partner->services($round->id) > 1) bg-warning @endif">
                                        {{ $partner->partner->start_nr() }}.
                                    </h6>
                                    <h6 class="m-0 col-4">
                                        {{ $partner->partner->name }} {{ $partner->partner->lastname }}<br>
                                        <small><strong>Pilot:</strong> {{ $partner->partner->pilot_name }} {{ $partner->partner->pilot_lastname }}</small>
                                    </h6>
                                    <h6 class="m-0 col-3">
                                        {{ $partner->partner->marka }} {{ $partner->partner->model }} - {{ $partner->partner->ccm }}ccm<br>
                                        <small>{{ $partner->partner->rok }}r. @if($partner->partner->turbo) / <strong>Turbo</strong> @endif @if($partner->partner->rwd) / <strong>RWD</strong> @endif</small>
                                    </h6>
                                    <h6 class="m-0 col-2">
                                        <button class="btn btn-sm btn-outline-danger deleteBtn" data-toggle="modal" data-target="#deleteService" data-id="{{ $partner->id }}">
                                            Usuń
                                        </button>
                                    </h6>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.editSignServiceAdmin')
@include('admin.modals.deleteService')
@endsection