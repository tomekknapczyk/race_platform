<div class="modal fade" tabindex="-1" role="dialog" id="signFormStatus" aria-labelledby="signFormStatus" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Zmień status formularza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="{{ route('signFormStatus') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $round->form->id }}">

                    @if($round->form->active)
                        <span>Formularz zgłoszeniowy jest włączony</span>
                        <p class="h4 mt-4">Czy na pewno chcesz go wyłączyć?</p>
                    @else
                        <span>Formularz zgłoszeniowy jest wyłączony</span>
                        <p class="h4 mt-4">Czy na pewno chcesz go włączyć?</p>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Zmień status
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>