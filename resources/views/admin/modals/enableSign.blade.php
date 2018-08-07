<div class="modal fade" tabindex="-1" role="dialog" id="enableSign" aria-labelledby="enableSign" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dołącz uczestnika do listy zgłoszeń</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="{{ route('enableSign') }}">
                    @csrf
                    <input type="hidden" name="id" id="enable_id">

                    <p class="h4 mt-4">Czy na pewno chcesz dołączyć wybranego uczestnika do listy?</p>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Dołącz
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>