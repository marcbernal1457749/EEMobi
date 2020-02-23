<?php
class IndexController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function index($parameters){

        require_once 'models/DegreesModel.php';
        require_once 'models/CountriesModel.php';
        require_once 'models/ProgramsModel.php';
        require_once 'models/AssignaturesModel.php';
        require_once 'models/AdminManagmentModel.php';

        $programsModel = new ProgramsModel();
        $degreesModel = new DegreesModel();
        $countriesModel = new CountriesModel();
        $assignaturesModel = new AssignaturesModel();
        $adminManagmentModel = new AdminManagmentModel();

        $programs = $programsModel->getPrograms();
        $countries =$countriesModel->getCountry();
        $degrees = $degreesModel->getDegrees();
        $assignatures = $assignaturesModel->getAllSubjects();
        $footerInfo = $adminManagmentModel->getFooterInfo();
        $footerSubSections = [];


        foreach ($footerInfo as $footerSection){
            array_push($footerSubSections, $adminManagmentModel->getSubSectionsById($footerSection['footerId']));
        }

        $programsModel->disconnect();
        $degreesModel->disconnect();
        $countriesModel->disconnect();
        $assignaturesModel->disconnect();
        $adminManagmentModel->disconnect();

        if(isset($_SESSION['loggedin'])){
            $logged = true;          
            
        }else{
            $logged = false;
            
        }
        $route = $this->view->show("PaginaPrincipal.php");
        include($route);
    }

}
?>