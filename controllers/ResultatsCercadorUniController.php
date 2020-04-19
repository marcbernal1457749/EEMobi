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
        echo "Entro1";
        $nomUni = $_POST['nameUni'];
        $destinacions = $universitiesModel->getUniversitiesByAproxName($nomUni);
        var_dump($destinacions);
    }
    if (isset($_POST['dataSent'])){
        echo "Entro2";

        $dataReceived = $_POST['dataSent'];
        if($dataReceived[0]['nom'] == ""){
            echo "Entro21";
            $destinacions = $universitiesModel->getUniversitiesByAproxNameAndDegreeSearchBlank($dataReceived[0]['grau'],$dataReceived[0]['pais']);
            var_dump($destinacions);
        }
        else{
            echo "Entro2";
            $destinacions = $universitiesModel->getUniversitiesByAproxNameAndDegree($dataReceived[0]['nom'],$dataReceived[0]['grau'],$dataReceived[0]['pais']);
            var_dump($destinacions);
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