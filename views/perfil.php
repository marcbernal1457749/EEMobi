 <?php include('templates/HeaderProfile.php') ?>
 <div class="container">
	<div class="row">
    	<div class="col-sm-4">
        	<div class="panel panel-default">
            	<div class="panel-body">
                    <div class="col col_4 iamgurdeep-pic">
                        <img class="img-responsive img-profile" alt="imgProfile" src="<?php echo $path; ?>">
                        <div class="username">
                            <h2> <?php echo $nomComplet; ?> <small><i class="fa fa-map-marker"></i>Catalunya (Bellaterra)</small></h2>
                            <p><i class="fa fa-briefcase"></i> <?php echo $type; ?></p>
                            
                            <a href="#" class="btn-o"> <i class="fa fa-pencil-square-o"></i>Editar Perfil </a>                       
                        </div>                    
                    </div>                                 
                    <ul class="list">
                        <li class="list-group-item"><i class="fa fa-university" aria-hidden="true"></i> Niu: <?php echo $niu; ?></li>
                        <li class="list-group-item"><i class="fa fa-envelope-o" aria-hidden="true"></i> Correu: <?php echo $correu; ?></li>
                        <li class="list-group-item">Nom públic: <?php echo $nomPublic; ?></li>
                        <li class="list-group-item">Correu públic: <?php echo $correuPublic; ?></li>
                    </ul>                
            	</div>
        	</div>
    	</div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div  class="modal-dialog">

            </div>
        </div>
    	<div class="col-sm-8">
    		<div class="panel with-nav-tabs panel-default">
        <?php
        /*EL PROBLEMA ESTÁ EN QUE ESTAYED ESTA COMO FALSE*/
        if($isTeacher){
          require_once 'views/PerfilProfessor.php';  
        }else if($stayed){
          require_once 'views/PerfilUsuari.php';
        }else{?>
                                <div class="col-sm-12 text-center">
                                   <h4><?php echo $contentStay; ?></h4>
                               </div>
                                <?php } ?>

                            <!-- Trigger the modal with a button -->
                          <div class="tab-pane fade" id="tab2default">
                          <h5>Les teves publicacions:</h5>


                          <?php if($hasPublications || $hasPublicationsSubject){ ?>
                              <?php if($hasPublications){?>
                              <?php foreach ($publications  as $publication): ?>
                              <div class="item">
                                <div class="image">
                                  <div>
                                  <?php if($publication->publicNom){ ?>
                                    <img src="<?php echo $path; ?>" />
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

                                      <button type="button" class="close" aria-label="Close" at="<?php echo $publication->idPublicació; ?>">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                      <h1 class="custom-h1"><?php echo  $publication->nomUniversitat; ?></h1>
                                      <div class="row">
                                          <div class="col-lg-8">
                                              <p><b><?php if($publication->publicNom){
                                                          echo $publication->nom.' '.$publication->cognom;
                                                      }else{
                                                          echo "Anònim";
                                                      }
                                                      ?></b></p>
                                          </div>
                                          <div class="col-lg-4 text-right">
                                              <p class="text-right text-info"><em>Universitat</em></p>
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
                          <?php } if ($hasPublicationsSubject){ ?>
                              <?php foreach ($publicationSubject  as $publication): ?>
                                  <div class="item">
                                      <div class="image">
                                          <div>
                                              <?php if($publication->publicNom){ ?>
                                                  <img src="<?php echo $path; ?>" />
                                              <?php }else{ ?>
                                                  <img src="\EEmobi\\resources\\img\profile.png" />
                                              <?php } ?>
                                              <span>
                                <?php
                                $data = $publication->dataPublicacio;
                                $data = str_replace("-", ".", $data);
                                echo $data; ?>
                                </span>
                                          </div>
                                      </div>
                                      <div class="details">
                                          <div>
                                              <button type="button" class="close" aria-label="Close" at="<?php echo $publication->idPublicacio; ?>">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              <h1 class="custom-h1"><?php echo  $publication->nomAsignaturaDesti; ?></h1>
                                              <div class="row">
                                                  <div class="col-lg-8">
                                                      <p><b><?php if($publication->publicNom){
                                                                  echo $publication->nom.' '.$publication->cognom;
                                                              }else{
                                                                  echo "Anònim";
                                                              }
                                                              ?></b></p>
                                                  </div>
                                                  <div class="col-lg-4 text-right">
                                                      <p class="text-right text-info"><em>Assignatura</em></p>
                                                  </div>
                                              </div>
                                              <p><?php echo $publication->opinio; ?> </p>
                                          </div>
                                      </div>
                                  </div>
                              <?php endforeach; }?>
                          <?php }else{?>
                              <div class="col-sm-12 text-center">
                                  <h4>No tens publicacions.</h4>
                              </div>
                          <?php } ?>
                          <?php if(!isset($_SESSION['teacher'])){ ?>
                          <div id="container-floating">
                            <div id="floating-button" data-toggle="modal" data-placement="left" data-original-title="Create" data-target="#myModal">
                              <p class="plus">+</p>
                              <img class="edit" src="https://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
                            </div>
                          </div>
                          <button  id="myBtn" title="Ves adalt"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                          <?php } ?>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
	</div>
</div>
</body>
