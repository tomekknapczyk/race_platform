<div class="modal fade" tabindex="-1" role="dialog" id="editRace" aria-labelledby="editRace" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj rajd</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveRace') }}">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="form-group">
                        <label for="name">Nazwa</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required=""> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="year">Rok</label>
                        <input type="text" name="year" id="edit_year" class="form-control" required=""> 
                        @if ($errors->has('year'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group d-none">
                        <label for="minTeam">Minimalna ilość zespołów z teamu</label>
                        <input type="text" name="minTeam" id="edit_minTeam" class="form-control"> 
                        @if ($errors->has('minTeam'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('minTeam') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Aktualny rajd</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="active" value="1" id="edit_active">
                                <label class="form-check-label" for="active">Tak</label>
                            </div>
                            @if ($errors->has('active'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('active') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Rajd zakończony</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="complete" value="1" id="edit_complete">
                                <label class="form-check-label" for="complete">Tak</label>
                            </div>
                            @if ($errors->has('complete'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('complete') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz rajd
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>