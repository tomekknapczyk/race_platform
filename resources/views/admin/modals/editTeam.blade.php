<div class="modal fade" tabindex="-1" role="dialog" id="editTeam" aria-labelledby="editTeam" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveTeamTitle') }}">
                    @csrf
                    <input type="hidden" name="id" id="edit_team_id">

                    <div class="form-group">
                        <label for="name">Nazwa teamu</label>
                        <input type="text" name="name" id="edit_team_title" class="form-control" required=""> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz team
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>