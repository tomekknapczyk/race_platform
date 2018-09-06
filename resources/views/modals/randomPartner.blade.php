<div class="modal fade promoted" tabindex="-1" role="dialog" id="randomPartner" aria-labelledby="randomPartner" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-clear">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <img src="{{ url('public/partner', $promoted->file->path) }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>