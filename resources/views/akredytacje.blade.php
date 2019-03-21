@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark fixed-width">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <a href="{{ url('media') }}" class="text-white">Akredytacje na rajd</a> : {{ $round->race->name }} : {{ $round->name }}
                    </div>
                </div>
                <div class="card-body">
                    @foreach($accreditations as $accreditation)
                        <div class="row justify-content-start align-items-center flex-wrap py-2 mb-3">
                            <div class="col-3"></div>
                            <div class="col-2">
                                @if($accreditation[0]->user && $accreditation[0]->user->profile->file_id)
                                    <img src="{{ url('public/driver/thumb/', $accreditation[0]->user->profile->file->path) }}" class="img-fluid thumb">
                                @else
                                    <img src="{{ url('images/press.png') }}" class="img-fluid thumb-big">
                                @endif
                            </div>
                            <h3 class="col-3 text-center mt-4 mb-3 text-uppercase">
                                {{ $accreditation[0]->user->profile->name }}
                            </h3>
                        </div>
                        <div class="row justify-content-around align-items-center flex-wrap">
                            <h6 class="m-0 col-3">
                                Imię i nazwisko<br>
                                <small>Rodzaj akredytacji</small>
                            </h6>
                            <h6 class="m-0 col-3 text-center">
                                Adres email
                            </h6>
                        </div> 
                        <hr>
                        <div class="lista">
                        @foreach($accreditation as $item)
                            <div class="row justify-content-around align-items-center flex-wrap py-2">
                                <h5 class="m-0 col-3">
                                    {{ $item->staff->name }}<br>
                                    <small>{{ $item->staff->type }}</small>
                                </h5>
                                <h5 class="m-0 col-3 text-center">
                                    {{ $item->staff->email }}
                                </h5>
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection