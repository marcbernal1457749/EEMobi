<table class="table table-hover cell-border display compact" id="dev-table">
    <thead>
    <tr>
        <th>Universitat</th>
        <!-- <th>Grau</th>-->
        <th>Places</th>
        <th>Mesos</th>
        <th>Període</th>
        <th>Assignatures</th>
        <th><em class="fa fa-cog"></em></th>

    </tr>
    </thead>
    <tbody id="taulaAcordsCoordinador">
    <?php foreach ($agree as $ag): ?>
        <tr >
            <td><?php echo $ag->nomUniversitat; ?></td>
            <!--<td><?php echo $ag->nomGrau; ?></td>-->
            <td><?php echo $ag->plaçes; ?></td>
            <td><?php echo $ag->mesos; ?></td>
            <td><?php echo $ag->període; ?></td>
            <td align="center">
                <a href="#" id="assignaturesp" at="<?php echo $ag->codiConveni; ?>">Opinar</a>
            </td>
            <td align="center">
                <a href="#" id="publicarp" at="<?php echo $ag->idUniversitat; ?>">Publicar</a> / <a href="#" id="acordp" at="<?php echo $ag->codiConveni; ?>">Acord</a>
            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

    </div>
</div>
<div id="debug">

</div>