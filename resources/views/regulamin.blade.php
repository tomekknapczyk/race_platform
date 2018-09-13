@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Regulamin
                </div>
                <div class="card-body">
                    @if($regulamin)
                        {!! $regulamin->value !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection