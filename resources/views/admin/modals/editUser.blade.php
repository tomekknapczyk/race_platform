<div class="modal fade" tabindex="-1" role="dialog" id="editUser" aria-labelledby="editUser" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Edytuj kierowcę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edit_import_users') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label for="nr">Nr</label>
                                <input type="text" name="nr" id="edit_nr" class="form-control" required=""> 
                                @if ($errors->has('nr'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nr') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Kierowca</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required=""> 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="pilot">Pilot</label>
                                <input type="text" name="pilot" id="edit_pilot" class="form-control"> 
                                @if ($errors->has('pilot'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('pilot') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="car">Samochód</label>
                                <input type="text" name="car" id="edit_car" class="form-control" required="">
                                @if ($errors->has('car'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('car') }}</strong>
                                    </span>
                                @endif
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