<div class="form-group">
    <label for="sel1">País Destinació:</label>
    <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectCountry" >
        <option value="-1">Selecciona un país </option>
            <?php foreach($countries as $country): ?>
        <option value="<?php echo $country->idPais; ?>"><?php echo $country->nomPais; ?></option>
            <?php endforeach; ?>
    </select>
 </div>