<?php
class SubjetSearcherController{

    function __construct(){

        $this->view = new View();
    }

    public function loadSubjectSearcherView($parameters){
        require 'models/AssignaturesModel.php';
        require 'models/DegreesModel.php';
        require 'models/ProgramsModel.php';

        $assignaturesModel = new AssignaturesModel();
        $degreesModel = new DegreesModel();
        $programsModel = new ProgramsModel();

        $assignatures = $assignaturesModel->getAllSubjects();
        $degrees = $degreesModel->getDegrees();
        $programs = $programsModel->getPrograms();

        $assignaturesModel->disconnect();
        $degreesModel->disconnect();
        $programsModel->disconnect();

        if(isset($_SESSION['loggedin'])){
            $logged = true;

        }else{
            $logged = false;

        }

        $route = $this->view->show("BuscadorAssignatures.php");
        include($route);
    }

}