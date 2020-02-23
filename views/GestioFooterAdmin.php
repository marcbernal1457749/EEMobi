<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" onclick="otherActionsBackend()"></span>Altres Accions</a></li>
                    <li class="breadcrumb-item active">GestioFooterAdmin</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row padding-bottom-20">
        <div class="col-sm-8">
            <table class="table" id="sectionsTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <p class="text-muted">Seccions</p>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="sectionsBodyTable">
                    <?php foreach ($footerInfo as $footerSection): ?>
                        <tr>
                            <td>
                                <input id="<?php echo $footerSection['footerId']; ?>" value="<?php echo $footerSection['titolSeccio']; ?>" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button id="submitSections" class="btn btn-info">Actualitzar Seccions</button>
        </div>
    </div>

    <hr />
    <div class="row padding-bottom-20">
        <div class="col-sm-8">
            <table class="table" id="subSectionsTable">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="4">
                        <p class="text-muted">Apartats de Secció</p>
                    </th>
                </tr>
                <tr>
                    <th scope="col">Secció</th>
                    <th scope="col">Títol</th>
                    <th scope="col">URL</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="subSectionsBodyTable">
                <?php foreach ($footerSubSections as $footerSubSection): ?>
                    <tr id="<?php echo $footerSubSection['idApartat']; ?>">
                        <td>
                            <p><?php echo $footerInfo[$footerSubSection['idSeccio']-1]['titolSeccio']; ?></p>
                        </td>
                        <td>
                            <input size="25" type="text" value="<?php echo $footerSubSection['titolApartat'] ?>" />
                        </td>
                        <td>
                            <input size="45" type="text" value="<?php echo $footerSubSection['urlApartat'] ?>" />
                        </td>
                        <td>
                            <button id='remSubSection' type='button' class='close' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row padding-bottom-20">
        <div class="col-sm-3">
            <button type="button" id="submitSubSections" class="btn btn-info">Actualitzar Apartats</button>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#addSubSectionModal">Afegeix Apartat</button>
        </div>

        <div class="modal fade" id="addSubSectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Afegeix Apartat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="dataSubSection">
                        <div class="form-group">
                            <label for="modalSection">Secció</label>
                            <select class="form-control" id="modalSection">
                                <?php foreach ($footerInfo as $section):?>
                                    <option id="<?php echo $section['footerId']?>"><?php echo $section['titolSeccio'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modalTitleSubSection">Títol</label>
                            <input type="text" class="form-control" id="modalTitleSubSection"
                                   placeholder="Títol">
                        </div>
                        <div class="form-group">
                            <label for="modalUrl">URL</label>
                            <input type="text" class="form-control" id="modalUrl"
                                   placeholder="URL">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Tanca</button>
                        <button id="addSubSectionButton" type="button" class="btn btn-primary" data-dismiss="modal" >Guarda</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>