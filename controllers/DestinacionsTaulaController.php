<?php
    require '../libs/Sessions.php';
    require '../libs/Config.php'; //de configuracion
    require '../libs/SPDO.php'; //PDO con singleton
    require '../libs/View.php'; //Mini motor de plantillas
    require '../configDB.php'; //Archivo con configuraciones.

    if (isset($_POST['dataSent'])){
        $dataReceived = json_decode($_POST['dataSent'], true);
    }
    $areThereIds = false;
    require_once '../models/UniversitiesModel.php';

    $assignaturesModel = new UniversitiesModel();

    if (count($dataReceived['ids']) > 0){

        if($dataReceived['program'] < 0){
            $assignaturesSeleccionades = $assignaturesModel->getUniversitiesBySubjectIdAndTypeOfSearch($dataReceived['search'], $dataReceived['ids']);
        }else{
            $assignaturesSeleccionades =
                $assignaturesModel->getUniversitiesBySubjectIdTypeOfSearchAndProgram($dataReceived['search'],$dataReceived['program'], $dataReceived['ids']);
        }

    }

    if(!empty($assignaturesSeleccionades)){
        $areThereIds = true;
    }

    if(isset($_SESSION['loggedin'])){
        $logged = true;

    }else{
        $logged = false;

    }

    $assignaturesModel->disconnect();

    require '../views/DestinacionsTaula.php';
?>