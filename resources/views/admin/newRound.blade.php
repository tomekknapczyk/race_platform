@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-dark">
                <div class="card-header bg-yellow">
                    <a href="{{ route('races') }}" class="text-white">Rajdy</a> : <a href="{{ route('race', $race->id) }}" class="text-white">{{ $race->name }}</a> : nowa runda
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('saveRound') }}" enctype="multipart/form-data" id="editRoundForm">
                    @csrf
                    <input type="hidden" name="race_id" value="{{ $race->id }}">
                    <input type="hidden" name="order" id="order_items">
                    
                    <div class="d-flex flex-wrap">
                        <div class="form-group col-12 col-md-4">
                            <label for="name">Runda numer</label>
                            <input type="text" name="name" class="form-control" required=""> 
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="sub_name">Nazwa dodatkowa</label>
                            <input type="text" name="sub_name" class="form-control"> 
                            @if ($errors->has('sub_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('sub_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="details">Link do szczegółowych wyników</label>
                            <input type="text" name="details" class="form-control"> 
                            @if ($errors->has('details'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <div class="form-group col-12 col-md-4">
                            <label for="length">Długość rajdu</label>
                            <input type="text" name="length" class="form-control"> 
                            @if ($errors->has('length'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('length') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="special_length">Całkowita długość odcinków specjalnych</label>
                            <input type="text" name="special_length" class="form-control"> 
                            @if ($errors->has('special_length'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('special_length') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="driveway_length">Długość dojazdówek</label>
                            <input type="text" name="driveway_length" class="form-control"> 
                            @if ($errors->has('driveway_length'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('driveway_length') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <div class="form-group col-12 col-md-6">
                            <label for="desc">Opis</label>
                            <textarea name="desc" class="form-control tinymce"></textarea>
                            @if ($errors->has('desc'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('desc') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="serwis">Serwis i biuro rajdy</label>
                            <textarea name="serwis" class="form-control tinymce"></textarea>
                            @if ($errors->has('serwis'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('serwis') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <label>Kolejność klas:</label>
                    <div class="bg-dark p-2 rounded mb-3 d-flex justify-content-start align-items-center flex-wrap" id="items">
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k1">K1</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k2">K2</div>                       
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k3">K3</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k4">K4</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k5">K5</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k6">K6</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k7">K7</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="open">Open</div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <div class="form-group col-12 col-md-6">
                            <label for="sign_date">Termin zapisów</label>
                            <input type="text" name="sign_date" class="form-control datetimepicker" required=""> 
                            @if ($errors->has('sign_date'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('sign_date') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="date">Termin</label>
                            <input type="text" name="date" class="form-control datetimepicker" required=""> 
                            @if ($errors->has('date'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <div class="form-group col-12 col-md-4">
                            <label for="max">Maksymalna ilość uczestników</label>
                            <input type="number" min="0" name="max" class="form-control" required=""> 
                            @if ($errors->has('max'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('max') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="price">Koszt uczestnictwa</label>
                            <input type="text" name="price" class="form-control"> 
                            @if ($errors->has('price'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <label for="advance">Wymagana zaliczka</label>
                            <input type="text" name="advance" class="form-control"> 
                            @if ($errors->has('advance'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('advance') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <div class="form-group col-12 col-md-4">
                            <div class="form-group">
                                <label for="terms">Regulamin PDF</label>
                                <input type="file" name="terms" class="form-control">
                                @if ($errors->has('terms'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('terms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <div class="form-group">
                                <label for="poster">Plakat</label>
                                <input type="file" name="poster" class="form-control">
                                @if ($errors->has('poster'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('poster') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-4">
                            <div class="form-group">
                                <label for="map">Mapa rundy</label>
                                <input type="file" name="map" class="form-control">
                                @if ($errors->has('map'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('map') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sections">
                        <h4>Odcinki specjalne</h4>
                        <button class="btn btn-sm btn-info addSection mb-4" data-id="{{ $id }}">Dodaj odcinek</button>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block" id="saveRound">
                                Zapisz rundę
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