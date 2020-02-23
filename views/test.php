	<?php include('templates/logged.php'); ?>
	<?php include('templates/HeaderAdmin.php'); ?>


	<div class="container">
		<div class="row">
			<div class="col-sm-3">

				<!-- PANELL DE PERFIL FOTO -->
				<div class="panel panel-default panel-transparent">
					<div class="panel-body panel_withoutborder">
							<div class="list-group">
							  <a href="/EEmobi/admin" class="list-group-item titul_a"></span>Panell d'administració</a>
							  <a href="javascript:void(0)" class="list-group-item UV"></span>Universitats</a>
							  <a href="javascript:void(0)" class="list-group-item ES" ></span>Estudiants</a>
							  <a href="javascript:void(0)" class="list-group-item MO"></span>Programes de mobilitat</a>
                                <!--
							  <a href="javascript:void(0)" class="list-group-item UE"></span>Universitats - Estudis</a>
							  <a href="javascript:void(0)" class="list-group-item UP"></span>Universitats - Places</a>
							  <a href="javascript:void(0)" class="list-group-item CO"></span>Convenis</a>
							  <a href="javascript:void(0)" class="list-group-item ST"></span>Estades</a>
  							  <a href="javascript:void(0)" class="list-group-item AE"></span>Acord - Estudis</a>
  							  !-->
                              <a href="javascript:void(0)" class="list-group-item AA"></span>Altres Accions</a>
							</div>

					</div>
				</div>
				<!-- PANELL DE PERFIL FOTO -->
			</div>		
			<div class="col-sm-9">
			    <div class="text-center" id="debug"> </div>
				<div class="panel panel-default" id="content">
					<div class="panel-body">
					
							<h1>Benvingut al panell d'administració</h1>
                            <div class="col-sm-12">
                                <h4 class="float-left text-muted font-italic">Selecciona una acció</h4>
                            </div>
							<div class="col-sm-12">
                                <a href="javascript:void(0)" class="list-group-item CUV" id="CUV">Crear nova universitat</a>
                                <a href="javascript:void(0)" class="list-group-item ES" ></span>Gestionar Estudiants</a>
                                <a href="javascript:void(0)" class="list-group-item AA"></span>Gestionar la Web</a>
                            </div>

					</div>

				</div>
			</div>	
		</div>
	</div>


	</body>
