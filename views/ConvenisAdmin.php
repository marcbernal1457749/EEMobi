<input type="text" name="student" style="display: none;" value="Conveni" class="type">
<div class="panel-heading">
  <div class="row">
    <div class="col col-xs-6">
      <h3 class="panel-title">Convenis</h3>
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
        <th>Codi Conveni</th>
        <th>Universitat - Grau</th>
        <th>Informació rellevant</th>
        <th style="display:none;">codiCentreEstudis</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php foreach($convenis as $conveni): ?>
      <tr>
        <td align="center">
          <a class="btn btn-default" id="editar"  at="<?php echo $conveni->codiConveni; ?>"><em class="fa fa-pencil"></em></a>
          <a class="btn btn-danger"  id="deleteRowBtn" at="<?php echo $conveni->codiConveni; ?>"><em class="fa fa-trash"></em></a>
        </td>
        <td><?php echo $conveni->codiConveni; ?> </td>  
        <td>
            <p><?php echo $conveni->nomUniversitat; ?></p>   
            <p><?php echo $conveni->nomGrau; ?></p>         
        </td> 
        <td>
          <p><b>Places:</b> <?php echo $conveni->plaçes; ?></p>
          <p><b>Mesos:</b> <?php echo $conveni->mesos; ?></p>
          <p><b>Període:</b> <?php echo $conveni->període; ?></p>
          
        </td>       
        <td style="display:none;"><?php echo $conveni->codiCentreEstudis; ?></td>

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
                      <label for="sel1">Universitats - Plaçes:</label>
                      <select name="university" class="form-control selectpicker" data-live-search="true" data-size="5" id="dropuni">
                        <option value="-1">Tria una universitat i un grau</option>
                        <?php foreach($universities as $university): ?>
                        <option value="<?php echo $university->codiCentreEstudis; ?>"><?php echo $university->nomGrau.' - ' .$university->nomUniversitat.' - P:'.$university->plaçes.' - M:'.$university->mesos.' - P:'.$university->període; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="sel1">Codi Conveni:</label>
                      <input type="text" class="form-control" name="conveni" id="conveni" placeholder="Conveni">
                    </div>
                    <input type="reset" class="btn btn-default btn-edit" value="Cancelar">
                    <input type="submit" name="submit" id="optionbutton" class="btn btn-info" value="">
                    
                </form>

            </div>
          </div>
        </div>
      </div>

