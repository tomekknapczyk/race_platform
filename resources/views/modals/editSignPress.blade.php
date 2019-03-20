<div class="modal fade" tabindex="-1" role="dialog" id="editSignPress" aria-labelledby="editSignPress" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj zgłoszenie<h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('editSignPress') }}">
                    @csrf
                    <input type="hidden" name="round_id" id="edit_form_id">

                    <h3 class="text-center my-2">Wybierz dziennikarzy</h3>
                    <hr>
                    @if(auth()->user()->staff)
                        @foreach(auth()->user()->staff as $person)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="staff[{{ $person->id }}]" id="edit_staff_{{ $person->id }}" value="1">
                                            <label for="edit_staff_{{ $person->id }}" class="m-0">{{ $person->name }} - {{ $person->type }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

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