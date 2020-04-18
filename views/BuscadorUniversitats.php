<?php
if($logged){
    include('templates/HeaderInfo.php');
}else{
    include('templates/Header.php');
}?>

<div class="searcherbackground">
    <div class="container">
        <br/>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <br/>
                        <h3 class="titulo">Troba la teva destinació!</h3>
                    </div>

                    <div class="panel-body">
                        <h4>Cerca:</h4>
                        <div class="form-group has-feedback has-search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            <input id="searcherUni" type="text" class="form-control" placeholder="Cercar universitat...">
                        </div>
                        <small id="advancedOptions">Opcions avançades</small>

                        <div class="col-sm-12"  id="advancedOptionsShow" >
                            <div id="degreesBuscador">
                                <br/>
                                <label for="sel1">Grau:</label>
                                <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectSubjectsDegree" >
                                    <option value="-1">Selecciona un grau </option>
                                    <?php foreach($degrees as $degree): ?>
                                        <option value="<?php echo $degree->codiEstudis; ?>"><?php echo $degree->nomGrau; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id="countryBuscador">
                                <br/>
                                <label for="sel1">País:</label>
                                <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectSubjectsCountry" >
                                    <option value="-1">Selecciona un país </option>
                                    <?php foreach($countries as $country): ?>
                                        <option value="<?php echo $country->idPais; ?>"><?php echo $country->nomPais; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <input type="button" class="btn btn-default" value="Cercar Destinacions" id="searchDestinationAdvanced"/>
                        </div>
                        <div class="col-sm-12 padding-top-20" id="resultsTable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
