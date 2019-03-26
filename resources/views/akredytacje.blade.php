@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center overflow-auto">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <a href="{{ url('media') }}" class="text-white">Akredytacje na rajd</a> : {{ $round->race->name }} : {{ $round->name }}
                    </div>
                </div>
                <div class="card-body lista">
                    @foreach($accreditations as $accreditation)
                        <div class="row py-4">
                            <div class="d-flex col-12 justify-content-start align-items-center flex-wrap py-2 mb-4">
                                <div class="col-12 col-md-3"></div>
                                <div class="col-6 mx-auto d-block d-md-none">
                                    <a href="{{ route('redakcja', $accreditation[0]->user->id) }}"> 
                                        @if($accreditation[0]->user && $accreditation[0]->user->profile->file_id)
                                            <img src="{{ url('public/driver/thumb/', $accreditation[0]->user->profile->file->path) }}" class="img-fluid">
                                        @else
                                            <img src="{{ url('images/press.png') }}" class="img-fluid">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-md-2 d-none d-md-block">
                                    <a href="{{ route('redakcja', $accreditation[0]->user->id) }}"> 
                                        @if($accreditation[0]->user && $accreditation[0]->user->profile->file_id)
                                            <img src="{{ url('public/driver/thumb/', $accreditation[0]->user->profile->file->path) }}" class="img-fluid">
                                        @else
                                            <img src="{{ url('images/press.png') }}" class="img-fluid">
                                        @endif
                                    </a>
                                </div>
                                <h3 class="col-12 col-md-4 text-center mt-4 mb-3 text-uppercase">
                                    <a href="{{ route('redakcja', $accreditation[0]->user->id) }}" class="text-dark"> 
                                        {{ $accreditation[0]->user->profile->name }}
                                    </a>
                                </h3>
                            </div>
                            <div class="col-12">
                            @foreach($accreditation->take(1) as $item)
                                <div class="row justify-content-around align-items-center flex-wrap py-2">
                                    <h5 class="m-0 col-12 col-md-6 text-center">
                                        {{ $item->staff->name }}<br>
                                        <small>{{ $item->staff->type }}</small>
                                    </h5>
                                    <h5 class="m-0 col-12 col-md-6 text-center">
                                        {{ $item->staff->email }}
                                    </h5>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection