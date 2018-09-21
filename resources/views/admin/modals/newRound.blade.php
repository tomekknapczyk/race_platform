<div class="modal fade" tabindex="-1" role="dialog" id="newRound" aria-labelledby="newRound" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dodaj nową rundę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveRound') }}" enctype="multipart/form-data" id="newRoundForm">
                    @csrf

                    <input type="hidden" name="race_id" value="{{ $race->id }}">
                    <input type="hidden" name="order" id="order_items_new">
                    
                    <div class="form-group">
                        <label for="name">Runda numer</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required=""> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="sub_name">Nazwa dodatkowa</label>
                        <input type="text" name="sub_name" value="{{ old('sub_name') }}" class="form-control"> 
                        @if ($errors->has('sub_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('sub_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="details">Link do szczegółowych wyników</label>
                        <input type="text" name="details" value="{{ old('details') }}" class="form-control"> 
                        @if ($errors->has('details'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                        @endif
                    </div>

                    <label>Kolejność klas:</label>
                    <div class="bg-dark p-2 rounded mb-3 d-flex justify-content-start align-items-center flex-wrap" id="items_new">
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k1">K1</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k2">K2</div>                       
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k3">K3</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k4">K4</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k5">K5</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k6">K6</div>
                        <div class="btn btn-sm btn-light m-2 shadow btn-move" data-id="k7">K7</div>
                    </div>

                    <div class="form-group">
                        <label for="sign_date">Termin zapisów</label>
                        <input type="text" name="sign_date" value="{{ old('sign_date') }}" class="form-control datetimepicker" required=""> 
                        @if ($errors->has('sign_date'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('sign_date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="date">Termin</label>
                        <input type="text" name="date" value="{{ old('date') }}" class="form-control datetimepicker" required=""> 
                        @if ($errors->has('date'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="max">Maksymalna ilość uczestników</label>
                        <input type="number" min="0" name="max" value="{{ old('max') }}" class="form-control" required=""> 
                        @if ($errors->has('max'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('max') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="price">Koszt uczestnictwa</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="form-control"> 
                        @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="advance">Wymagana zaliczka</label>
                        <input type="text" name="advance" value="{{ old('advance') }}" class="form-control"> 
                        @if ($errors->has('advance'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('advance') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="terms">Regulamin PDF</label>
                        <input type="file" name="terms" class="form-control">
                        @if ($errors->has('terms'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('terms') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block" id="saveNewRound">
                                Dodaj rundę
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>