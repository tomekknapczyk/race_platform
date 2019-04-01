<div class="modal fade" tabindex="-1" role="dialog" id="deleteSign" aria-labelledby="deleteSign" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Usuń zgłoszenie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('deleteSign') }}">
                    @csrf
                    <input type="hidden" name="id" id="delete_id">
                    
                    <p class="h5 text-center">Czy jesteś pewien, że chcesz usunąć zgłoszenie?</p>

                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-danger btn-block">
                                Usuń zgłoszenie
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>