 <?php
 if($logged){
     include('templates/HeaderUser.php');
 }else{
     include('templates/Header.php');
 }?>
    <section id="features" class="features sections">
        <h3 class="titulo">Troba la teva destinació:</h3> <br />

        <!-- TODO: COPIAR Modal aquí -->

        <div class="col-sm-12">
            <div class="panel panel-info panel-custom">
                <div class="custom-panel panel-heading">
                    <div class="row"> <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="sel1">Programa Mobilitat:</label>
                                <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectProgram" >
                                    <option value="-1">Selecciona un programa </option>
                                    <?php foreach($programs as $program): ?>
                                        <option value="<?php echo $program->codiPrograma; ?>"><?php echo $program->nom; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4 co">
                            <div class="form-group">
                                <label for="sel1">País Destinació:</label>
                                <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectCountry" >
                                    <option value="-1">Selecciona un país </option>
                                    <?php foreach($countries as $country): ?>
                                        <option value="<?php echo $country->idPais; ?>"><?php echo $country->nomPais; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4 de">
                            <div class="form-group">
                                <label for="sel1">Grau:</label>
                                <select class="selectpicker form-control" data-live-search="true" data-size="5" id="selectDegree" >
                                    <option value="-1">Selecciona un grau </option>
                                    <?php foreach($degrees as $degree): ?>
                                        <option value="<?php echo $degree->codiEstudis; ?>"><?php echo $degree->nomGrau; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="map">
                    </div>
                </div>
            </div>
        </div>

    </section>
 <section id="footer-menu" class="sections footer-menu">
     <div class="container">
         <div class="row">
             <div class="footer-menu-wrapper">
                 <div class="col-md-8 col-sm-12 col-xs-12">
                     <?php
                     foreach ($footerInfo as $section):
                     $subSections = $footerSubSections[$section['footerId']-1];
                     ?>
                     <div class="col-md-4 col-sm-6 col-xs-12">
                         <div class="menu-item">

                             <h5><?php echo $section['titolSeccio'] ?></h5>
                             <ul>
                                 <?php foreach ($subSections as $subSection): ?>
                                 <li><a href="<?php echo $subSection['urlApartat']?>"><?php echo $subSection['titolApartat']?></a></li>
                                 <?php endforeach; ?>
                             </ul>
                         </div>
                     </div>
                     <?php endforeach; ?>
             </div>

             <div class="col-md-4 col-sm-12 col-xs-12">
                 <div class="col-md-12 col-sm-6 col-xs-12">
                     <div class="menu-item">
                         <h5>Rep noticies</h5>
                         <div class="input-group">
                             <input type="text" class="form-control" placeholder="Entra el correu electrònic">
                             <input type="submit" class="form-control" value="Enviar">
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>



 <footer id="footer" class="footer">
     <div class="container">
         <div class="row">
             <div class="footer-wrapper">
                 <p class="drets text-center"> © 2020 Universitat Autònoma de Barcelona - &nbsp;<img src="resources/img/uab.png" alt="logo"/> </p>
             </div>
         </div>
     </div>
 </footer>

 <div class="scrollup">
     <a href="#"><i class="fa fa-chevron-up"></i></a>
 </div>

 <script src="resources/js/vendor/jquery-1.11.2.min.js"></script>
 <script src="resources/js/vendor/bootstrap.min.js"></script>
 <script src="resources/js/plugins.js"></script>
 <script src="resources/js/main.js"></script>
 </body>
 </html>