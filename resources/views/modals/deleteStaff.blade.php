<div class="modal fade" tabindex="-1" role="dialog" id="deleteStaff" aria-labelledby="deleteStaff" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Usuń dziennikarza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('deleteStaff') }}">
                    @csrf
                    <input type="hidden" name="id" id="delete_id">
                    
                    <p class="h5 text-center">Czy jesteś pewien, że chcesz usunąć wybranego dziennikarza?</p>

                    <div class="row mt-4">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-danger btn-block">
                                Usuń dziennikarza
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>