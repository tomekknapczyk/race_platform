@if($round)
    <div class="row">
        <div class="col-sm-12">
            @foreach($round->canceled() as $sign)
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="new_sign_id" id="edit_staff_{{ $sign->id }}" value="{{ $sign->id }}">
                        <label for="edit_staff_{{ $sign->id }}" class="m-0">{{ $sign->name }} {{ $sign->lastname }} | {{ $sign->marka }} {{ $sign->model }} | {{ $sign->klasa }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    
@endif