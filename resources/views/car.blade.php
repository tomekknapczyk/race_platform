@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    Samochód
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveCar') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="marka">Marka</label>
                                    <input type="text" name="marka" value="{{ old('marka', optional(auth()->user()->car)->marka) }}" class="form-control"> 
                                    @if ($errors->has('marka'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('marka') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" value="{{ old('model', optional(auth()->user()->car)->model) }}" class="form-control"> 
                                    @if ($errors->has('model'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="rok">Rok produkcji</label>
                                    <input type="text" name="rok" value="{{ old('rok', optional(auth()->user()->car)->rok) }}" class="form-control"> 
                                    @if ($errors->has('rok'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('rok') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nr_rej">Numer rejestracyjny</label>
                                    <input type="text" name="nr_rej" value="{{ old('nr_rej', optional(auth()->user()->car)->nr_rej) }}" class="form-control"> 
                                    @if ($errors->has('nr_rej'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('nr_rej') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ccm">Pojemność ccm</label>
                                    <input type="text" name="ccm" value="{{ old('ccm', optional(auth()->user()->car)->ccm) }}" class="form-control"> 
                                    @if ($errors->has('ccm'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('ccm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="klasa">Klasa</label>
                                    <select name="klasa" class="form-control">
                                      <option disabled selected value>Wybierz klasę</option>
                                      <option value="K1">K1</option>
                                      <option value="K2">K2</option>
                                      <option value="K3">K3</option>
                                      <option value="K4">K4</option>
                                      <option value="K5">K5 - Fiat 126p</option>
                                      <option value="K6">K6 - Cento</option>
                                      <option value="K7">K7 - RWD OPEN</option>
                                    </select>
                                    @if ($errors->has('klasa'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('klasa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="model">Turbo</label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="turbo" id="turbo" value="1">
                                      <label class="form-check-label" for="turbo">Tak</label>
                                    </div>
                                    @if ($errors->has('turbo'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('turbo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Zapisz się
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