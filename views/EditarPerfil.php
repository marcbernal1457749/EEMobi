
  <hr>
	<div class="row">
      <!-- left column -->
      <div class="col-sm-3">
        <div class="text-center">
            
            <img src="/EEmobi/resources/img/profile.png" class="avatar img-thumbnail img-profile-tmp" alt="avatar"> 
            <form class="form-horizontal" role="form" action="" id="fileUpload" enctype="multipart/form-data" >    
              <label class="btn btn-primary btn-search">
                    Buscar foto<input type="file" name="file" id="file" style="display: none;">

              </label>
               <input type="submit" name="filebuton" class="btn btn-primary btn-custom" value="Eliminar "> <!-- TODO: Implementar -->
              <input type="submit" name="filebuton" class="btn btn-primary btn-custom" value="Desar" disabled="true">
            </form>
        </div>
        <div class="text-center" id="debugimg">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-sm-9 personal-info">

        <h5>Informació personal</h5>     
        <form class="form-horizontal" role="form" id="formulari">
            <div class="col-md-8 input-group">
              <span class="input-group-addon"><i class="fa fa-university"></i></span>
              <input type="text" class="form-control" name="niu" placeholder="Niu" disabled="true" value="<?php echo $niu; ?>">
            </div>
            <div class="col-md-8 input-group">
              <span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
              <input type="text" class="form-control" required name="nom" placeholder="Nom" value="<?php echo $nom; ?>">
            </div>
            <div class="col-md-8 input-group">
              <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
              <input type="text" class="form-control" required name="cognom"  placeholder="Cognom" value="<?php echo $cognom; ?>">
            </div>
            <div class="col-md-8 input-group">
              <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="correu"  pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,3}$" placeholder="Correu" value="<?php echo $correu; ?>">
            </div>
            <br>
            <div class="col-md-8 input-group">
              <label>Nom públic: </label>
            </div>
             <div class="col-md-8 input-group">

              <label class="radio-inline">
                <input type="radio" name="opcioNom"  <?php echo $checkedNom == true ? 'checked' : ''; ?> value="Si">Sí
              </label>
              <label class="radio-inline">
                <input type="radio" name="opcioNom" <?php echo $checkedNom == true ? '' : 'checked'; ?> value="No">No
              </label>
            </div>
            <br>
            <div class="col-md-8 input-group">
              <label>Correu públic: </label>
            </div>
             <div class="col-md-8 input-group">
              <label class="radio-inline">
                <input type="radio" name="opcioCorreu" <?php echo $checkedCorreu == true ? 'checked' : ''; ?> value="Si">Sí
              </label>
              <label class="radio-inline">
                <input type="radio" name="opcioCorreu" <?php echo $checkedCorreu == true ? '' : 'checked'; ?> value="No">No
              </label>
            </div>
            <div class="col-md-8 input-group" id="debug">
            </div>
            <div class="col-md-8 input-group">              
              <input type="reset" class="btn btn-default btn-edit" value="Desfés canvis">
              <input type="button" class="btn btn-default btn-edit btn-person" value="Desar canvis">
            </div>

        </form>
      </div>
  </div>
  <hr>

