<div class="modal fade" tabindex="-1" role="dialog" id="editDriver" aria-labelledby="editDriver" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj kierowcę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveDriver') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="edit_driver_id">

                    <div class="row">

                        <div class="col-sm-4">
                            <img src="" class="img-fluid img-thumbnail" id="edit_driver_photo">

                            <div class="form-group">
                                <label for="photo">Zdjęcie profilowe</label>
                                <input type="file" name="photo" class="form-control">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="deleteDriverPhoto">
                                        <input type="checkbox" name="deletePhoto" id="deleteDriverPhoto" value="1">
                                        Usuń zdjęcie
                                    </label>
                                    @if ($errors->has('deletePhoto'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('deletePhoto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr>
                            <h3>
                                Profil publiczny
                            </h3>

                            <div class="form-group mt-3">
                                <div class="checkbox">
                                    <label for="edit_driver_showName">
                                        <input type="checkbox" name="showName" id="edit_driver_showName">
                                        Pokazuj imie
                                    </label>
                                    @if ($errors->has('showName'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('showName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="edit_driver_showLastname">
                                        <input type="checkbox" name="showLastname" id="edit_driver_showLastname">
                                        Pokazuj nazwisko
                                    </label>
                                    @if ($errors->has('showLastname'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('showLastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="edit_driver_showEmail">
                                        <input type="checkbox" name="showEmail" id="edit_driver_showEmail">
                                        Pokazuj adres e-mail
                                    </label>
                                    @if ($errors->has('showEmail'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('showEmail') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8">

                            <div class="form-group">
                                <label for="name">Imię</label>
                                <input type="text" name="name" id="edit_driver_name" class="form-control" required=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="lastname">Nazwisko</label>
                                <input type="text" name="lastname" id="edit_driver_lastname" class="form-control" required=""> 
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">Adres</label>
                                <textarea name="address" class="form-control" rows="2" id="edit_driver_address"></textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="id_card">Seria nr dowodu osobistego</label>
                                <input type="text" name="id_card" id="edit_driver_id_card" class="form-control"> 
                                @if ($errors->has('id_card'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('id_card') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" id="edit_driver_phone" class="form-control"> 
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="driving_license">Nr prawo jazdy</label>
                                <input type="text" name="driving_license" id="edit_driver_driving_license" class="form-control"> 
                                @if ($errors->has('driving_license'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('driving_license') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="oc">Nazwa nr polisy OC</label>
                                <input type="text" name="oc" id="edit_driver_oc" class="form-control"> 
                                @if ($errors->has('oc'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('oc') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="nw">Nazwa nr polisy NW</label>
                                <input type="text" name="nw" id="edit_driver_nw" class="form-control"> 
                                @if ($errors->has('nw'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nw') }}</strong>
                                    </span>
                                @endif
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