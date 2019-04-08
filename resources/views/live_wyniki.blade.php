@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Live wyniki</h3>
    <div class="d-flex align-items-start justify-content-between flex-wrap">
        <div class="container">
            <div class="row justify-content-center">
                @if($liveWyniki)
                    {!! $liveWyniki->value !!}
                @endif
            </div>
        </div>
        @if($komunikaty->count())
        <div class="card border-dark mt-3 flex-1 komunikaty">
            <div class="card-header bg-yellow">
                Komunkiaty
            </div>
            <div class="card-body">
                @foreach($komunikaty as $komunikat)
                <div class="d-flex justify-content-between align-items-center flex-wrap bg-white mb-2 p-2">
                    <span class="w-100 small"><strong>{{ $komunikat->created_at->format('H:i:s') }}</strong></span><span class="w-100">{{ $komunikat->text }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection