<div class="panel-heading panel-university">
    <input type="hidden" id="uniEstanciaAlumne" value="<?php echo $stay[0]->idUniversitat; ?>" />
    <h5><a href="http://deic-projectes.uab.cat/EEmobi/Universitat/<?php echo $stay[0]->idUniversitat; ?>/Tots-els-graus" target="_blank"><?php echo $stay[0]->nomUniversitat ?></a></h5>
    <p>Curs: <?php echo $stayed == true ? $stay[0]->curs : ''; ?> </p>
</div>
<div class="contingut">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1default" data-toggle="tab">Assignatures</a></li>
        <li><a href="#tab2default" data-toggle="tab">Publicacions</a></li>
        <li><a href="#tab3default" data-toggle="tab">Valoracions</a></li>
    </ul>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active no-info" id="tab1default">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Assignatures Cursades</th>
                            <th>Crèdits</th>
                            <th>Semestre</th>
                            <th><em class="glyphicon glyphicon-check"></em></th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if($hasSubject){
                            foreach($subjects as $subject): ?>
                                <tr >
                                    <td><?php echo $subject->nomAsignaturaDesti; ?></td>
                                    <td><?php echo $subject->creditsAsignaturaDesti; ?></td>
                                    <td><?php echo $subject->semestre; ?></td>
                                    <input type="hidden" id="codiAsignaturaDesti" value="<?php echo $subject->codiAsignaturaDesti; ?>">
                                    <td align="center">
                                        <a href="#" id="opinarsubject" at="<?php echo $subject->codiAcord; ?>">Opinar</a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        }else{ ?>
                            <tr >
                                <td>Cap</td>
                                <td>Cap</td>
                                <td>Cap</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade" id="tab3default">
                <h5>Les teves valoracions:</h5>
                <div id="valoracionesPerfilUser">
                    <?php if(!$hasRatings){?>
                        <input type="hidden" id="stayIdButton" value="<?php echo $stay[0]->codiEstada; ?>" />
                        <input type="hidden" id="uniIdButton" value="<?php echo $stay[0]->idUniversitat; ?>" />
                        <div class="row padding-top-40">
                            <div class="col-md-12 text-center">
                                <button id="firstRatingsButton" class="btn btn-success btn-lg">Comença a Valorar!</button>
                            </div>
                        </div>
                    <?php }else{?>
                        <?php for ($i=1, $size= count($ratings); $i<$size; $i++): ?>
                            <div class="row padding-top-20">
                                <div class="col-lg-3">
                                    <h6><?php echo $categories[$ratings[$i]['idCategoria']]['titolCategoria']; ?></h6>
                                </div>
                                <div class="col-lg-9">
                                    <section class='rating-widget'>
                                        <div class='rating-stars'>
                                            <ul id='stars'>
                                                <li class='star <?php if($ratings[$i]['score'] >= 1){echo "selected";}?>' data-value='1'>
                                                    <input type="hidden" value="<?php echo $ratings[$i]['idValoracio']; ?>" />
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star <?php if($ratings[$i]['score'] >= 2){echo "selected";}?>' data-value='2'>
                                                    <input type="hidden" value="<?php echo $ratings[$i]['idValoracio']; ?>" />
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star <?php if($ratings[$i]['score'] >= 3){echo "selected";}?>' data-value='3'>
                                                    <input type="hidden" value="<?php echo $ratings[$i]['idValoracio']; ?>" />
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star <?php if($ratings[$i]['score'] >= 4){echo "selected";}?>' data-value='4'>
                                                    <input type="hidden" value="<?php echo $ratings[$i]['idValoracio']; ?>" />
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star <?php if($ratings[$i]['score'] >= 5){echo "selected";}?>' data-value='5'>
                                                    <input type="hidden" value="<?php echo $ratings[$i]['idValoracio']; ?>" />
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <?php $iteratorCategories++;
                        endfor;?>
                    <?php }?>
                </div>
            </div>