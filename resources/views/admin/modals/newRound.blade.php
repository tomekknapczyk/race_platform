<div class="modal fade" tabindex="-1" role="dialog" id="newRound" aria-labelledby="newRound" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dodaj nową rundę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveRound') }}">
                    @csrf

                    <input type="hidden" name="race_id" value="{{ $race->id }}">
                    
                    <div class="form-group">
                        <label for="name">Nazwa</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required=""> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="termin">Termin</label>
                        <input type="text" name="termin" value="{{ old('termin') }}" class="form-control" required=""> 
                        @if ($errors->has('termin'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('termin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Dodaj rundę
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>