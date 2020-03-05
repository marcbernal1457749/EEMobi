<input type="text" name="student" style="display: none;" value="Acord" class="type">
<div class="panel-heading">
  <div class="row">
    <div class="col col-xs-6">
      <h3 class="panel-title">Acord Estudis</h3>
    </div>
    <div class="col col-xs-6 text-right">
      <button type="button" class="btn btn-sm btn-primary btn-create" id="nou">Nou</button>
    </div>
  </div>
</div>
<div class="panel-body">
<input type="text" id="myInput" placeholder="Buscar...">
<div class="table-responsive">
<table  id="tableUE" class="table table-striped table-bordered table-list" cellspacing="10" >
    <thead>
      <tr>
        <th><em class="fa fa-cog"></em></th>
        <th style="display: none;">ID Estada</th>
        <th>Niu Estudiant</th>
        <th>Nom</th>
        <th>Enllaç Assignatura</th>
        <th>Codi Assignatura</th>
        <th>Crèdits</th>
        <th>Assignatura UAB</th>
        <th style="display: none;">id UAB</th>

      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($acords as $acord): ?>
      <tr>
        <td align="center">
          <a class="btn btn-default" id="editar"  at="<?php echo $acord->codiAcord; ?>"><em class="fa fa-pencil"></em></a>
          <a class="btn btn-danger"  id="deleteRowBtn" at="<?php echo $acord->codiAcord; ?>"><em class="fa fa-trash"></em></a>
        </td>
        <td style="display: none;"><?php echo $acord->codiEstada; ?></td>
        <td><?php echo $acord->niuEstudiant; ?></td>
        <td><?php echo $acord->nomAsignaturaDesti; ?></td>
        <td><?php echo $acord->linkAssignaturaDesti; ?></td>
        <td><?php echo $acord->codiAsignaturaDesti; ?></td>
        <td><?php echo $acord->creditsAsignaturaDesti; ?></td>
        <td><?php echo $acord->nomAssignatura; ?></td>
        <td style="display: none;"><?php echo $acord->codiAssignaturaUAB; ?></td>


      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

</div>
  <div class="col-md-12 text-center">
  <ul class="pagination pagination-lg pager" id="myPager"></ul>
  </div>
</div>
<div class="panel panel-info panel-custom" style="display: none;" id="show">   
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
               <form method="post" id="formall">
                  <input type="text" name="idunidegree" id="idtot" style="display: none;" value="asd">
                  <div class="form-group" id="dropunidiv">
                      <label for="sel1">Estada:</label>
                      <select name="estada" class="form-control selectpicker" data-live-search="true" data-size="5" id="dropestada">
                        <option value="-1">Tria una estada</option>
                        <?php foreach($stays as $stay): ?>
                        <option value="<?php echo $stay->codiEstada; ?>"><?php echo $stay->nom.' '.$stay->cognom.' - Niu: '.$stay->niuEstudiant; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="sel1">Nom assignatura destí:</label>
                      <input type="text" class="form-control" name="nomDesti" id="nomDesti" placeholder="Nom assignatura">
                    </div>
                    <div class="form-group">
                      <label for="sel1">Enllaç assignatura destí:</label>
                      <input type="text" class="form-control" name="linkDesti" id="linkDesti" placeholder="Enllaç">
                    </div>                    
                    <div class="form-group">
                      <label for="sel1">Codi assignatura destí:</label>
                      <input type="text" class="form-control" name="codiDesti" id="codiDesti" placeholder="Codi assignatura">
                    </div>
                    <div class="form-group">
                      <label for="sel1">Crèdits assignatura destí</label>
                      <input type="text" class="form-control" name="creditsDesti" id="creditsDesti" placeholder="Crèdits">
                    </div>
                    <div class="form-group" id="dropunidiv">
                      <label for="sel1">Assignatura UAB</label>
                      <select name="assignatura" class="form-control selectpicker" data-live-search="true" data-size="5" id="dropuni">
                        <option value="-1">Tria una assignatura</option>
                        <?php foreach($subjects as $subject): ?>
                        <option value="<?php echo $subject->codiAssignaturaUAB; ?>"><?php echo $subject->nomAssignatura." (".$subject->nomGrau.")"; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <input type="reset" class="btn btn-default btn-danger" value="Cancelar">
                    <input type="submit" name="submit" id="optionbutton" class="btn btn-info" value="">
                    
                </form>

            </div>
          </div>
        </div>
      </div>

