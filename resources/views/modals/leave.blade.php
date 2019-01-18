<div class="modal fade" tabindex="-1" role="dialog" id="leaveTeam" aria-labelledby="leaveTeam" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Opuszczenie teamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Czy na pewno chcesz opuścić team?</p>
                <form method="POST" action="{{ route('leaveTeam') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $team->id }}">
                    @if(auth()->user()->team_admin() && $team->other_members->count())
                        <p>Musisz wybrać administratora dla teamu</p>
                        <select name="admin" required="" class="form-control mb-4">
                            @foreach($team->other_members as $member)
                                <option value="{{ $member->user_id }}">{{ $member->user->profile->name }} {{ $member->user->profile->lastname }}</option>
                            @endforeach
                        </select>
                    @elseif(auth()->user()->team_admin() && !$team->other_members->count())
                        <input type="hidden" name="admin" value="0">
                    @endif
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-danger btn-block">
                                Opuść team
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>