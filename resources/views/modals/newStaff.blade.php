<div class="modal fade" tabindex="-1" role="dialog" id="newStaff" aria-labelledby="newStaff" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dodaj nowego dziennikarza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('saveStaff') }}">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label for="name">Imię i nazwisko</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Adres email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required=""> 
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required=""> 
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="ice">Kontakt w razie wypadku (ICE)</label>
                                <input type="text" name="ice" value="{{ old('ice') }}" class="form-control" required=""> 
                                @if ($errors->has('ice'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ice') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="text-md-right">Rodzaj akredytacji:</label>

                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="type" id="Operator" value="Operator" required="">
                                  <label class="form-check-label" for="Operator">Operator</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="type" id="Fotograf" value="Fotograf" required="">
                                  <label class="form-check-label" for="Fotograf">Fotograf</label>
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