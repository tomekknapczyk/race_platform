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
                <form method="POST" action="{{ route('saveRound') }}" enctype="multipart/form-data">
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
                        <label for="date">Termin</label>
                        <input type="date" name="date" id="edit_date" class="form-control" required=""> 
                        @if ($errors->has('date'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('date') }}</strong>
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

                    <div class="form-group">
                        <label for="price">Koszt uczestnictwa</label>
                        <input type="text" name="price" id="edit_price" class="form-control"> 
                        @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="advance">Wymagana zaliczka</label>
                        <input type="text" name="advance" id="edit_advance" class="form-control"> 
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

                    <div class="form-group">
                        <div class="checkbox">
                            <label for="deleteFile">
                                <input type="checkbox" name="deleteFile" id="deleteFile" value="1">
                                Usuń plik
                            </label>
                            @if ($errors->has('deleteFile'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('deleteFile') }}</strong>
                                </span>
                            @endif
                        </div>
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