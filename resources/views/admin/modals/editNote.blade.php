<div class="modal fade" tabindex="-1" role="dialog" id="editNote" aria-labelledby="editNote" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj rajd</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveNote') }}">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="form-group">
                        <label for="name">Komunikat</label>
                        <input type="text" name="text" id="edit_text" class="form-control" required=""> 
                        @if ($errors->has('text'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz komunikat
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>