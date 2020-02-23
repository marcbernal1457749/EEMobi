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
                  <p><b><?php if($publication->publicNom){
                        echo $publication->nom.' '.$publication->cognom;
                  }else{
                     echo "Anònim";
                  }
                  ?></b></p>
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