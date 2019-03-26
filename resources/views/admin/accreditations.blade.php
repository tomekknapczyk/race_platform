@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <a href="{{ url('races') }}" class="text-white">Akredytacje na rajd</a> : <a href="{{ url('race', $round->race->id) }}" class="text-white">{{ $round->race->name }}</a> : {{ $round->name }}
                    </div>
                </div>
                <div class="card-body">
                    @foreach($accreditations as $accreditation)
                        <h2 class="text-center mt-4 mb-3 text-uppercase">
                            ..:: {{ $accreditation[0]->user->profile->name }} ::..
                            <br>
                            <button class="btn btn-sm btn-outline-info editSignPressAdmin" data-toggle="modal" data-target="#editSignPressAdmin" data-id="{{ $round->id }}"
                                data-staff="{!! $accreditation[0]->user->roundStaff($round->id) !!}" data-user="{{ $accreditation[0]->user->id }}">
                                Edytuj zgłoszenie
                            </button>
                        </h2>
                        <div class="row justify-content-between align-items-center flex-wrap">
                            <h6 class="m-0 col-3">
                                Imię i nazwisko<br>
                                <small>Rodzaj akredytacji</small>
                            </h6>
                            <h6 class="m-0 col-3 text-center">
                                Adres email
                            </h6>
                            <h6 class="m-0 col-3 text-center">
                                Telefon
                            </h6>
                            <h6 class="m-0 col-3 text-center">
                                Kontakt w razie wypadku (ICE)
                            </h6>
                        </div>
                        <div class="lista">
                        @foreach($accreditation as $item)
                            <div class="row justify-content-between align-items-center flex-wrap py-2">
                                <h5 class="m-0 col-3">
                                    {{ $item->staff->name }}<br>
                                    <small>{{ $item->staff->type }}</small>
                                </h5>
                                <h5 class="m-0 col-3 text-center">
                                    {{ $item->staff->email }}
                                </h5>
                                <h5 class="m-0 col-3 text-center">
                                    {{ $item->staff->phone }}
                                </h5>
                                <h5 class="m-0 col-3 text-center">
                                    {{ $item->staff->ice }}
                                </h5>
                            </div>
                        @endforeach
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.editSignPressAdmin')
@endsection