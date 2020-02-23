<?php
class OnChangeSelectController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function countriesByProgram($parameters){
        //Incluye el modelo que corresponde

        require 'models/CountriesModel.php';
        $countriesModel = new CountriesModel();
        $countries =$countriesModel->getCountryByProgram($parameters[0]);
        if(count($countries)==1){
            $onlyOne=true;

        }else{
            $onlyOne=false;
        }
        $countriesModel->disconnect();
        $route = $this->view->show("selectCountries.php");
        include($route);
    }
    public function degreesByCountry($parameters){
        require 'models/DegreesModel.php';
        $degreesModel = new DegreesModel();
        $degrees =$degreesModel->getDegreesByCountry($parameters[0]);
        $idCountry = $parameters[0];
        $degreesModel->disconnect();
        $route = $this->view->show("selectDegrees.php");
        include($route);
    }

    public function countriesBySubject($parameters){
        require 'models/CountriesModel.php';
        $countriesModel = new CountriesModel();
        $countries =$countriesModel->getCountryByProgram($parameters[0]);
        if(count($countries)==1){
            $onlyOne=true;

        }else{
            $onlyOne=false;
        }
        $countriesModel->disconnect();
        $route = $this->view->show("selectCountries.php");
        include($route);
    }


    public function subjectsByDegree($parameters){
        require 'models/AssignaturesModel.php';

        $assignaturesModel = new AssignaturesModel();

        $assignatures = $assignaturesModel->getSubjectsByDegree($parameters[0]);

        $assignaturesModel->disconnect();
        $route = $this->view->show("selectSubjects.php");
        include($route);
    }

    public function subjectsByProgram($parameters){
        require 'models/AssignaturesModel.php';
        require 'models/CountriesModel.php';
        require 'models/DegreesModel.php';

        $assignaturesModel = new AssignaturesModel();
        $countriesModel = new CountriesModel();
        $degreesModel = new DegreesModel();

        $paises = $countriesModel->getCountryByProgram($parameters[0]);
        $degrees = array();
        $assignatures = array();

        foreach ($paises as $pais){
            $degrees = array_merge($degreesModel->getDegreesByCountry($pais->idPais), $degrees);
        }
        $degrees = array_unique($degrees, SORT_REGULAR);

        foreach ($degrees as $degree){
            $assignatures = array_merge($assignaturesModel->getSubjectsByDegree($degree->codiEstudis), $assignatures);
        }
        $assignatures = array_unique($assignatures, SORT_REGULAR);

        $assignaturesModel->disconnect();
        $route = $this->view->show("selectSubjects.php");
        include($route);
    }


}
?>