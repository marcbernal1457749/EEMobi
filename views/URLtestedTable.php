<?php if (!empty($failedURLS)){ ?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col" align="center">Módul</th>
        <th scope="col" align="center">URL Fallida</th>
        <th scope="col" align="center">Ubicació de la URL</th>
    </tr>
    </thead>
    <tbody id="urlTestedTable">
        <?php foreach ($failedURLS as $url): ?>
            <tr>
                <td>
                    <p><?php echo $url['modul']; ?></p>
                </td>
                <td>
                    <p><?php echo $url['url']; ?></p>
                </td>
                <td>
                    <p><?php echo $url['redirect']; ?></p>
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
