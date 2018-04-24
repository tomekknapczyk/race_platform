@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Profil kierowcy
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveDriver') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Imię</label>
                            <input type="text" name="name" value="{{ old('name', optional(auth()->user()->driver)->name) }}" class="form-control"> 
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="lastname">Nazwisko</label>
                            <input type="text" name="lastname" value="{{ old('lastname', optional(auth()->user()->driver)->lastname) }}" class="form-control"> 
                            @if ($errors->has('lastname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="address">Adres</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', optional(auth()->user()->driver)->address) }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="id_card">Seria nr dowodu osobistego</label>
                            <input type="text" name="id_card" value="{{ old('id_card', optional(auth()->user()->driver)->id_card) }}" class="form-control"> 
                            @if ($errors->has('id_card'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_card') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="text" name="phone" value="{{ old('phone', optional(auth()->user()->driver)->phone) }}" class="form-control"> 
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email', optional(auth()->user()->driver)->email) }}" class="form-control"> 
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="driving_license">Nr prawo jazdy</label>
                            <input type="text" name="driving_license" value="{{ old('driving_license', optional(auth()->user()->driver)->driving_license) }}" class="form-control"> 
                            @if ($errors->has('driving_license'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('driving_license') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="oc">Nazwa nr polisy OC</label>
                            <input type="text" name="oc" value="{{ old('oc', optional(auth()->user()->driver)->oc) }}" class="form-control"> 
                            @if ($errors->has('oc'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('oc') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nw">Nazwa nr polisy NW</label>
                            <input type="text" name="nw" value="{{ old('nw', optional(auth()->user()->driver)->nw) }}" class="form-control"> 
                            @if ($errors->has('nw'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('nw') }}</strong>
                                </span>
                            @endif
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