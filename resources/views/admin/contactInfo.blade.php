@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    Dane kontaktowe
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveInfo') }}">
                        @csrf
                        <div class="form-group">
                            <label for="kontakt_first_name">Kontakt pierwszy nazwa</label>
                            <input type="text" name="kontakt_first_name" class="form-control" @if($contactFirstName) value="{{ $contactFirstName->value }}" @endif> 
                        </div>

                        <div class="form-group">
                            <label for="kontakt_first_tel">Kontakt pierwszy telefon</label>
                            <input type="text" name="kontakt_first_tel" class="form-control" @if($contactFirstTel) value="{{ $contactFirstTel->value }}" @endif> 
                        </div>

                        <div class="form-group">
                            <label for="kontakt_second_name">Kontakt drugi nazwa</label>
                            <input type="text" name="kontakt_second_name" class="form-control" @if($contactSecondName) value="{{ $contactSecondName->value }}" @endif> 
                        </div>

                        <div class="form-group">
                            <label for="kontakt_second_tel">Kontakt drugi telefon</label>
                            <input type="text" name="kontakt_second_tel" class="form-control" @if($contactSecondTel) value="{{ $contactSecondTel->value }}" @endif> 
                        </div>

                        <div class="form-group">
                            <label for="kontakt_email">Kontakt email</label>
                            <input type="text" name="kontakt_email" class="form-control" @if($contactEmail) value="{{ $contactEmail->value }}" @endif> 
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