<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" onclick="getUniversitiesBackend()"></span>Universitats</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edita Universitat</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-lg-9">
        <h3>General</h3>
    </div>
    <div class="col-lg-3">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#infoUni" aria-expanded="false" aria-controls="collapseExample">
            Mostra
        </button>
    </div>


    <div class="row">
        <form class="col-sm-12">
            <form>
                <div class="col-sm-12">
                    <div class="col-lg-9">

                    </div>
                    <div id="infoUni" class="collapse">
                        <div class="row">

                            <div class="d-none">
                                <input type="hidden" id="idUni" value="<?php echo $university->idUniversitat; ?>" />
                                <input type="hidden" id="idCountry" value="<?php echo $uniCountry->idPais; ?>" />
                                <input type="hidden" id="foto" value="<?php echo $university->fotoPath; ?>" />
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="Nom" placeholder="Nom de la universitat" value="<?php echo $university->nomUniversitat; ?>">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="country">Pais</label>
                                    <p id="country">
                                        <?php echo $uniCountry->nomPais; ?>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="address">Direcció</label>
                                    <input type="text" class="form-control" id="Adreça" placeholder="Direcció" value="<?php echo $university->adreça; ?>">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="universityUrl">URL Univeristat</label>
                                    <input type="text" class="form-control" id="URLUniversitat" placeholder="URL" value="<?php echo $university->urlUniversitat; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="exchaneUrl">URL Intercanvi</label>
                                    <input type="text" class="form-control" id="URLIntercanvis" placeholder="URL" value="<?php echo $university->urlIntercanvis; ?>">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="univertityCode">Codi Universitat</label>
                                    <input type="text" class="form-control" id="CodiUniversitat" placeholder="Codi" value="<?php echo $university->codiUniversitat; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="univertityLat">Latitud</label>
                                    <input type="text" class="form-control" id="Latitud" placeholder="Latitud" value="<?php echo $university->lat; ?>">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="univertityLong">Longitud</label>
                                    <input type="text" class="form-control" id="Longitud" placeholder="Longitud" value="<?php echo $university->lng; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="univertityLang">Acreditació idioma</label>
                                    <input type="text" class="form-control" id="Acreditacióidioma" placeholder="Acreditació idioma" value="<?php echo $university->acreditacióIdioma; ?>">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="obs">Observacions</label>
                                    <input type="text" class="form-control" id="Observacions" placeholder="Observacions" value="<?php echo $university->observacions; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row float-right">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-success" id="nouphoto">Pujar fotos</button>
                            </div>
                        </div>

                        <div class="row padding-bottom-20">
                            <div class="panel panel-info panel-custom" style="display: none;" id="show">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form method="post" role="form" id="formphoto" action="#">
                                                <label for="file">Foto:</label>
                                                <input type="file" name="file" id="photoFile">
                                                <br>
                                                <input type="reset" class="btn btn-default btn-edit" value="Cancelar">
                                                <input type="submit" id="uploadphoto" class="btn btn-success" value="Pujar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row padding-bottom-40">
                            <div class="col-sm-12 padding-top-20">
                                <button id="updateUniversity" type="submit" class="btn btn-info m-2">Desa Universitat</button>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="float-left">
                        <h3>Convenis</h3>
                    </div>

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
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody id="convenisBodyTable">
                                <?php foreach ($uniConvenis as $conveni): ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" value="<?php echo $conveni->codiConveni;?>">
                                            <p>
                                                <?php echo $conveni->codiConveni;?>
                                            </p>
                                        </td>
                                        <td>
                                            <input type="hidden" value="<?php echo $conveni->codiCentreEstudis;?>" />
                                            <p>
                                                <?php echo $conveni->nomGrau;?>
                                            </p>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="<?php echo $conveni->plaçes;?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="<?php echo $conveni->mesos;?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="<?php echo $conveni->període;?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="<?php echo $conveni->actiu;?>">
                                        </td>
                                        <td>
                                            <select class="form-control" id="coord">
                                                <?php foreach ($allTeachers as $teacher): ?>
                                                    <option id="<?php echo $teacher->niuProfessor;?>" <?php if($teacher->niuProfessor === $conveni->niuProfessor) echo 'selected'; ?>>
                                                        <?php echo $teacher->nom. ' ' .$teacher->cognoms?>
                                                    </option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <td>
                                            <a href=# ><img class="center-block" src="./resources/images/delete.png" height="25" width="25"></a> <!-- TODO: Falta implementar -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#addAgreementModal">
                        Afegeix conveni
                    </button>
                    <button type="button" id="updateConvenis" class="btn btn-info m-2">
                        Desa Convenis
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
                                    <div class="form-group">
                                        <label for="agreementCode">Codi conveni</label>
                                        <input type="text" class="form-control" id="agreementCode" placeholder="Codi conveni">
                                    </div>
                                    <div class="form-group">
                                        <label for="agreementStudies">Estudis</label>
                                        <select class="form-control" id="agreementStudies">
                                            <?php foreach ($allDegrees as $degree): ?>
                                                <option val="<?php echo $degree->nomGrau?>">
                                                    <?php echo $degree->nomGrau?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="agreementPlaces">Places</label>
                                        <input type="text" class="form-control" id="agreementPlaces" placeholder="Places">
                                    </div>
                                    <div class="form-group">
                                        <label for="agreementMonths">Mesos</label>
                                        <input type="text" class="form-control" id="agreementMonths" placeholder="Mesos">
                                    </div>
                                    <div class="form-group">
                                        <label for="agreementPeriod">Periode</label>
                                        <input type="text" class="form-control" id="agreementPeriod" placeholder="Periode">
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
                                            <?php foreach ($allTeachers as $teacher): ?>
                                                <option value="<?php echo $teacher->nom. ' ' .$teacher->cognoms?>">
                                                    <?php echo $teacher->nom. ' ' .$teacher->cognoms?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                                    <button id="addConveni" type="button" class="btn btn-primary" data-dismiss="modal">Guarda</button>
                                </div>
                            </div>
                        </div>
                    </div>


            <hr />
            <h3>Estades</h3>

            <div class="row">

                <div class="col-lg-12">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Estudiant</th>
                            <th>Conveni</th>
                            <th>Curs</th>
                            <th>Semestre</th>
                            <th>Professor</th>
                            <th>Assignatures</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody id="staysBody">
                        <?php foreach ($uniEstades as $estada): ?>
                            <tr>
                                <td>
                                    <input type="hidden" value="<?php echo $estada->codiEstada; ?>">
                                    <input type="hidden" value="<?php echo $estada->nomEst. " " .$estada->cognomEst; ?>">
                                    <p id="nomEstudiantEstada">
                                        <?php echo $estada->nomEst. " " .$estada->cognomEst; ?>
                                    </p>
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $estada->codiConveni; ?>">
                                    <p>
                                        <?php echo $estada->codiConveni; ?>
                                    </p>
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="<?php echo $estada->curs; ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="<?php echo $estada->semestre; ?>">
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $estada->profNom. " " .$estada->profCognom; ?>">
                                    <p>
                                        <?php echo $estada->profNom. " " .$estada->profCognom; ?>
                                    </p>
                                </td>
                                <td>
                                    <a href="" id="<?php echo $estada->codiEstada;?>" ><img class="center-block" id="<?php echo $estada->codiEstada;?>" src="./resources/images/list.png" height="25" width="25"></a>
                                </td>
                                <td>
                                    <a href="" id="<?php echo $estada->codiEstada;?>" ><img class="center-block" id="<?php echo $estada->codiEstada;?>"src="./resources/images/delete.png" height="25" width="25"></a> <!-- TODO: Falta implementar -->
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12 padding-bottom-40">
                    <button type="button" class="btn btn-success m-2" data-toggle="modal"  data-target="#addStayModal">
                        Afegeix Estada
                    </button>
                    <button type="button" class="btn btn-info m-2" id="updateEstades">
                        Desa Estades
                    </button>
                </div>

            </div>

                <div class="modal fade" id="addStayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Afegeix Estada</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="studentStay">Estudiant</label>
                                    <select class="form-control" id="studentStay">
                                        <?php foreach ($allStudents as $student): ?>
                                            <option id="<?php echo $student->niuEstudiant;?>" value="<?php echo $student->nom. " " .$student->cognom;?>">
                                                <?php echo $student->nom. " " .$student->cognom;?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="convenisUni">Conveni</label>
                                    <select class="form-control" id="convenisUni">
                                        <?php foreach ($uniConvenis as $conveni): ?>
                                            <option value="<?php echo $conveni->codiConveni;?>">
                                                <?php echo $conveni->codiConveni;?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cursStay">Curs</label>
                                    <input type="text" class="form-control" id="cursStay" placeholder="Curs">
                                </div>
                                <div class="form-group">
                                    <label for="semestreStay">Semestre</label>
                                    <input type="text" class="form-control" id="semestreStay" placeholder="Semestre">
                                </div>
                                <div class="form-group">
                                    <label for="profesorStay">Professor</label>
                                    <select class="form-control" id="profesorStay">
                                        <?php foreach ($allTeachers as $teacher): ?>
                                            <option id="<?php echo $teacher->niuProfessor;?>" value="<?php echo $teacher->nom. ' ' .$teacher->cognoms?>">
                                                <?php echo $teacher->nom. ' ' .$teacher->cognoms?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                                <button id="addStay" type="button" class="btn btn-primary" data-dismiss="modal">Guarda</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div id="dinamicModal"></div>
            </form>
            <hr />
        </div>
    <div class="col-lg-9">
        <button type="button" id="deleteUniversity" class="btn btn-danger" data-toggle="modal"  data-target="#deleteUniversity">
            Eliminar Universitat
        </button>
        <hr />
    </div>

</div>