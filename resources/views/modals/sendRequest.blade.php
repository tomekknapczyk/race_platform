<div class="modal fade" tabindex="-1" role="dialog" id="sendRequest" aria-labelledby="sendRequest" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Zaproszenie do teamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Wysłać zaproszenie do teamu {{ auth()->user()->team()->title }}?</p>
                <form method="POST" action="{{ route('sendTeamRequest') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="team_id" value="{{ auth()->user()->team()->id }}">
                        
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Wyślij
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>