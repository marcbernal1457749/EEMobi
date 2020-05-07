<div class="modal fade" id="acordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gestió Assignatures</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="idEstada" value="<?php echo $idEstada; ?>">
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Assig. UAB</th>
                        <th>Assig.</th>
                        <th>Crèdits</th>
                        <th>Codi Assig.</th>
                        <th>Enllaç</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="subjectsModal">
                    <?php foreach ($assignatures as $assignatura): ?>
                        <tr id="<?php echo $assignatura->codiAcord; ?>">
                            <td>
                                <input type="hidden" id="codiAcord" value="<?php echo $assignatura->codiAcord; ?>" />
                                <input type="hidden" id="codiAssignaturaUAB" value="<?php echo $assignatura->codiAssignaturaUAB; ?>" />
                                <input type="hidden" id="nomAssignatura" value="<?php echo $assignatura->nomAssignatura; ?>" />
                                <p>
                                    <?php echo $assignatura->nomAssignatura; ?>
                                </p>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="nomAssExt" value="<?php echo $assignatura->nomAsignaturaDesti; ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="credits" value="<?php echo $assignatura->creditsAsignaturaDesti; ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="codiAssExt" value="<?php echo $assignatura->codiAsignaturaDesti; ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="enllaçAssExt" value="<?php echo $assignatura->linkAssignaturaDesti; ?>">
                            </td>
                            <td>
                                <button id='remAcord' type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button id="addAcordRow" class="btn-default">Afegeix Assignatura</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                <button id="updateAcords" type="button" class="btn btn-primary" data-dismiss="modal">Actualitza Acords</button>
            </div>
        </div>
    </div>
</div>

<div class="hidden" id="newRow">
    <table>
        <tr id="newRowTr">
            <td>
                <select class="form-control" id="newRowAssUAB">
                    <?php foreach ($assignaturasUAB as $assignaturaUAB):?>
                        <option id="<?php echo $assignaturaUAB->codiAssignaturaUAB; ?>">
                            <?php echo $assignaturaUAB->nomAssignatura; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input type="text" class="form-control" id="newRowNomAssExt" placeholder="Assignatura Externa">
            </td>
            <td>
                <input type="text" class="form-control" id="newRowCredits" placeholder="Crèdits Assignatura Externa">
            </td>
            <td>
                <input type="text" class="form-control" id="newRowCodiAssExt" placeholder="Codi Assignatura Externa">
            </td>
            <td>
                <input type="text" class="form-control" id="newRowEnllaçAssExt" placeholder="Enllaç Assignatura Externa">
            </td>
        </tr>
        <tr id="saveNewRow">
            <td colspan="5">
                <a href=""><img class="center-block" src="./resources/images/desar.png" height="25" width="25"></a>
            </td>
        </tr>
    </table>
</div>