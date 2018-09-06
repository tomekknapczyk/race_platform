@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Wyniki live
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('save_live_wyniki') }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="live_wyniki" class="form-control" rows="10">@if($liveWyniki){{ $liveWyniki->value }}@endif</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Zapisz
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection