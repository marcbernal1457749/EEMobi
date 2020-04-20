<?php
class UniversitySearcherController{

    function __construct(){

        $this->view = new View();
    }

    public function loadUniversitySearcherView($parameters){
        require 'models/AssignaturesModel.php';
        require 'models/DegreesModel.php';
        require 'models/ProgramsModel.php';
        require 'models/CountriesModel.php';

        $assignaturesModel = new AssignaturesModel();
        $degreesModel = new DegreesModel();
        $programsModel = new ProgramsModel();
        $countriesModel = new CountriesModel();

        $assignatures = $assignaturesModel->getAllSubjects();
        $degrees = $degreesModel->getDegrees();
        $programs = $programsModel->getPrograms();
        $countries = $countriesModel->getCountry();

        $assignaturesModel->disconnect();
        $degreesModel->disconnect();
        $programsModel->disconnect();
        $countriesModel->disconnect();

        if(isset($_SESSION['loggedin'])){
            $logged = true;

        }else{
            $logged = false;

        }

        $route = $this->view->show("BuscadorUniversitats.php");
        include($route);
    }

}