<?php
class MapController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function mapByProgram($parameters){
        if($parameters[0]!=-1){

            require 'models/UniversitiesModel.php';
            $principal = new UniversitiesModel();
            $universitis = $principal->getUniversityByProgram($parameters[0]);
            $principal->disconnect();                    
            echo  $universitis;
       }

    }
    public function mapByCountry($parameters){
        if($parameters[0]!=-1){
            require 'models/UniversitiesModel.php';
            $principal = new UniversitiesModel();
            $universitis = $principal->getUniversityByIdCountry($parameters[0]);
            $principal->disconnect(); 
            echo  $universitis;
        }
    }
    public function mapByDegree($parameters){
        if($parameters[0]!=-1){
            require 'models/UniversitiesModel.php';
            $principal = new UniversitiesModel();
            if($parameters[0]==9999999){
                $universitis = $principal->getAllUniversites();
            }else{
                $universitis = $principal->getUniversityByDegree($parameters[0]);
            }

            $principal->disconnect(); 
            echo  $universitis;
        }
    }

    public function mapBySubject($parameters){
        if($parameters[0]!=-1){
            require 'models/UniversitiesModel.php';
            $principal = new UniversitiesModel();
            if($parameters[0]==9999999){
                $universitis = $principal->getAllUniversites();
            }else{
                $universitis = $principal->getUniversityBySubject($parameters[0]);
            }

            $principal->disconnect();
            echo  $universitis;
        }
    }

    public function mapByDegreeAndCountry($parameters){
        if($parameters[0]!=-1){
            require 'models/UniversitiesModel.php';
            $principal = new UniversitiesModel();
            $universitis = $principal->getUniversityByCountryandDegree($parameters[0],$parameters[1]);
            $principal->disconnect(); 
            echo  $universitis;
        }
    }
    public function mapByProgramAndDegree($parameters){
        if($parameters[0]!=-1){
            require 'models/UniversitiesModel.php';
            $principal = new UniversitiesModel();
            $universitis = $principal->getUniversityByProgramAndDegree($parameters[0],$parameters[1]);
            $principal->disconnect(); 
            echo  $universitis;
        }
    }

}
?>