@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Promowani kierowcy na stronie głównej
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('save_promoted') }}">
                        @csrf
                        <div class="form-group">
                            <div class="form-check">
                                <input type="radio" name="promoted" value="race" id="race" class="form-check-input" @if($promoted_race->value == 'race') checked="" @endif>   
                                <label class="form-check-label" for="race">
                                    Klasyfikacja roczna
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="promoted" value="round" id="round" class="form-check-input" @if($promoted_race->value == 'round') checked="" @endif>
                                <label class="form-check-label" for="round">
                                    Ostatnia runda
                                </label>
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