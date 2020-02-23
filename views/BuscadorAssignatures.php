<?php
if($logged){
    include('templates/HeaderInfo.php');
    ?>
    <script src="resources/js/eventListener.js"></script>
    <script src="resources/js/functions.js"></script>
<?php
}else{
    include('templates/Header.php');
}?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Buscador d'assignatures</h1>
                </div>

                <div class="panel-body">
                    <h4>Cerca:</h4>
                    <div class="col-sm-7">
                        <div class="row bg-info padding-bottom-20 ">
                            <div class="col-lg-6">
                                <div id="degreesBuscador">
                                    <label for="sel1">Grau:</label>
                                    <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectSubjectsDegree" >
                                        <option value="-1">Selecciona un grau </option>
                                        <?php foreach($degrees as $degree): ?>
                                            <option value="<?php echo $degree->codiEstudis; ?>"><?php echo $degree->nomGrau; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div id="subjectsBuscador">
                                    <label for="sel1">Assignatures:</label>
                                    <select class="selectpicker form-control" id="subjectSelector" >
                                        <option value="-1">Selecciona una assignatura </option>
                                        <?php foreach($assignatures as $assignatura): ?>
                                            <option value="<?php echo $assignatura->codiAssignaturaUAB; ?>"><?php echo $assignatura->nomAssignatura; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <br />
                            <input type="button" class="btn btn-info" value="Afegeix Assignatura" id="addSubject" />
                        </div>

                    </div>


                    <div class="col-sm-5">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Assignatures UAB que es volen cercar</th>
                            </tr>
                            </thead>
                            <tbody id="subjectBodyTable">
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 padding-bottom-20">
                        <hr>
                        <div class="col-lg-3 margin-top-20">
                            <input type="button" class="btn btn-success" value="Cercar Destinacions" id="searchDestinationBySubjects"/>
                        </div>

                        <div class="col-lg-2">
                            <label for="sel1">Tipus de Cerca:</label>
                            <select class="selectpicker form-control" id="logicOperator" >
                                <option value="0">And</option>
                                <option value="1">Or</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="sel1">Programes:</label>
                            <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectDegreesProgram" >
                                <option value="-1">Selecciona un programa </option>
                                <?php foreach($programs as $program): ?>
                                    <option value="<?php echo $program->codiPrograma; ?>"><?php echo $program->nom; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 padding-top-20" id="destinationsTable"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>
