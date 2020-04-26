<?php include('templates/HeaderInfo.php') ?>
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
</div>
<button  id="myBtn" title="Ves adalt"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
