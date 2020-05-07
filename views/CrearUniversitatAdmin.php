<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" onclick="getUniversitiesBackend()" class="UV"></span>Universitats</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nova Universitat</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <form>
                <div class="col-lg-4">
                    <h3>General</h3>
                </div>
                <div class="col-lg-8">
                    <h6><b>Indicacions</b>: Per buscar la longitud i latitud: <a href="https://www.coordenadas-gps.com/">https://www.coordenadas-gps.com/</a></h6>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="name">Nom*</label>
                            <input type="text" class="form-control" id="Nom"
                                   placeholder="Nom de la universitat" required>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="country">Pais*</label>
                            <select class="form-control" id="País">
                                <?php foreach ($countries as $country):?>
                                    <option id="<?php echo $country->idPais?>"><?php echo $country->nomPais?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="address">Direcció*</label>
                            <input type="text" class="form-control" id="Adreça"
                                   placeholder="Direcció" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="universityUrl">URL Univeristat</label>
                            <input type="text" class="form-control" id="URLUniversitat"
                                   placeholder="URL">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="exchaneUrl">URL Intercanvi</label>
                            <input type="text" class="form-control" id="URLIntercanvis"
                                   placeholder="URL">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="univertityCode">Codi Universitat*</label>
                            <input type="text" class="form-control" id="CodiUniversitat"
                                   placeholder="Codi" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="univertityLat">Latitud*</label>
                            <input type="text" class="form-control" id="Latitud"
                                   placeholder="Latitud" required>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="univertityLong">Longitud*</label>
                            <input type="text" class="form-control" id="Longitud"
                                   placeholder="Longitud" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="univertityLang">Acreditació idioma</label>
                            <input type="text" class="form-control" id="Acreditacióidioma"
                                   placeholder="Acreditació idioma">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="obs">Observacions</label>
                            <input type="text" class="form-control" id="Observacions"
                                   placeholder="Observacions">
                        </div>
                    </div>
                </div>


                <h3>Convenis</h3>

                <div class="row">

                    <div class="col-lg-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Codi</th>
                                <th>Grau</th>
                                <th>Places</th>
                                <th>Mesos</th>
                                <th>Període</th>
                                <th>Actiu</th>
                                <th>Coordinador</th>
                            </tr>
                            </thead>
                            <tbody id="agreements">

                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-default m-2" data-toggle="modal" data-target="#addAgreementModal">
                    Afegeix conveni
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addAgreementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Afegeix Conveni</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--FORMULARIO DE AÑADIR CONVENIO-->
                                <div class="form-group">
                                    <label for="agreementCode">Codi conveni</label>
                                    <input type="text" class="form-control" id="agreementCode"
                                           placeholder="Codi conveni">
                                </div>
                                <div class="form-group">
                                    <label for="agreementStudies">Estudis</label>
                                    <select class="form-control" id="agreementStudies">
                                        <?php foreach ($degrees as $degree):?>
                                            <option id="<?php echo $degree->codiEstudis?>"><?php echo $degree->nomGrau ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agreementPlaces">Places</label>
                                    <input type="text" class="form-control" id="agreementPlaces"
                                           placeholder="Places">
                                </div>
                                <div class="form-group">
                                    <label for="agreementMonths">Mesos</label>
                                    <input type="text" class="form-control" id="agreementMonths"
                                           placeholder="Mesos">
                                </div>
                                <div class="form-group">
                                    <label for="agreementPeriod">Periode</label>
                                    <input type="text" class="form-control" id="agreementPeriod"
                                           placeholder="Periode">
                                </div>
                                <div class="form-group">
                                    <label for="agreementActive">Actiu</label>
                                    <select class="form-control" id="agreementActive">
                                        <option>Si</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agreementCoordinator">Coordinador</label>
                                    <select class="form-control" id="agreementCoordinator">
                                        <?php foreach ($teachers as $teacher):?>
                                            <option id="<?php echo $teacher->niuProfessor?>"><?php echo $teacher->nom ?> <?php echo $teacher->cognoms ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tanca</button>
                                <button id="addAgreementBox" type="button" class="btn btn-primary" data-dismiss="modal" >Guarda</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12 padding-top-20 padding-bottom-20">
                        <hr />
                        <button id="desaUniversitatConvenis" type="submit" class="btn btn-secundary m-2">Desa Universitat</button>
                    </div>
                </div>
            </form>
        </div>

    </div>


</div>