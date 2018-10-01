@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Ustawienia konta
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl>
                                <dt>{{ __('Name') }}</dt>
                                <dd>{{ auth()->user()->login }}</dd>
                                <dt>{{ __('E-Mail Address') }}</dt>
                                <dd>{{ auth()->user()->email }}</dd>
                                <dt>Twoje unikalne ID</dt>
                                <dd>
                                    {{ auth()->user()->uid }}
                                    <form action="{{ route('regenerateUid') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Wygeneruj nowe ID</button>
                                    </form>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-info shadow">
                                <div class="card-header text-white bg-info">
                                    Zmień hasło
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                            <label for="current_password">Obecne hasło</label>
                                            <input id="current_password" type="password" class="form-control" name="current_password" required>

                                            @if ($errors->has('current_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password">Nowe hasło</label>
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm">Powtórz hasło</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>

                                        <div class="form-group">
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-info btn-block">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @if(auth()->user()->updated_at)
                                    <div class="card-footer text-white bg-info">
                                        Ostatnia zmiana: {{ \Carbon\Carbon::now()->diffForHumans(auth()->user()->updated_at) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection