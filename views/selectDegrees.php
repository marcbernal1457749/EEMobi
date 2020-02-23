<div class="form-group">
    <label for="sel1">Grau:</label>
    <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectDegree" >
        <option value="-1">Selecciona un grau</option>
             <?php foreach($degrees as $degree): ?>
        <option value="<?php echo $degree->codiEstudis; ?>"><?php echo $degree->nomGrau; ?></option>
             <?php endforeach; ?>
    </select>
</div>