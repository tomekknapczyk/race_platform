<div class="modal fade" tabindex="-1" role="dialog" id="editRound" aria-labelledby="editRound" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj rajd</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveRound') }}">
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
                        <label for="termin">Termin</label>
                        <input type="text" name="termin" id="edit_termin" class="form-control" required=""> 
                        @if ($errors->has('termin'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('termin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="max">Maksymalna ilość uczestników</label>
                        <input type="number" min="0" name="max" id="edit_max" class="form-control" required=""> 
                        @if ($errors->has('max'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('max') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz rundę
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>