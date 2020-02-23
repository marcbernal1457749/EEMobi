<input type="text" name="student" style="display: none;" value="university" class="type">
<div class="panel-heading">
    <div class="row">
        <div class="col col-xs-6">
            <h3 class="panel-title">Universitats</h3>
        </div>
        <div class="col-xs-6">
            <h6><b>Indicacions</b>: Per buscar la longitud i latitud: <a href="https://www.coordenadas-gps.com/">https://www.coordenadas-gps.com/</a></h6>
        </div>
        <div class="col-sm-12">
            <button onclick="createUniversitiesBackend()" type="button" class="list-group-item CUV" id="CUV" class="btn btn-sm btn-primary btn-create">Afegir</button>
        </div>
        <div class="col-sm-12">
            <div class="pull-right">
        <span class="clickable filter" data-toggle="tooltip" title="Filtrar" data-container="body">
          <i class="fa fa-search"></i>
        </span>
            </div>
            <input type="text" class="form-control" id="inputFilteringUni" onkeyup="filterTableUnis()" placeholder="Buscar">
        </div>

    </div>
</div>
<div class="panel-body">
    <div class="table-responsive">

        <table id="FullTable" class="table table-striped table-bordered display nowrap" cellspacing="3" >
            <thead>
            <tr>
                <th>Editar</th>
                <th class="sortTables">Nom<a href="#"><img width="20" height="20" src="./resources/images/sort_both.png"></a></th>
                <th class="sortTables">País<a href="#"><img width="20" height="20" src="./resources/images/sort_both.png"></a></th>
            </tr>
            </thead>
            <tbody id="uniTableBody">
            <?php foreach($universities as $university): ?>
                <tr>
                    <td><a href="" id="<?php echo $university->idUniversitat;?>"><img class="center-block" id="<?php echo $university->idUniversitat;?>" src="./resources/images/editar.png" height="25" width="25"></a></td>
                    <td><?php echo $university->nomUniversitat; ?></td>
                    <td><?php echo $university->nomPais; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

