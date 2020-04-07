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
                        <th><img id="cargar" src="./resources/images/charge.png" /></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($countries as $country): ?>
                        <tr id="<?php echo $country->idPais; ?>">
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

                <button type="button" id="submitCountriesTable" class="btn btn-default">Actualitzar Taula</button>
                <button type="button" class="btn btn-secondary m-2" data-toggle="modal" data-target="#addPaisModal">Afegeix Entrada</button>

                <form id="formCountry">
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
                                            <input type="text" name="nomPais" class="form-control" id="nomPais" placeholder="Nom país">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementStudies">Programa</label>
                                            <select name="programaPais" class="form-control" id="programaPais">
                                                <?php foreach ($programs as $program): ?>
                                                    <option>
                                                        <?php echo $program->codiPrograma;?>
                                                    </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                                        <button type="submit" name="submit" value="Submit" id="addCountry" class="btn btn-primary">Guarda</button>
                                    </div>

                            </div>
                        </div>
                    </div>
                </form>
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
                        <th><img id="cargar" src="./resources/images/charge.png" /></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignaturesUAB as $assignatura): ?>
                        <tr id="<?php echo $assignatura->codiAssignaturaUAB; ?>">
                            <td>
                                <input type="text" id="<?php echo $assignatura->codiAssignaturaUAB; ?>" value="<?php echo $assignatura->nomAssignatura; ?>" />
                            </td>
                            <td>
                                <button id='remSubject' type='button' class='close' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="submitSubjectsTable" class="btn btn-default">Actualitzar Taula</button>
                <button type="button" class="btn btn-secondary m-2" data-toggle="modal" data-target="#addSubjectModal">Afegeix Entrada</button>

                <form id="formSubjects">
                    <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Afegeix Grau</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="agreementCode">Codi</label>
                                            <input type="text" class="form-control" name="codiSubject" id="codiSubject" placeholder="Codi Assignatura UAB">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Nom</label>
                                            <input type="text" class="form-control" name="nomSubject" id="nomSubject" placeholder="Nom">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Crèdits</label>
                                            <input type="text" class="form-control" name="creditsSubject" id="creditsSubject" placeholder="Crèdits">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">URL</label>
                                            <input type="text" class="form-control" name="urlSubject" id="urlSubject" placeholder="URL">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementStudies">Grau</label>
                                            <select class="form-control" name="codiEstudisSubject" id="codiEstudisSubject">
                                                <?php foreach ($degreesUAB as $degree): ?>
                                                    <option id="<?php echo $degree->codiEstudis?>" val="<?php echo $degree->codiEstudis;?>">
                                                        <?php echo $degree->nomGrau;?>
                                                    </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                                        <button type="submit" name="submit" value="Submit" id="addSubject" class="btn btn-primary">Guarda</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

                                                                                <!-- GRAUS UAB: -->
    <div id="degreesAuxSelect" class="tab-pane fade">
        <div class="row bg-secondary padding-bottom-20">
            <div class="col-lg-12" id="degreesAuxSelect">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Grau</th>
                        <th><img id="cargar" src="./resources/images/charge.png" /></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($degreesUAB as $degree): ?>
                        <tr id="<?php echo $degree->codiEstudis; ?>">
                            <td>
                                <input type="text" id="<?php echo $degree->codiEstudis; ?>" value="<?php echo $degree->nomGrau; ?>" />
                            </td>
                            <td>
                                <button id='remDegree' type='button' class='close' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="submitDegreesTable" class="btn btn-default">Actualitzar Taula</button>
                <button type="button" class="btn btn-secondary m-2" data-toggle="modal" data-target="#addDegreeModal">Afegeix Entrada</button>

                <form id="formDegrees">
                    <div class="modal fade" id="addDegreeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Afegeix Grau</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="agreementCode">Nom</label>
                                            <input type="text" class="form-control" name="nomGrau" id="nomGrau" placeholder="Nom grau">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Cicle</label>
                                            <input type="text" class="form-control" name="cicleGrau" id="cicleGrau" placeholder="Grau">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Descripció</label>
                                            <input type="text" class="form-control" name="descripcioGrau" id="descripcioGrau" placeholder="Descripció">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                                        <button type="submit" name="submit" value="Submit" id="addDegree" class="btn btn-primary">Guarda</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                        <th><img id="cargar" src="./resources/images/charge.png" /></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teachers as $teacher): ?>
                        <tr id="<?php echo $teacher->niuProfessor; ?>">
                            <td>
                                <input type="text" id="<?php echo $teacher->niuProfessor; ?>" value="<?php echo $teacher->nom; ?>" />
                            </td>
                            <td>
                                <button id='remTeacher' type='button' class='close' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="submitTeachersTable" class="btn btn-default">Actualitzar Taula</button>
                <button type="button" class="btn btn-secondary m-2" data-toggle="modal" data-target="#addTeacherModal">Afegeix Entrada</button>

                <form id="formTeachers">
                    <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Afegeix Professor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="agreementCode">Niu</label>
                                            <input type="text" class="form-control" name="niu" id="niu" placeholder="Niu">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Nom</label>
                                            <input type="text" class="form-control" name="nomProfessor" id="nomProfessor" placeholder="Nom">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Cognoms</label>
                                            <input type="text" class="form-control" name="cognomsProfessor" id="cognomsProfessor" placeholder="Cognoms">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementCode">Correu</label>
                                            <input type="text" class="form-control" name="correuProfessor" id="correuProfessor" placeholder="Correu">
                                        </div>
                                        <div class="form-group">
                                            <label for="agreementStudies">Grau</label>
                                            <select class="form-control" name="codiEstudisProfessor" id="codiEstudisProfessor">
                                                <?php foreach ($degreesUAB as $degree): ?>
                                                    <option id="<?php echo $degree->codiEstudis?>" val="<?php echo $degree->codiEstudis;?>">
                                                        <?php echo $degree->nomGrau;?>
                                                    </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                                        <button type="submit" name="submit" value="Submit" id="addTeacher" class="btn btn-primary">Guarda</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>