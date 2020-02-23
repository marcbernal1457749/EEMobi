<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" onclick="otherActionsBackend()"></span>Altres Accions</a></li>
                    <li class="breadcrumb-item active">Administrar Taules Auxiliars</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="row bg-info padding-bottom-20">
            <div class="col-lg-6 bg-info">
                <label for="sel1">Taula:</label>
                <select class="form-control" data-live-search="true" data-size="5" id="selectDegree" >
                    <option id="countriesAuxSelect">Països</option>
                    <option id="subjectsAuxSelect">Assignatures UAB</option>
                    <option id="degreesAuxSelect">Graus UAB</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row bg-secondary padding-bottom-20">
        <div class="col-lg-12" id="countriesAuxTable">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>País</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($countries as $country): ?>
                    <tr>
                        <td>
                            <input type="text" id="<?php echo $country->idPais; ?>" value="<?php echo $country->nomPais; ?>" />
                        </td>
                        <td>
                            <button id='remCountry' type='button' class='close' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="modal fade" id="addPaisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Afegeix País</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="agreementCode">Nom</label>
                                <input type="text" class="form-control" id="nomPais" placeholder="Nom país">
                            </div>
                            <div class="form-group">
                                <label for="agreementStudies">Programa</label>
                                <select class="form-control" id="programaPais">
                                    <?php foreach ($programs as $program): ?>
                                        <option id="<?php echo $program->codiPrograma?>" val="<?php echo $program->nom;?>">
                                            <?php echo $program->nom;?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                            <button id="addCountry" type="button" class="btn btn-primary" data-dismiss="modal">Guarda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>