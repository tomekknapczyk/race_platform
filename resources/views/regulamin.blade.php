@extends('layouts.app')

@section('content')
<div class="drivers-container">
    <h3>Regulamin</h3>
    <div class="container">
        <div class="row justify-content-center">
            @if($regulamin)
                {!! $regulamin->value !!}
            @endif
        </div>
    </div>
</div>
@endsection