<div class="modal fade" tabindex="-1" role="dialog" id="editCustomTable" aria-labelledby="editCustomTable" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj tabelę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveCustomTable') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="edit_custom_id">

                    <div class="form-group">
                        <label for="name">Tytuł</label>
                        <input type="text" name="name" id="edit_custom_name" class="form-control" required=""> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="subname">Podtytuł</label>
                        <input type="text" name="subname" id="edit_custom_subname" class="form-control"> 
                        @if ($errors->has('subname'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('subname') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="data_file">Plik z danymi</label>
                        <input type="file" name="data_file" class="form-control">
                        @if ($errors->has('data_file'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('data_file') }}</strong>
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