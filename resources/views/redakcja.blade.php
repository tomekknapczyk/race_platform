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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header bg-yellow">
                                        Dziennikarze
                                    </div>
                                    <div class="card-body">
                                        @if($user->staff->count())
                                            @foreach($user->staff as $person)
                                                <div class="d-flex justify-content-between align-items-center flex-wrap py-2">
                                                    <h3 class="col-md-3">{{ $person->name }}<br><small>{{ $person->type }}</small></h3>
                                                    <span class="col-md-2">{{ $person->email }}</span>
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