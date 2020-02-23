<table class="table" id="FullTable">
    <thead class="thead-dark">
    <tr>
        <th scope="col" align="center" class="sortTables">Nom Universitat<a href="#"><img width="20" height="20" src="./resources/images/sort_both.png"></a></th>
        <th scope="col" align="center" class="sortTables">País<a href="#"><img width="20" height="20" src="./resources/images/sort_both.png"></a></th>
        <th scope="col" align="center">Pàgina principal</th>
        <th scope="col" align="center">Pàgina intercanvis</th>
        <th scope="col" align="center">Més informació</th>
    </tr>
    </thead>
    <tbody id="destinationsTable">
<?php if(!$areThereIds) { ?>
    <tr>
        <td colspan="6" class="text-muted"><p class="text-center">Encara no existeixen Universitats amb aquesta combinació d'assignatures</p></td>
    </tr>
<?php }else{
       foreach($assignaturesSeleccionades as $assignatura) : ?>
           <tr>
               <td><?php echo $assignatura['nomUniversitat']; ?></td>
               <td id="nomPais"><?php echo $assignatura['nomPais']; ?></td>
               <td align="center" valign="middle">
                   <a href="<?php echo $assignatura['urlUniversitat']; ?>"><img width="50" height="50" src="./resources/images/85ce86c19e.png"></a>
               </td>
               <td align="center" valign="middle">
                   <a href="<?php echo $assignatura['urlIntercanvis']; ?>"><img width="50" height="50" src="./resources/images/exange.png"></a></td>
               <td align="center" valign="middle">
                   <?php if($logged){?>

                        <form action="./information.php" method="get" target="_blank" id="formMesInfo">
                            <input type="hidden" name="id" value="<?php echo $assignatura['idUniversitat'];?>">
                            <input type="hidden" id="degreeselect" name="degree" value="Tots-els-graus" >
                            <a href="javascript:;" onclick="$(this).closest('form').submit();"><img width="50" height="50" src="./resources/images/plus.png"></a>
                        </form>
               </td>

                   <?php }else{ ?>
                       <form action="./login.php" method="post">
                           <button type="submit" class="btn btn-primary btn-lg btn-block button-id button-custom" value="">Identifica't</button>
                       </form>
                    <?php } ?>
           </tr>
    <?php endforeach; ?>

<?php } ?>
    </tbody>
</table>
