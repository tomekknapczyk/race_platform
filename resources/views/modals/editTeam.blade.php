<div class="modal fade" tabindex="-1" role="dialog" id="editTeam" aria-labelledby="editTeam" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edycja teamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('editTeam') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $team->id }}">

                    <div class="row">
                        <div class="col-sm-12">
                            @if($team->file_id)
                                <img src="{{ url('/public/team', $team->file->path) }}" class="img-fluid mb-4">
                            @endif
                            <div class="form-group">
                                <label for="photo">Zdjęcie teamu</label>
                                <input type="file" name="photo" class="form-control" required="">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="deletePhoto">
                                        <input type="checkbox" name="deletePhoto" id="deletePhoto" value="1">
                                        Usuń zdjęcie
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="opis">Opis:</label>
                                <textarea name="opis" class="tinymce_user" rows="4">{!! $team->text !!}</textarea>
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