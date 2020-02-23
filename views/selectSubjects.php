
    <label for="sel1">Assignatures:</label>
    <select class="selectpicker form-control" id="subjectSelector" >
        <option value="-1">Selecciona una assignatura </option>
        <?php foreach($assignatures as $assignatura): ?>
            <option value="<?php echo $assignatura->codiAssignaturaUAB; ?>"><?php echo $assignatura->nomAssignatura; ?></option>
        <?php endforeach; ?>
    </select>