<div class="modal fade" tabindex="-1" role="dialog" id="changeSignAdmin" aria-labelledby="changeSignAdmin" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Zmiana uczestnika<h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('changeSignAdmin') }}">
                    @csrf
                    <input type="hidden" name="round_id" id="change_round_id">
                    <input type="hidden" name="sign_id" id="change_sign_id">

                    <h4 class="text-center my-2">Wybierz uczestnika</h4>
                    <hr>
                    <div id="reserve_list">

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zapisz
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>