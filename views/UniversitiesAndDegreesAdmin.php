<input type="text" name="student" style="display: none;" value="UniStudy" class="type">
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
        <th>Universitat</th>
        <th>Grau</th>
        <th style="display:none;">Id Universitat</th>
        <th style="display:none;">Codi Grau</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($universities as $university): ?>
      <tr>
        <td align="center">
          <a class="btn btn-default" id="editar"  at="<?php echo $university->codiUniEstudis; ?>"><em class="fa fa-pencil"></em></a>
          <a class="btn btn-danger"  id="deleteRowBtn" at="<?php echo $university->codiUniEstudis; ?>"><em class="fa fa-trash"></em></a>
        </td>
        <td><?php echo $university->nomUniversitat; ?></td>        
        <td><?php echo $university->nomGrau ?></td>
        <td style="display:none;"><?php echo $university->idUniversitat; ?></td>
        <td style="display:none;"><?php echo $university->codiEstudis; ?></td>
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
                    <label for="sel1">Universitat - Grau:</label>
                    <select name="university" class="form-control selectpicker" data-live-search="true" data-size="5" id="dropuni">
                      <option value="-1">Tria una universitat</option>
                      <?php foreach($allUniversities as $allUniversity): ?>
                      <option value="<?php echo $allUniversity->idUniversitat; ?>"><?php echo $allUniversity->nomUniversitat; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <select name="degree" class="form-control selectpicker" data-live-search="true" data-size="5" id="dropgrau">
                      <option value="-1">Tria grau</option>
                      <?php foreach($degrees as $degree): ?>
                      <option value="<?php echo $degree->codiEstudis; ?>"><?php echo $degree->nomGrau; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <input type="reset" class="btn btn-default btn-edit" value="Cancelar">
                    <input type="submit" name="submit" id="photobutton" class="btn btn-info" value="">                
                </form>
            </div>
          </div>
        </div>
      </div>
