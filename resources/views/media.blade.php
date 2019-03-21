@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <div class="container">
        <div class="row justify-content-center align-items-center p-3">
            <div class="filter-box">
                <p class="text-center">Akredytacje na {{ $race->name }}</p>
                <div class="d-flex justify-content-center align-items-center p-1">
                    @foreach($race->rounds as $round)
                        @if($round->accreditations->count())
                            <a href="{{ route('akredytacje', $round->id) }}" class="btn btn-warning m-1">{{ $round->name }}</a>     
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <h3>Media</h3>
    <div class="container">
        <div class="row justify-content-center">
        @if($media->count())
            @foreach($media as $item)
                @if($item->profile)
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="driver">
                            <a href="{{ route('redakcja', $item->id) }}"> 
                            @if($item->profile->file_id)
                                <img src="{{ url('/public/driver/thumb/', $item->profile->file->path) }}" class="img-fluid">
                            @else
                                <img src="{{ url('/images/press.png') }}" class="img-fluid">
                            @endif
                            <h6 class="my-3">{{ $item->profile->name }}</h6>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        </div>
    </div>
</div>
@endsection