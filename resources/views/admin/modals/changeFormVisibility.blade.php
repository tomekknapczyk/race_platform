<div class="modal fade" tabindex="-1" role="dialog" id="changeFormVisibility" aria-labelledby="changeFormVisibility" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Zmiana widoczności listy zgłoszeń</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="{{ route('changeFormVisibility') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $round->form->id }}">

                    @if($round->form->visible)
                        <span>Lista zgłoszeń jest widoczna</span>
                        <p class="h4 mt-4">Czy na pewno chcesz ją wyłączyć?</p>
                    @else
                        <span>Lista zgłoszeń jest niewidoczna</span>
                        <p class="h4 mt-4">Czy na pewno chcesz ją upublicznić?</p>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Zmień
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>