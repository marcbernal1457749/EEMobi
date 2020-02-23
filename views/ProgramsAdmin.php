<input type="text" name="student" style="display: none;" value="program" class="type">
<div class="panel-heading">
  <div class="row">
    <div class="col col-xs-6">
      <h3 class="panel-title">Programes</h3>
    </div>
  </div>
</div>
<div class="panel-body">
  <div class="table-responsive">
  <table  id="tableMO" class="table table-striped table-bordered display nowrap" cellspacing="10" >
      <thead>
        <tr>
          <th>Codi</th>
          <th>Nom</th>
          <th>Descripció</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($programs as $program): ?>
        <tr>
          <td><?php echo $program->codiPrograma; ?></td>
          <td><?php echo $program->nom; ?></td>
          <td><?php echo $program->descripció; ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>