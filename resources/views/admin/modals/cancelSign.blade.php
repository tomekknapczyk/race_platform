<div class="modal fade" tabindex="-1" role="dialog" id="cancelSign" aria-labelledby="cancelSign" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Wyklucz uczestnika</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="{{ route('cancelSign') }}">
                    @csrf
                    <input type="hidden" name="id" id="cancel_id">

                    <p class="h4 mt-4">Czy na pewno chcesz wykluczyć wybranego uczestnika?</p>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-danger btn-block">
                                Wyklucz
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>