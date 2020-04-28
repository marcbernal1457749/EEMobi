
<?php include('templates/HeaderInfo.php') ?>
<div class="container">
    <div class="container-publiSub">
    <input type="hidden" id="idUni" value="<?php echo $university->idUniversitat; ?>">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab0default" data-toggle="tab">Informació general</a></li>
                        <li><a href="#tab1default" data-toggle="tab">Assignatures</a></li>
                        <li><a href="#tab2default" data-toggle="tab">Publicacions</a></li>
                    </ul>
                    <p class="text-muted text-right"><em><?php echo $university->nomUniversitat;?></em></p>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab0default">
                            <div class="col-sm-5" >
                                <h1 class="mt-4 uni" at="<?php echo $university->idUniversitat; ?>"><?php echo $university->nomUniversitat; ?></h1>
                                <hr>
                                <p><?php echo $university->adreça; ?></p>
                                <hr>
                                <img class="img-fluid rounded" src="<?php echo $path; ?>" alt="">
                                <hr>
                            </div>
                            <div class="col-sm-4">
                                <div class="card my-4">
                                    <h6 class="card-header lead">Enllaços d'interès</h6>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <a href="<?php echo $university->urlUniversitat; ?>">Pàgina principal </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6">
                                                <ul class="list-unstyled mb-0">
                                                    <li>
                                                        <a href="<?php echo $university->urlIntercanvis; ?>">Pàgina d'intercanvis</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card my-4">
                                    <h6 class="card-header lead">Observacions</h6>
                                    <div class="card-body">
                                        <?php echo $university->observacions; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="card my-4">
                                    <h6 class="card-header lead">Acreditació Idioma</h6>
                                    <div class="card-body">
                                        <?php echo $university->acreditacióIdioma; ?>
                                    </div>
                                </div>
                                <br>
                                <div class="card my-4">
                                    <?php if($degreeSelected){ ?>

                                        <h6 class="card-header lead">Coordinador(s) responsable(s)</h6>

                                        <?php
                                        foreach ($teacher as $te) {

                                            if(!empty($te->correuProfessor)){ ?>
                                                <p><a href="mailto:<?php echo $te->correuProfessor ;  ?>" target="_top"><?php echo $te->nom.' '.$te->cognoms ;  ?></a></p>
                                            <?php }else{ ?>
                                                <p><?php echo $te->nom.' '.$te->cognoms ;  ?></p>
                                            <?php }
                                        } ?>
                                        <div class="card-body">
                                            <h6 class="card-header lead">Grau: <?php echo $degreeName;  ?></h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Places</th>
                                                        <th>Mesos</th>
                                                        <th>Període</th>
                                                        <th>Actiu</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($infoCenter as $centre): ?>
                                                        <tr >
                                                            <td><?php echo $centre->plaçes;  ?></td>
                                                            <td><?php echo $centre->mesos;  ?></td>
                                                            <td><?php echo $centre->període; ?></td>
                                                            <td><?php echo $centre->actiu == true ? 'Sí':'No'; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php }else{?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Coordinador/a</th>
                                                    <th>Grau</th>
                                                    <th><img alt="info" id="info" src="/EEmobi/resources/images/info.png"/></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($teacher as $te): ?>
                                                    <tr >
                                                        <?php  if(!empty($te->correuProfessor)){ ?>
                                                            <td><a href="mailto:<?php echo $te->correuProfessor ;  ?>" target="_top"><?php echo $te->nom.' '.$te->cognoms ;  ?></a></td>
                                                        <?php }else{ ?>
                                                            <td><?php echo $te->nom.' '.$te->cognoms ;  ?></td>
                                                        <?php } ?>
                                                        <td><?php echo $te->nomGrau;  ?></td>

                                                        <?php $grau = $te->nomGrau;
                                                        $grau = str_replace(" ", "-", $grau);?>
                                                        <!-- degree=/EEmobi/-->

                                                        <td><a href="./<?php echo $grau?>"><img alt="info" class="click" src="/EEmobi/resources/images/click.png"/></a></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card my-4">
                                    <h6 class="card-header lead"> </h6>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <section class='rating-widget'>
                                                <div class='rating-stars'>
                                                    <ul>
                                                        <?php if($areRatings){ ?>
                                                            <li class='star <?php if($valorations['General'] >= 1){echo "selected";}?>' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if($valorations['General'] >= 2){echo "selected";}?>' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if($valorations['General'] >= 3){echo "selected";}?>' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if($valorations['General'] >= 4){echo "selected";}?>' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if($valorations['General'] >= 5){echo "selected";}?>' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        <?php }else{?>
                                                            <li class='star' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <p class="small text-center"><strong>Número de valoracions:</strong> <?php echo $totalValorations; ?></p>
                                </div>
                                <hr />
                                <?php
                                if ($areRatings){
                                    unset($valorations['General']);
                                    foreach ($valorations as $category => $score): ?>
                                        <div class="row">
                                            <div class="col-lg-12 text-center padding-bottom-0">
                                                <h6><?php echo $category ?></h6>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <section class='rating-widget'>
                                                    <div class='rating-stars'>
                                                        <ul>
                                                            <li class='star <?php if ($score >= 1) {
                                                                echo "selected";
                                                            } ?>' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if ($score >= 2) {
                                                                echo "selected";
                                                            } ?>' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if ($score >= 3) {
                                                                echo "selected";
                                                            } ?>' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if ($score >= 4) {
                                                                echo "selected";
                                                            } ?>' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star <?php if ($score >= 5) {
                                                                echo "selected";
                                                            } ?>' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                }else{
                                    for ($i=1, $size = count($categories); $i < $size; $i++): ?>
                                        <div class="row">
                                            <div class="col-lg-12 text-center padding-bottom-0">
                                                <h6><?php echo $categories[$i]['titolCategoria'] ?></h6>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <section class='rating-widget'>
                                                    <div class='rating-stars'>
                                                        <ul>
                                                            <li class='star' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <?php
                                    endfor;}
                                ?>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab1default">
                            <div class="panel panel-default">
                                <div class="panel-heading panel-heading-custom">

                                    <div class="pull-right">
											<span class="clickable filter" data-toggle="tooltip" title="Filtrar" data-container="body">
												<i class="fa fa-search"></i>
											</span>
                                    </div>
                                </div>
                                <div class="panel-body panel-custome">
                                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Busca" />
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover cell-border" id="dev-table">
                                        <thead>
                                        <tr>
                                            <th>Assignatura UAB</th>
                                            <th>Crèdits UAB</th>
                                            <th>Assignatures destí</th>
                                            <th>Crèdits</th>
                                            <th>Grau</th>
                                            <th>Curs</th>
                                            <th>Estudiant</th>
                                            <th>Opinions</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!$noInfo){
                                            foreach($info as $inf): ?>
                                                <tr>
                                                    <td><?php
                                                        if(empty($inf->url)){
                                                            echo $inf->nomAssignatura;
                                                        }else{?>
                                                            <a href="<?php echo $inf->url; ?>" target="_blank"><?php echo $inf->nomAssignatura; ?> </a>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td><?php echo $inf->crèdits; ?></td>
                                                    <td><?php
                                                        if(empty($inf->linkAssignaturaDesti)){
                                                            echo $inf->nomAsignaturaDesti;
                                                        }else{?>
                                                            <a href="<?php echo $inf->linkAssignaturaDesti; ?>" target="_blank"><?php echo $inf->nomAsignaturaDesti; ?> </a>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td><?php echo $inf->creditsAsignaturaDesti; ?></td>
                                                    <td><?php echo $inf->nomGrau; ?></td>
                                                    <td><?php echo $inf->curs; ?></td>
                                                    <td><?php
                                                        if($inf->publicMail){ ?>
                                                            <a href="mailto:<?php echo $inf->correu; ?>" target="_top"><?php echo $inf->niuEstudiant; ?> </a>

                                                            <?php
                                                        }else{
                                                            echo $inf->niuEstudiant;
                                                        }
                                                        ?>

                                                    </td>
                                                    <td align="center" valign="middle">
                                                        <img onclick="getSubjectPublication(this)" id="<?php echo $inf->nomAsignaturaDesti . ',' . $inf->codiAsignaturaDesti; ?>" class="click" src="/EEmobi/resources/images/click.png"/>
                                                    </td>
                                                </tr>
                                            <?php endforeach; }else{ ?>
                                            <tr>

                                                <td colspan="8"><h3 class="text-center"> No hi ha informació disponible</h3></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="tab-pane fade" id="tab2default">

                            <form>
                                <h4 class="form-signin-heading">Filtres</h4>
                                <div class="form-group">
                                    <label for="sel1">Data</label>
                                    <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectFilter" >
                                        <option value="1">Data (Ascendent)</option>
                                        <option value="2">Data (Descendent)</option>
                                    </select>
                                </div>
                            </form>

                            <label for="sel1">Categoría</label>
                            <select class="selectpicker form-control" id="selectFilterCategory">
                                <option value="-1">Totes</option>
                                <?php foreach ($categories as $category):?>
                                    <option value="<?php echo $category['idCategoria']; ?>"><?php echo $category['titolCategoria']; ?></option>
                                <?php endforeach;?>
                            </select>

                            <div class="publications" id="publicationsInfoUni">
                                <h5>Publicacions</h5>
                                <?php foreach ($publications  as $publication): ?>
                                    <div class="item">
                                        <div class="image">
                                            <div>
                                                <?php if($publication->publicNom){ ?>
                                                    <img src="<?php if(!empty($publication->foto)){ echo $pathPhotoProfile.$publication->foto; }else{ echo "\EEmobi\\resources\\img\profile.png"; }; ?>" />
                                                <?php }else{ ?>
                                                    <img src="\EEmobi\\resources\\img\profile.png" />
                                                <?php } ?>
                                                <span>
			                                  <?php
                                              $data = $publication->dataPublicació;
                                              $data = str_replace("-", ".", $data);
                                              echo $data; ?>
			                                  </span>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <p>
                                                            <b><?php if($publication->publicNom){
                                                                    echo $publication->nom.' '.$publication->cognom;
                                                                }else{
                                                                    echo "Anònim";
                                                                }
                                                                ?>
                                                            </b>
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <p class="text-right text-info"><em><?php echo $categories[$publication->idCategoria]['titolCategoria']; ?></em></p>
                                                    </div>
                                                </div>
                                                <p><?php echo $publication->opinió; ?> </p>
                                                <?php if(!empty($publication->fotoPublicació)){ ?>
                                                    <div class="AdaptiveMedia-container">
                                                        <img data-aria-label-part="" src="<?php echo $pathPhotos.$publication->fotoPublicació; ?>" alt="" style="width: auto;top: -0px;height: auto;max-height: 310px;">

                                                    </div>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button  id="myBtn" title="Ves adalt"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
