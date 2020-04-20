<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Publicar opinió</h4>
  </div>
  <div class="modal-body">
    <form id="formPubli">
    <div class="form-group">
        <input type="hidden" id="codiAcord" value="<?php echo $codiAcord; ?>">
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

      <button type="submit" class="btn btn-primary" id="publicarOpSubject">Publicar</button>
  </div>
    <div class="text-center" id="debugimg">
</div>