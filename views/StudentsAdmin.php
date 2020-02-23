<input type="text" name="student" style="display: none;" value="student" class="type">
<div class="panel-heading">
  <div class="row">
    <div class="col col-xs-6">
      <h3 class="panel-title">Estudiants</h3>
    </div>
  </div>
</div>
<div class="panel-body">
<table  id="tableES" class="table table-striped table-bordered display nowrap" cellspacing="10" >
    <thead>
      <tr>
        <th>Més</th>
        <th>Niu</th>
        <th>Nom</th>
        <th>Cognom</th>
        <th>Correu</th>
        <th>Nom públic</th>
        <th>Correu públic</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($students as $student): ?>
      <tr>
        <td>.</td>
        <td><?php echo $student->niuEstudiant; ?></td>
        <td><?php echo $student->nom; ?></td>
        <td><?php echo $student->cognom; ?></td>
        <td><?php echo $student->correu; ?></td>
        <td><?php if($student->publicNom){ echo "Si";}else{echo "No";} ?></td>
        <td><?php if($student->publicMail){ echo "Si";}else{echo "No";} ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
