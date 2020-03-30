<?php if (!empty($urlfallidesUni) || !empty($urlfallidesInt)){ ?>
<h5>Resultats:</h5>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col" align="center">Data</th>
        <th scope="col" align="center">Mòdul</th>
        <th scope="col" align="center">URL Fallida</th>
        <th scope="col" align="center">Ubicació de la URL</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="urlTestedTable">
        <?php foreach ($urlfallidesUni as $url): ?>
            <tr>
                <td>
                    <p><?php echo $url->data; ?></p>

                <td>
                    <p><?php echo $url->modul; ?></p>
                </td>
                <td>
                    <p><?php echo $url->url; ?></p>
                </td>
                <td>
                    <p><?php echo $url->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" onclick="removefailURL(<?php echo $url->idurl; ?>)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($urlfallidesInt as $urlInt): ?>
            <tr>
                <td>
                    <p><?php echo $urlInt->data; ?></p>
                </td>
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
                    <button type="button" class="close" aria-label="Close" onclick="removefailURL(<?php echo $urlInt->idurl; ?>)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }else if (!empty($urlfallidesAssignaturesEXT)){ ?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" align="center">Data</th>
            <th scope="col" align="center">URL Fallida</th>
            <th scope="col" align="center">Ubicació de la URL</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="urlTestedTable">
        <?php foreach ($urlfallidesAssignaturesEXT as $url): ?>
            <tr>
                <td>
                    <p><?php echo $url->data; ?></p>
                </td>
                <td>
                    <p><?php echo $url->url; ?></p>
                </td>
                <td>
                    <p><?php echo $url->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" onclick="removefailURL(<?php echo $url->idurl; ?>)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php }else if (!empty($urlfallidesAssignaturesUAB)){ ?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col" align="center">Data</th>
            <th scope="col" align="center">URL Fallida</th>
            <th scope="col" align="center">Ubicació de la URL</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="urlTestedTable">
        <?php foreach ($urlfallidesAssignaturesUAB as $url): ?>
            <tr>
                <td>
                    <p><?php echo $url->data; ?></p>
                </td>
                <td>
                    <p><?php echo $url->url; ?></p>
                </td>
                <td>
                    <p><?php echo $url->ubicacio; ?></p>
                </td>
                <td>
                    <button type="button" class="close" aria-label="Close" onclick="removefailURL(<?php echo $url->idurl; ?>)">
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
