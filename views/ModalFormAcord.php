<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Acord d'estudis</h4>
  </div>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Crear</a></li>
    <li><a data-toggle="tab" href="#menu1">Acords</a></li>
  </ul>
  <div class="modal-body">
    <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <form id="formAcord">
        <div class="form-group">
          <label for="idEstudiant">Estudiants:</label>
          <select class="form-control" name="codiEstada">
            <option value="-1">Tria un estudiant</option>
            <<?php foreach ($stays as $stay): ?>
              <option value="<?php echo $stay->codiEstada; ?>"><?php echo $stay->nom.' '.$stay->cognom.' Niu: ' .$stay->niuEstudiant; ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="sel1">Nom assignatura destí:</label>
          <input type="text" class="form-control" name="nomDesti" placeholder="Nom assignatura">
        </div>
        <div class="form-group">
          <label for="sel1">Enllaç assignatura destí:</label>
          <input type="text" class="form-control" name="linkDesti" placeholder="Enllaç">
        </div>
        <div class="form-group">
          <label for="sel1">Codi assignatura destí:</label>
          <input type="text" class="form-control" name="codiDesti" placeholder="Codi assignatura">
        </div>
        <div class="form-group">
          <label for="sel1">Crèdits assignatura destí</label>
          <input type="text" class="form-control" name="creditsDesti" placeholder="Crèdits">
        </div>
        <div class="form-group" id="dropunidiv">
          <label for="sel1">Assignatura UAB</label>
          <select name="assignatura" class="form-control selectpicker" data-live-search="true" data-size="5">
            <option value="-1">Tria una assignatura</option>
            <?php foreach($subjects as $subject): ?>
            <option value="<?php echo $subject->codiAssignaturaUAB; ?>"><?php echo $subject->nomAssignatura; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </form>
    </div>
    <div id="menu1" class="tab-pane fade">
      <div class="table-responsive">
        <table class="table table-hover cell-border display compact" id="test">
          <thead>
            <tr>
              <th>Niu Estudiant</th>
              <th>Nom</th>
              <th>Enllaç Assignatura</th>
              <th>Assignatura UAB</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($agreements as $agree): ?>
            <tr >
              <td><?php echo $agree->niuEstudiant; ?></td>
              <td><?php echo $agree->nomAsignaturaDesti; ?></td>
              <td><?php echo $agree->linkAssignaturaDesti; ?></td>
              <td><?php echo $agree->nomAssignatura; ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

      <button type="submit" class="btn btn-default" id="crearAcord">Crear</button>
  </div>
  <div class="text-center" id="debugimg">
</div>