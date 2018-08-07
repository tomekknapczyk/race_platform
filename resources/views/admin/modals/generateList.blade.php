<div class="modal fade" tabindex="-1" role="dialog" id="generateList" aria-labelledby="generateList" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Generowanie listy startowej</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="{{ route('generateList') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $round->id }}">

                    <p class="h4 mt-4">Czy na pewno chcesz wygenerować listę startową?</p>

                    <div class="row mt-4">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Generuj
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>