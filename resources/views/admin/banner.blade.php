@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Baner z informacją
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveBanner') }}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="info">Treść komunikatu</label>
                                    <textarea name="info" class="form-control" rows="3">@if($banner) {{ $banner->value }} @endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="showBanner">
                                            <input type="checkbox" name="showBanner" id="showBanner" value="1" @if($banner && $banner->active) checked="checked" @endif>
                                            Pokaż baner informacyjny
                                        </label>
                                    </div>
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