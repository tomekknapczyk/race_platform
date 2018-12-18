<div class="d-flex flex-wrap">
    <div class="form-group col-12 col-md-4">
        <label for="sectionName">Nazwa odcinka</label>
        <input type="text" name="section[{{ $id }}][name]" class="form-control"> 
    </div>

    <div class="form-group col-12 col-md-4">
        <label for="sectionName">Długość odcinka</label>
        <input type="text" name="section[{{ $id }}][length]" class="form-control"> 
    </div>

    <div class="form-group col-12 col-md-4">
        <label for="advance">Mapa odcinka</label>
        <input type="file" name="section[{{ $id }}][map]" class="form-control">
    </div>
</div>