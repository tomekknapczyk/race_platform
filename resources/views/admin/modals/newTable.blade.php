<div class="modal fade" tabindex="-1" role="dialog" id="newTable" aria-labelledby="newTable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dodaj nową tabelę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveTable') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Tytuł</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required=""> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="subname">Podtytuł</label>
                        <input type="text" name="subname" value="{{ old('subname') }}" class="form-control"> 
                        @if ($errors->has('subname'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('subname') }}</strong>
                            </span>
                        @endif
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