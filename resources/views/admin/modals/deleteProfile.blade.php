<div class="modal fade" tabindex="-1" role="dialog" id="deleteUser" aria-labelledby="deleteUser" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Usuń użytkownika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('deleteProfile') }}">
                    @csrf

                    <input type="hidden" name="id" id="delete_id">
                    <h3>Na pewno usunąć użytkownika?</h3>
                        
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-danger btn-block">
                                Usuń
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>