<div class="modal fade" tabindex="-1" role="dialog" id="newTeam" aria-labelledby="newTeam" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Utwórz nowy team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveTeam') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="photo">Zdjęcie teamu</label>
                                <input type="file" name="photo" class="form-control">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="name">Nazwa teamu</label>
                                <input type="text" name="name" class="form-control" required=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="text">Opis:</label>
                                <textarea name="text" class="tinymce_user" rows="4"></textarea>
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