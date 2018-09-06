@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Live wyniki</h3>
    <div class="container">
        <div class="row justify-content-center">
            @if($liveWyniki)
                {!! $liveWyniki->value !!}
            @endif
        </div>
    </div>
</div>
@endsection