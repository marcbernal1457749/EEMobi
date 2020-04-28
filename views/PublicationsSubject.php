<div class="panel panel-default">
    <div class="panel-heading">
        <img onclick="location.reload()" class="click" src="/EEmobi/resources/images/return.png" />
            <h1 class="text-muted text-right"><em><?php echo $nomSubject?></em></h1>
    </div>
<div class="panel-body">
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
                                                echo $publication->nom.' '.$publication->cognom;
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
                <h4>No tens publicacions.</h4>
            </div>
        <?php } ?>
    </div>
    <button  id="myBtn" title="Ves adalt"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
</div>