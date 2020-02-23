<input type="text" name="student" style="display: none;" value="UniPlace" class="type">
<div class="panel-heading">
  <div class="row">
    <div class="col col-xs-6">
      <h3 class="panel-title">Universitats - Graus</h3>
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
        <th>Descripció</th>
        <th>Places</th>
        <th>Mesos</th>
        <th>Període</th>
        <th>Actiu</th>
        <th style="display:none;">codiCentreEstudis</th>
        <th style="display:none;">codiUniEstudis</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($universities as $university): ?>
      <tr>
        <td align="center">
          <a class="btn btn-default" id="editar"  at="<?php echo $university->codiCentreEstudis; ?>"><em class="fa fa-pencil"></em></a>
          <a class="btn btn-danger"  id="deleteRowBtn" at="<?php echo $university->codiCentreEstudis; ?>"><em class="fa fa-trash"></em></a>
        </td>
        <td>
            <p><?php echo $university->nomUniversitat; ?></p>   
            <p><?php echo $university->nomGrau; ?></p>         
        </td>        
        <td><?php echo $university->plaçes ?></td>
        <td><?php echo $university->mesos ?></td>
        <td><?php echo $university->període ?></td>
        <td><?php echo $university->actiu == true ? 'Sí':'No'; ?></td>
        <td style="display:none;"><?php echo $university->codiCentreEstudis; ?></td>
        <td style="display:none;"><?php echo $university->codiUniEstudis; ?></td>
      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

</div>
  <div class="col-md-12 text-center">
  <ul class="pagination pagination-lg pager" id="myPager"></ul>
  </div>
</div>
<hr>
<div class="panel panel-info panel-custom" style="display: none;" id="show">   
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" id="formall">

                    <input type="text" name="idunidegree" id="idtot" style="display: none;" value="asd">                    
                    <div class="form-group" id="dropunidiv">
                    <label for="sel1">Universitat - Grau:</label>
                      <select name="university" class="form-control selectpicker" data-live-search="true" data-size="5" id="dropuni">
                        <option value="-1">Tria una universitat i un grau</option>
                        <?php foreach($allUniversities as $allUniversity): ?>
                        <option value="<?php echo $allUniversity->codiUniEstudis; ?>"><?php echo $allUniversity->nomGrau.' - ' .$allUniversity->nomUniversitat; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group" style="display: none;" id="unigdiv">
                      <label for="sel1">Universitat - Grau:</label>
                      <input type="text" class="form-control" name="unig" id="unig" placeholder="Uni" value="Uni-Grau">
                    </div>
                    <div class="form-group">
                      <label for="sel1">Places:</label>
                      <input type="text" class="form-control" name="places" id="places" placeholder="Places">
                    </div>
                    <div class="form-group">
                      <label for="sel1">Mesos:</label>
                      <input type="text" class="form-control" name="mesos" id="mesos" placeholder="Mesos">
                    </div>
                    <div class="form-group">
                      <label for="sel1">Període:</label>
                      <input type="text" class="form-control" name="periode" id="periode" placeholder="Període">
                    </div>
                    <div class="form-group" id="teacherdiv">
                    <label for="sel1">Professor responsable:</label>
                      <select name="teacher" class="form-control selectpicker" data-live-search="true" data-size="5" id="teacher">
                        <option value="-1">Tria una professor responsable.</option>
                        <?php foreach($teachers as $teacher): ?>
                        <option value="<?php echo $teacher->niuProfessor; ?>"><?php echo $teacher->nom.' '.$teacher->cognoms; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <label for="sel1">Actiu:</label>
                    <div class="form-group">
                      <label class="radio-inline">
                        <input type="radio" name="actiu" value="Sí">Sí
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="actiu" value="No">No
                      </label>
                   </div>
                    <input type="reset" class="btn btn-default btn-edit" value="Cancelar">
                    <input type="submit" name="submit" id="optionbutton" class="btn btn-info" value="">
                    
                </form>

            </div>
          </div>
        </div>
      </div>


