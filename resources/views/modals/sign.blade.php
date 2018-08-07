<div class="modal fade" tabindex="-1" role="dialog" id="sign" aria-labelledby="sign" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Zgłoś swój udział</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('sign') }}">
                    @csrf
                    <input type="hidden" name="form_id" id="form_id">
                    <div class="row justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <h3 class="text-center m-0">Dane pilota</h3>
                            <div class="ml-4">
                                <select class="form-control" id="sign_pilot" required="">
                                    <option disabled selected value>Wybierz pilota</option>
                                    @foreach(auth()->user()->pilots as $pilot)
                                        <option value="{{ $pilot->id }}">{{ $pilot->name }} {{ $pilot->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Imię</label>
                                <input type="text" name="name" id="pilot_name" class="form-control" required="" readonly=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="lastname">Nazwisko</label>
                                <input type="text" name="lastname" id="pilot_lastname" class="form-control" required="" readonly=""> 
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <label for="address">Adres</label>
                            <textarea name="address" class="form-control" id="pilot_address" rows="4" readonly=""></textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_card">Seria nr dowodu osobistego</label>
                                <input type="text" name="id_card" id="pilot_id_card" class="form-control" readonly=""> 
                                @if ($errors->has('id_card'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('id_card') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" id="pilot_phone" class="form-control" readonly=""> 
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="pilot_email" class="form-control" readonly=""> 
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="driving_license">Nr prawo jazdy</label>
                                <input type="text" name="driving_license" id="pilot_driving_license" class="form-control" readonly=""> 
                                @if ($errors->has('driving_license'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driving_license') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="oc">Nazwa nr polisy OC</label>
                                <input type="text" name="oc" id="pilot_oc" class="form-control" readonly=""> 
                                @if ($errors->has('oc'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('oc') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="nw">Nazwa nr polisy NW</label>
                                <input type="text" name="nw" id="pilot_nw" class="form-control" readonly=""> 
                                @if ($errors->has('nw'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nw') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <h3 class="text-center m-0">Dane samochodu</h3>
                            <div class="ml-4">
                                <select class="form-control" id="sign_car" required="">
                                    <option disabled selected value>Wybierz samochód</option>
                                    @foreach(auth()->user()->cars as $car)
                                        <option value="{{ $car->id }}">{{ $car->marka }} {{ $car->model }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="marka">Marka</label>
                                <input type="text" name="marka" id="car_marka" class="form-control" required="" readonly=""> 
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
                                <input type="text" name="model" id="car_model" class="form-control" required="" readonly=""> 
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
                                <input type="text" name="nr_rej" id="car_nr_rej" class="form-control" required="" readonly=""> 
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
                                <input type="text" name="rok" id="car_rok" class="form-control" required="" readonly=""> 
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
                                <input type="text" name="ccm" id="car_ccm" class="form-control" required="" readonly=""> 
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
                                    <input type="hidden" name="turbo" class="car_turbo">
                                    <input class="form-check-input car_turbo" type="checkbox" id="turbo" disabled="">
                                    <label class="form-check-label" for="turbo">Tak</label>
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
                                    <input type="hidden" name="rwd" class="car_rwd">
                                    <input class="form-check-input car_rwd" type="checkbox" id="rwd" disabled="">
                                    <label class="form-check-label" for="rwd">Tak</label>
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
                                <select name="klasa" class="form-control" id="sign_klasa" required="">
                                    <option disabled selected value>Wybierz klasę</option>
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
                                Zgłoś udział
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>