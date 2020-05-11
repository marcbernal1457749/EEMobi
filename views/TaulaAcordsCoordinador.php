<?php foreach ($agree as $ag): ?>
    <tr >
        <td><?php echo $ag->nomUniversitat; ?></td>
        <td><?php echo $ag->nomGrau; ?></td>
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