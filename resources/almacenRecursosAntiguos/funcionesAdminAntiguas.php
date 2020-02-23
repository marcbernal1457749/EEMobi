<?php
class funcionesAdminAntiguas{

    public function addOrupdateInfoUniversity($parameters){
        require 'models/UniversitiesModel.php';
        require 'models/CountriesModel.php';
        $universitymodel = new UniversitiesModel();
        $countriesModel = new CountriesModel();
        $data = $parameters[0];
        $country = $countriesModel->getCountryIdByName($data['pais']);
        $countriesModel->disconnect();
        $adOrUpdate=$data['ad'];
        if(!empty($country)){
            if($adOrUpdate){
                $universitymodel->addUniversity($data['id'],$data['nom'],$data['adreça'],$data['latitud'],$data['longitud'],$data['url'],$data['urlIn'],$data['codi'],$data['acreditacio'],$data['observacions'],$data['observacions'],$country->idPais);

            }else{

                $universitymodel->updateUniversityById($data['id'],$data['nom'],$data['adreça'],$data['latitud'],$data['longitud'],$data['url'],$data['urlIn'],$data['codi'],$data['acreditacio'],$data['observacions'],$data['observacions'],$country->idPais);
            }
        }
        $universitymodel->disconnect();
        echo json_encode($data);

    }
}
?>