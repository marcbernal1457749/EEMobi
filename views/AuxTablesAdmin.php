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


    <div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#countriesAuxTable">Països</a></li>
            <li><a data-toggle="tab" href="#subjectsAuxSelect">Asignatures UAB</a></li>
            <li><a data-toggle="tab" href="#degreesAuxSelect">Graus UAB</a></li>
            <li><a data-toggle="tab" href="#professorsAuxSelect">Professors</a></li>
        </ul>
    </div>

<!-- PAISOS: -->
<div class="tab-content">
    <div id="countriesAuxTable" class="tab-pane fade in active">
        <div class="row bg-secondary padding-bottom-20">
            <div class="col-lg-12">
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


    <!-- ASSIGNATURES UAB: -->
    <div id="subjectsAuxSelect" class="tab-pane fade">
        <div class="row bg-secondary padding-bottom-20">
            <div class="col-lg-12" id="subjectsAuxSelect">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Assignatura</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignaturesUAB as $assignatura): ?>
                        <tr>
                            <td>
                                <input type="text" id="<?php echo $assignatura->codiAssignaturaUAB; ?>" value="<?php echo $assignatura->nomAssignatura; ?>" />
                            </td>
                            <td>
                                <button id='remAssignatura' type='button' class='close' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ASSIGNATURES UAB: -->
    <div id="degreesAuxSelect" class="tab-pane fade">
        <div class="row bg-secondary padding-bottom-20">
            <div class="col-lg-12" id="degreesAuxSelect">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Grau</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($degreesUAB as $degree): ?>
                        <tr>
                            <td>
                                <input type="text" id="<?php echo $degree->codiEstudis; ?>" value="<?php echo $degree->nomGrau; ?>" />
                            </td>
                            <td>
                                <button id='remGrau' type='button' class='close' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PROFESSORS: -->
    <div id="professorsAuxSelect" class="tab-pane fade">
        <div class="row bg-secondary padding-bottom-20">
            <div class="col-lg-12" id="degreesAuxSelect">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Professor</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teachers as $teacher): ?>
                        <tr>
                            <td>
                                <input type="text" id="<?php echo $teacher->niuProfessor; ?>" value="<?php echo $teacher->nom; ?>" />
                            </td>
                            <td>
                                <button id='remGrau' type='button' class='close' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>