@if($staff)
    @foreach($staff as $person)
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