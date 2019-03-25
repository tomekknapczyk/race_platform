@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ route('media') }}" class="text-white">Media</a> : {{ $user->profile->name }}
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row shadow p-3 bg-white">
                            <div class="col-md-3">
                                @if($user->profile->file_id)
                                    <img src="{{ url('/public/driver', $user->profile->file->path) }}" class="img-fluid">
                                @else
                                    <img src="{{ url('/images/press.png') }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-uppercase">
                                    {{ $user->profile->name }}
                                </h3>
                                <p>{{ $user->profile->lastname }}</p>
                                <p>{{ $user->profile->phone }}</p>
                                <p>{{ $user->profile->address }}</p>
                                @if($user->profile->desc)
                                    <div class="mt-4">
                                        <h5>Opis:</h5>
                                        {!! $user->profile->desc !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($user->pressPhoto1)
                            <div class="row">
                                <div class="col-lg-12 mt-4">
                                    <div class="card border-0 shadow">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap py-2">
                                                <div class="col-12 col-md-4">
                                                    @if($user->pressPhoto1)
                                                        <a href="{{ url('public/redakcja', $user->pressPhoto1->path) }}" target="_blank">
                                                            <img src="{{ url('public/redakcja', $user->pressPhoto1->path) }}" class="img-fluid">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    @if($user->pressPhoto2)
                                                        <a href="{{ url('public/redakcja', $user->pressPhoto2->path) }}" target="_blank">
                                                            <img src="{{ url('public/redakcja', $user->pressPhoto2->path) }}" class="img-fluid">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    @if($user->pressPhoto3)
                                                        <a href="{{ url('public/redakcja', $user->pressPhoto3->path) }}" target="_blank">
                                                            <img src="{{ url('public/redakcja', $user->pressPhoto3->path) }}" class="img-fluid">
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header bg-yellow">
                                        Dziennikarze
                                    </div>
                                    <div class="card-body">
                                        @if($user->staff->count())
                                            @foreach($user->staff->take(1) as $person)
                                                <div class="d-flex justify-content-between align-items-center flex-wrap py-2">
                                                    <h3 class="col-md-4">{{ $person->name }}<br><small>{{ $person->type }}</small></h3>
                                                    <span class="col-md-4 text-right">{{ $person->email }}</span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection