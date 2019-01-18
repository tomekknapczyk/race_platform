<div class="modal fade" tabindex="-1" role="dialog" id="deleteRequest" aria-labelledby="deleteRequest" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Usunięcie zaproszenia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Czy na pewno chcesz usunąć to zaproszenie?</p>
                <form method="POST" action="{{ route('deleteRequest') }}">
                    @csrf
                    <input type="hidden" name="request_id" id="edit_request_id">
                        
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