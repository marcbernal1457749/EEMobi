<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Publicar opinió</h4>
  </div>
  <div class="modal-body">
    <form id="formPubli">
    <div class="form-group">
        <input type="hidden" id="idUniversitat" value="<?php echo $idUniversitat; ?>">
      <label for="categoriaPublicacio">Selecciona una categoria:</label>
      <select class="form-control" id="categoriaPublicacio">
        <?php foreach ($categories as $category):?>
          <option value="<?php echo $category['idCategoria'] ;?>"><?php echo $category['titolCategoria'];?></option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="form-group">
      <label for="textpubli">Escriu un comentari:</label>
      <textarea class="form-control" id="text-publi" rows="5" maxlength="500"></textarea>
      <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
    <label for="inputFile">Foto(Opcional):</label>
    <input type="file" class="form-control-file" id="inputFile" aria-describedby="fileHelp">
  </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

    <button type="submit" class="btn btn-primary" id="publicar">Publicar</button>
</div>
<div class="text-center" id="debugimg">
</div>
</div>