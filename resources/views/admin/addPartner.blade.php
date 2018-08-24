@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header text-white bg-dark">
                    <a href="{{ url('partners') }}" class="text-white">Partnerzy</a> : Dodaj partnera
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('savePartner') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="name">Nazwa</label>
                                    <input type="text" name="name" class="form-control" required="">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="url">Adres url do strony partnera</label>
                                    <input type="text" name="url" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="photo">Zdjęcie</label>
                                    <input type="file" name="photo" class="form-control" required="">
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label for="promoted">
                                            <input type="checkbox" name="promoted" id="promoted" value="1">
                                            Promowany w popupie
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