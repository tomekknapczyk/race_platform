<div class="modal fade" tabindex="-1" role="dialog" id="acceptRequest" aria-labelledby="acceptRequest" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Akceptacja zaproszenia do teamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Czy na pewno chcesz dołączyć do tego teamu?</p>
                <form method="POST" action="{{ route('acceptRequest') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="team_id" id="edit_team_id">
                        
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Dołącz do teamu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>