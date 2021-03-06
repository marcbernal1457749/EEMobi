<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Opinar Assignatures Destí</h4>
  </div>
  <div class="modal-body">
    <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <form id="formAcord">
        <div class="form-group">
          <label for="idEstudiant">Assignatura:</label>
          <select class="form-control" id="codiAsignatura">
            <?php foreach ($agreements as $agreement): ?>
              <option id="<?php echo $agreement->codiAsignaturaDesti . ',' . $agreement->codiAcord;?> " value="<?php echo $agreement->nomAsignaturaDesti; ?>"><?php echo $agreement->nomAsignaturaDesti; ?></option>
            <?php endforeach ?>
          </select>
        </div>
          <div class="form-group">
              <label for="textpubli">Escriu un comentari:</label>
              <textarea class="form-control" id="text-publi" rows="5" maxlength="500"></textarea>
              <small id="emailHelp" class="form-text text-muted"></small>
          </div>

      </form>
    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            <button type="submit" class="btn btn-primary" id="publicarTeacherOpSubject">Publicar</button>
        </div>

  </div>
  <div class="text-center" id="debugimg">
</div>