<div class="modal fade" tabindex="-1" role="dialog" id="editSign" aria-labelledby="editSign" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Zgłoś swój udział</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('editSign') }}">
                    @csrf
                    <input type="hidden" name="id" id="sign_id">

                    <h3 class="text-center m-0">Wpłata za uczestnictwo</h3>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-3">
                            <div class="form-group text-center">
                                <label for="advance">Wpłacona kwota</label>
                                <input type="text" name="advance" id="advance" class="form-control text-center"> 
                                @if ($errors->has('advance'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('advance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h3 class="text-center m-0">Dane kierowcy</h3>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="driver_name">Imię</label>
                                <input type="text" name="driver_name" id="driver_name" class="form-control" required=""> 
                                @if ($errors->has('driver_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driver_lastname">Nazwisko</label>
                                <input type="text" name="driver_lastname" id="driver_lastname" class="form-control" required=""> 
                                @if ($errors->has('driver_lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driver_address">Adres</label>
                                <textarea name="driver_address" class="form-control" id="driver_address" rows="5"></textarea>
                                @if ($errors->has('driver_address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="col-6">
                            <div class="form-group">
                                <label for="driver_phone">Telefon</label>
                                <input type="text" name="driver_phone" id="driver_phone" class="form-control"> 
                                @if ($errors->has('driver_phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driver_email">Email</label>
                                <input type="email" name="driver_email" id="driver_email" class="form-control"> 
                                @if ($errors->has('driver_email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driver_id_card">Seria nr dowodu osobistego</label>
                                <input type="text" name="driver_id_card" id="driver_id_card" class="form-control"> 
                                @if ($errors->has('driver_id_card'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_id_card') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driver_driving_license">Nr prawo jazdy</label>
                                <input type="text" name="driver_driving_license" id="driver_driving_license" class="form-control"> 
                                @if ($errors->has('driver_driving_license'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_driving_license') }}</strong>
                                    </span>
                                @endif
                            </div>

{{--                             <div class="form-group">
                                <label for="driver_oc">Nazwa nr polisy OC</label>
                                <input type="text" name="driver_oc" id="driver_oc" class="form-control"> 
                                @if ($errors->has('driver_oc'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_oc') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driver_nw">Nazwa nr polisy NW</label>
                                <input type="text" name="driver_nw" id="driver_nw" class="form-control"> 
                                @if ($errors->has('driver_nw'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driver_nw') }}</strong>
                                    </span>
                                @endif
                            </div> --}}
                        </div>
                    </div>

                    <hr>
                    
                    <h3 class="text-center m-0">Dane pilota</h3>

                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Imię</label>
                                <input type="text" name="name" id="pilot_name" class="form-control" required=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="lastname">Nazwisko</label>
                                <input type="text" name="lastname" id="pilot_lastname" class="form-control" required=""> 
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">Adres</label>
                                <textarea name="address" class="form-control" id="pilot_address" rows="5"></textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" id="pilot_phone" class="form-control"> 
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="pilot_email" class="form-control"> 
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="id_card">Seria nr dowodu osobistego</label>
                                <input type="text" name="id_card" id="pilot_id_card" class="form-control"> 
                                @if ($errors->has('id_card'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('id_card') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driving_license">Nr prawo jazdy</label>
                                <input type="text" name="driving_license" id="pilot_driving_license" class="form-control"> 
                                @if ($errors->has('driving_license'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driving_license') }}</strong>
                                    </span>
                                @endif
                            </div>

{{--                             <div class="form-group">
                                <label for="oc">Nazwa nr polisy OC</label>
                                <input type="text" name="oc" id="pilot_oc" class="form-control"> 
                                @if ($errors->has('oc'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('oc') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="nw">Nazwa nr polisy NW</label>
                                <input type="text" name="nw" id="pilot_nw" class="form-control"> 
                                @if ($errors->has('nw'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nw') }}</strong>
                                    </span>
                                @endif
                            </div> --}}
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

                        <div class="col-sm-4">
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

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="oc">Nazwa nr polisy OC</label>
                                <input type="text" name="oc" id="car_oc" class="form-control" required=""> 
                                @if ($errors->has('oc'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('oc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nw">Nazwa nr polisy NW</label>
                                <input type="text" name="nw" id="car_nw" class="form-control"> 
                                @if ($errors->has('nw'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nw') }}</strong>
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
                                Zapisz
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>