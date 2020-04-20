<?php
    require '../libs/Sessions.php';
    require '../libs/Config.php'; //de configuracion
    require '../libs/SPDO.php'; //PDO con singleton
    require '../libs/View.php'; //Mini motor de plantillas
    require '../configDB.php'; //Archivo con configuraciones.

    require_once '../models/UniversitiesModel.php';
    $universitiesModel = new UniversitiesModel();
    $areThereIds = false;

    if (isset($_POST['nameUni'])){

        $nomUni = $_POST['nameUni'];
        $destinacions = $universitiesModel->getUniversitiesByAproxName($nomUni);

    }
    if (isset($_POST['dataSent'])){


        $dataReceived = $_POST['dataSent'];
        if($dataReceived[0]['nom'] == ""){

            $destinacions = $universitiesModel->getUniversitiesByAproxNameAndDegreeSearchBlank($dataReceived[0]['grau'],$dataReceived[0]['pais']);

        }
        else{

            $destinacions = $universitiesModel->getUniversitiesByAproxNameAndDegree($dataReceived[0]['nom'],$dataReceived[0]['grau'],$dataReceived[0]['pais']);

        }
    }



    if(!empty($destinacions)){
        $areThereIds = true;
    }

    if(isset($_SESSION['loggedin'])){
        $logged = true;

    }else{
        $logged = false;

    }

    $universitiesModel->disconnect();

    require '../views/ResultatsBuscadorUni.php';
?>