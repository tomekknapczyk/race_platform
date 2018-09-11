<div class="modal fade" tabindex="-1" role="dialog" id="editCar" aria-labelledby="editCar" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj samochód</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveCar') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="edit_car_id">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="" class="img-fluid img-thumbnail" id="edit_car_photo">

                            <div class="form-group">
                                <label for="photo">Zdjęcie</label>
                                <input type="file" name="photo" class="form-control">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="deleteCarPhoto">
                                        <input type="checkbox" name="deletePhoto" id="deleteCarPhoto" value="1">
                                        Usuń zdjęcie
                                    </label>
                                    @if ($errors->has('deletePhoto'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('deletePhoto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="marka">Marka</label>
                                        <input type="text" name="marka" id="edit_marka" class="form-control" required=""> 
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
                                        <input type="text" name="model" id="edit_model" class="form-control" required=""> 
                                        @if ($errors->has('model'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('model') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nr_rej">Numer rejestracyjny</label>
                                        <input type="text" name="nr_rej" id="edit_nr_rej" class="form-control" required=""> 
                                        @if ($errors->has('nr_rej'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nr_rej') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rok">Rok produkcji</label>
                                        <input type="text" name="rok" id="edit_rok" class="form-control" required=""> 
                                        @if ($errors->has('rok'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('rok') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="ccm">Pojemność ccm</label>
                                        <input type="text" name="ccm" id="edit_ccm" class="form-control" required=""> 
                                        @if ($errors->has('ccm'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('ccm') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="model">Turbo</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="turbo" id="edit_turbo" value="1">
                                          <label class="form-check-label" for="edit_turbo">Tak</label>
                                        </div>
                                        @if ($errors->has('turbo'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('turbo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="model">RWD</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="rwd" id="edit_rwd" value="1">
                                          <label class="form-check-label" for="edit_rwd">Tak</label>
                                        </div>
                                        @if ($errors->has('rwd'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('rwd') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz samochód
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>