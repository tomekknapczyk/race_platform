<div class="modal fade" tabindex="-1" role="dialog" id="editDriverLaurels" aria-labelledby="editDriverLaurels" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-info rounded-top">
                <h5 class="modal-title">Dodaj laur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addLaurel') }}">
                    @csrf

                    <input type="hidden" name="id" id="edit_laurel_id">
                    
                    <div class="form-group">
                        <label>Miejsce</label>
                        <select name="place" class="form-control" required="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Klasa</label>
                        <select name="klasa" class="form-control" required="">
                            <option value="k1">K1</option>
                            <option value="k2">K2</option>
                            <option value="k3">K3</option>
                            <option value="k4">K4</option>
                            <option value="k5">K5</option>
                            <option value="k6">K6</option>
                            <option value="k7">K7</option>
                            <option value="open">Open</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Rok</label>
                        <input type="text" name="year" class="form-control" required=""> 
                    </div>
                        
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                Dodaj
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>