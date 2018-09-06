@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Live video</h3>
    <div class="container">
        <div class="row justify-content-center">
            @if($liveVideo)
                {!! $liveVideo->value !!}
            @endif
        </div>
    </div>
</div>
@endsection