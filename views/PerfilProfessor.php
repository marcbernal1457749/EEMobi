        
<div class="contingut">
  <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1default" data-toggle="tab">Acords d'estudi</a></li>
      <li><a href="#tab2default" data-toggle="tab">Publicacions</a></li>
  </ul>
  <br>
  <div class="panel-heading panel-heading-custom">

      <div class="pull-right">
        <span class="clickable filter" data-toggle="tooltip" title="Filtrar" data-container="body">
          <i class="fa fa-search"></i>
        </span>
      </div>
      <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Busca" />
  </div>
  <div class="panel-body">
      <div class="tab-content">
          <div class="tab-pane fade in active no-info" id="tab1default">
              <?php if($isAdmin){ ?>
                  <input type="hidden" id="niuProfessor" value="<?php echo $niu; ?>">
                  <div class="padding-bottom-20">
                      <select id="selectIfAdmin">
                          <option id="mineAdmin" value="mineAdmin">Les meves Universitats</option>
                          <option id="allAdmin" value="allAdmin">Totes les Universitats</option>
                      </select>
                  </div>
              <?php } ?>
            <div class="table-responsive">
              <table class="table table-hover cell-border display compact" id="dev-table">
                <thead>
                  <tr>
                    <th>Universitat</th>
                      <th>Grau</th>
                    <th>Places</th>
                    <th>Mesos</th>
                    <th>Període</th>
                      <th>Assignatures</th>
                    <th><em class="fa fa-cog"></em></th>

                  </tr>
                </thead>
                <tbody id="taulaAcordsCoordinador">
                  <?php foreach ($agree as $ag): ?>
                  <tr >
                    <td><?php echo $ag->nomUniversitat; ?></td>
                      <td><?php echo $ag->nomGrau; ?></td>
                    <td><?php echo $ag->plaçes; ?></td>
                    <td><?php echo $ag->mesos; ?></td>
                    <td><?php echo $ag->període; ?></td>
                      <td align="center">
                          <a href="#" id="assignaturesp" at="<?php echo $ag->codiConveni; ?>">Opinar</a>
                      </td>
                    <td align="center">
                      <a href="#" id="publicarp" at="<?php echo $ag->idUniversitat; ?>">Publicar</a> / <a href="#" id="acordp" at="<?php echo $ag->codiConveni; ?>">Acord</a>
                   </td>

                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
              <div class="modal fade" id="myModal" role="dialog">
                              <div class="modal-dialog">
                                
                              </div>
              </div>
              <div id="debug">

              </div>
            </div>
          </div>