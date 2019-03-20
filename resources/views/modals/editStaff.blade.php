<div class="modal fade" tabindex="-1" role="dialog" id="editStaff" aria-labelledby="editStaff" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj dziennikarza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveStaff') }}">
                    @csrf

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label for="name">Imię i nazwisko</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Adres email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required=""> 
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" id="edit_phone" class="form-control"> 
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="ice">Kontakt w razie wypadku (ICE)</label>
                                <input type="text" name="ice" id="edit_ice" class="form-control"> 
                                @if ($errors->has('ice'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ice') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="text-md-right">Rodzaj akredytacji:</label>

                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="type" id="edit_operator" value="Operator" required="">
                                  <label class="form-check-label" for="edit_operator">Operator</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="type" id="edit_fotograf" value="Fotograf" required="">
                                  <label class="form-check-label" for="edit_fotograf">Fotograf</label>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
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