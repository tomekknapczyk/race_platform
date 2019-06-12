@if($items)
    <div class="row">
        <div class="col-sm-12" style="columns: 2">
            @foreach($items as $item)
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="signs[{{ $item->sign->id }}]" id="edit_staff_{{ $item->sign->id }}" value="1">
                        <label for="edit_staff_{{ $item->sign->id }}" class="m-0">{{ $item->sign->name }} {{ $item->sign->lastname }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    
@endif