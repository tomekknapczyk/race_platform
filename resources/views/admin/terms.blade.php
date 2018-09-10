@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Regulamin
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveTerms') }}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <textarea name="terms" class="tinymce" rows="5">@if($terms) {{ $terms->value }} @endif</textarea>
                                </div>
                            </div>
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