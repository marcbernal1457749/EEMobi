<?php if (!empty($urlfallidesUni) || !empty($urlfallidesInt)){ ?>
    <?php if (!empty($urlfallidesUni)){ ?>
    <h5>Data: <?php echo $urlfallidesUni[0]->data;?></h5>
    <?php }else{ ?>
    <h5>Data: <?php echo $urlfallidesInt[0]->data;?></h5>
    <?php }?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col" align="center">Mòdul</th>
        <th scope="col" align="center">URL Fallida</th>
        <th scope="col" align="center">Ubicació de la URL</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="urlTestedTable">
        <?php foreach ($urlfallidesUni as $url): ?>
            <tr id="<?php echo $url->idurl; ?>">
                    <p><?php echo $url->modul; ?></p>
                </td>
                <td>
                    <p><?php echo $url->url; ?></p>
                </td>
                <td>
                    <p><?php echo $url->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" id="remURL">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($urlfallidesInt as $urlInt): ?>
            <tr id="<?php echo $urlInt->idurl; ?>">
                <td>
                    <p><?php echo $urlInt->modul; ?></p>
                </td>
                <td>
                    <p><?php echo $urlInt->url; ?></p>
                </td>
                <td>
                    <p><?php echo $urlInt->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" id="remURL">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }else if (!empty($urlfallidesAssignaturesEXT)){ ?>
    <h5>Data: <?php echo $urlfallidesAssignaturesEXT[0]->data;?></h5>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" align="center">URL Fallida</th>
            <th scope="col" align="center">Ubicació de la URL</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="urlTestedTable">
        <?php foreach ($urlfallidesAssignaturesEXT as $url): ?>
            <tr id="<?php echo $url->idurl; ?>">
                <td>
                    <p><?php echo $url->url; ?></p>
                </td>
                <td>
                    <p><?php echo $url->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" id="remURL">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }else if (!empty($urlfallidesAssignaturesUAB)){ ?>
    <h5>Data: <?php echo $urlfallidesAssignaturesUAB[0]->data;?></h5>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" align="center">URL Fallida</th>
            <th scope="col" align="center">Ubicació de la URL</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="urlTestedTable">
        <?php foreach ($urlfallidesAssignaturesUAB as $url): ?>
            <tr id="<?php echo $url->idurl; ?>">
                <td>
                    <p><?php echo $url->url; ?></p>
                </td>
                <td>
                    <p><?php echo $url->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" id="remURL">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else{ ?>

    <div class="row padding-top-20"></div>
    <div class="row">
        <div class="text-center">
            <p>Totes les URLs funcionen correctament!</p>
        </div>
    </div>
    <div class="row padding-bottom-20"></div>
<?php } ?>
