<div class="modal fade" tabindex="-1" role="dialog" id="unbanUser" aria-labelledby="unbanUser" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Odblokuj użytkownika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('unbanUser') }}">
                    @csrf

                    <input type="hidden" name="id" id="unban_id">
                    <h3>Na pewno odblokować użytkownika?</h3>
                        
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Odblokuj
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>