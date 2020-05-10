<div class="panel panel-default">
    <div class="panel-heading">
        <img onclick="location.reload()" class="click" src="/EEmobi/resources/images/return.png" />
            <h1 class="text-muted text-right"><em><?php echo $nomSubject?></em></h1>
    </div>
<div class="panel-body">
    <div class="publications" id="publicationsInfoUni">
        <h5>Publicacions</h5>
        <?php if(!empty($subjectPublications)){?>
            <?php foreach ($subjectPublications  as $publication): ?>
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
                                                      $data = $publication->dataPublicacio;
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
                                                if($publication->publicMail){?>
                                                    <a href="mailto:<?php echo $publication->correu; ?>" target="_top"><?php echo $publication->nom.' '.$publication->cognom;?></a>
                                                <?php }else{
                                                    echo $publication->nom.' '.$publication->cognom;
                                                }
                                            }else{
                                                echo "Anònim";
                                            }
                                            ?>
                                        </b>
                                    </p>
                                </div>
                            </div>
                            <p><?php echo $publication->opinio; ?> </p>
                            <?php if(!empty($publication->fotoPublicacio)){ ?>
                                <div class="AdaptiveMedia-container">
                                    <img data-aria-label-part="" src="<?php echo $pathPhotos.$publication->fotoPublicacio; ?>" alt="" style="width: auto;top: -0px;height: auto;max-height: 310px;">

                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <div class="col-sm-12 text-center">
                <h4>No hi ha opinions.</h4>
            </div>
        <?php } ?>
    </div>
    <button  id="myBtn" title="Ves adalt"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
</div>