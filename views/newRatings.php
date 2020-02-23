<?php foreach ($ratings as $rating): ?>
    <div class="row padding-top-20">
        <div class="col-lg-3">
            <h6><?php echo $categories[$iteratorCategories]['titolCategoria']; ?></h6>
        </div>
        <div class="col-lg-9">
            <section class='rating-widget'>
                <div class='rating-stars'>
                    <ul id='stars'>
                        <li class='star <?php if($rating['score'] == 1){echo "selected";}?>' data-value='1'>
                            <input type="hidden" value="<?php echo $rating['idValoracio']; ?>" />
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star <?php if($rating['score'] == 2){echo "selected";}?>' data-value='2'>
                            <input type="hidden" value="<?php echo $rating['idValoracio']; ?>" />
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star <?php if($rating['score'] == 3){echo "selected";}?>' data-value='3'>
                            <input type="hidden" value="<?php echo $rating['idValoracio']; ?>" />
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star <?php if($rating['score'] == 4){echo "selected";}?>' data-value='4'>
                            <input type="hidden" value="<?php echo $rating['idValoracio']; ?>" />
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star <?php if($rating['score'] == 5){echo "selected";}?>' data-value='5'>
                            <input type="hidden" value="<?php echo $rating['idValoracio']; ?>" />
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
<?php $iteratorCategories++;
        endforeach;?>
