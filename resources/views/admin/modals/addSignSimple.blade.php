<div class="modal fade" tabindex="-1" role="dialog" id="addSignSimple" aria-labelledby="addSignSimple" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dodaj uczestnika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addSign') }}">
                    @csrf
                    <input type="hidden" name="id" id="form_id" value="{{ $round->form->id }}">

                    <h3 class="text-center m-0">Dane kierowcy</h3>

                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="driver_name">Imię</label>
                                <input type="text" name="driver_name" id="driver_name" class="form-control" required=""> 
                                @if ($errors->has('driver_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="driver_lastname">Nazwisko</label>
                                <input type="text" name="driver_lastname" id="driver_lastname" class="form-control" required=""> 
                                @if ($errors->has('driver_lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="driver_email">Email</label>
                                <input type="email" name="driver_email" id="driver_email" class="form-control" required=""> 
                                @if ($errors->has('driver_email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <h3 class="text-center m-0">Dane pilota</h3>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Imię</label>
                                <input type="text" name="name" id="pilot_name" class="form-control"> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lastname">Nazwisko</label>
                                <input type="text" name="lastname" id="pilot_lastname" class="form-control"> 
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h3 class="text-center m-0">Dane samochodu</h3>

                    <div class="row mt-4">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="marka">Marka</label>
                                <input type="text" name="marka" id="marka" class="form-control" required=""> 
                                @if ($errors->has('marka'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('marka') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-3"> 
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" name="model" id="model" class="form-control" required=""> 
                                @if ($errors->has('model'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="nr_rej">Numer rejestracyjny</label>
                                <input type="text" name="nr_rej" id="nr_rej" class="form-control" required=""> 
                                @if ($errors->has('nr_rej'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nr_rej') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="rok">Rok produkcji</label>
                                <input type="text" name="rok" id="rok" class="form-control" required=""> 
                                @if ($errors->has('rok'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rok') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ccm">Pojemność ccm</label>
                                <input type="text" name="ccm" id="ccm" class="form-control" required=""> 
                                @if ($errors->has('ccm'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ccm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="model">Turbo</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="turbo" value="1" id="turbo">
                                    <label class="form-check-label" for="car_turbo">Tak</label>
                                </div>
                                @if ($errors->has('turbo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('turbo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="model">RWD</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="rwd" value="1" id="rwd">
                                    <label class="form-check-label" for="car_rwd">Tak</label>
                                </div>
                                @if ($errors->has('rwd'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rwd') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="klasa">Klasa</label>
                                <select name="klasa" class="form-control" id="klasa" required="">
                                    <option value="k1">K1</option>
                                    <option value="k2">K2</option>
                                    <option value="k3">K3</option>
                                    <option value="k4">K4</option>
                                    <option value="k5">K5</option>
                                    <option value="k6">K6</option>
                                    <option value="k7">K7</option>
                                </select>
                                @if ($errors->has('klasa'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('klasa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Dodaj uczestnika
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>