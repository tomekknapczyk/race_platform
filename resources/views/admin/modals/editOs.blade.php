<div class="modal fade" tabindex="-1" role="dialog" id="editOs" aria-labelledby="editOs" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj odcinek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('updateOs') }}">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="form-group">
                        <label for="length">Długość odcinka</label>
                        <input type="text" name="length" class="form-control" id="edit_length" required=""> 
                        @if ($errors->has('length'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('length') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz odcinek
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>