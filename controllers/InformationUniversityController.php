<?php
class InformationUniversityController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function showInfo($parameters){
        //Incluye el modelo que corresponde
        header("Cache-Control: no-store, must-revalidate, max-age=0");
        $idUniversity = $parameters[0];
        $degree = $parameters[1];
        $noInfo = false;

        $pathPhotos = "\EEmobi\\resources\img\post\\";
        $pathPhotoProfile = "\EEmobi\\resources\img\profiles\\";
        require 'models/UniversitiesModel.php';
        require 'models/StateModel.php';
        require 'models/DegreesModel.php';
        require 'models/TeachersModel.php';
        require 'models/RatingsModel.php';


        $universitymodel = new UniversitiesModel();
        $stateInfo = new StateModel();
        $degreeModel = new DegreesModel();
        $teachersModel = new TeachersModel();
        $ratingsModel = new RatingsModel();


        $categories = $ratingsModel->getCategories();
        $ratings = $ratingsModel->getRatingsByUni($idUniversity);


        $degreeSelected = false;
        if(strcmp($degree,"Tots-els-graus")==0){
            $info = $stateInfo -> getAllInfo($idUniversity);
            $teacher = $teachersModel -> getTeachersOfUniversity($idUniversity);
        }else{
            $infoCenter = "placen";
            $degree = str_replace("-"," ",$degree);
            $degreeName = $degree;
            $degree = $degreeModel -> getDegreeByName($degree);
            $degreeModel -> disconnect();

            if(!empty($degree)){
                $degreeSelected = true;
                $info = $stateInfo -> getAllInfoByDegree($idUniversity,$degree);
                $infoCenter = $stateInfo->getInfoCentreEstudis($idUniversity,$degree);
                $teacher =  $teachersModel -> getTeacherByDegree($degree,$idUniversity);
            }else{
                $info = $stateInfo -> getAllInfo($idUniversity);
                $teacher = $teachersModel -> getTeachers();

            }
            $stateInfo->disconnect();

        }
        $university = $universitymodel -> getUniversityById($idUniversity);
        $universitymodel->disconnect();
       if(!empty($university)){
            require_once 'models/PublicationsModel.php';
            $publicationsModel = new PublicationsModel();
            $publications = $publicationsModel -> getPublicationOfUniversity($idUniversity);
            
            if($university->fotoPath=="" or $university->fotoPath==null ){
                $path = "/EEmobi/resources/img/universities/notimage.jpg";
            }else{
                $path = "/EEmobi/resources/img/universities/".$university->fotoPath;
            }
            
            if(empty($info)){
                $noInfo = true;
            }

            $areRatings = false;
            $totalValorations = 0;

            if(!empty($ratings)){
                $areRatings = true;
                $valorations = array();
                $sumValoracions = 0;
                $nValoracions = 0;



                for ($i=1, $size= count($categories); $i < $size; $i++){
                    foreach ($ratings as $key=>$value){
                        if($value['idCategoria'] == $categories[$i]['idCategoria']){
                            $sumValoracions += $value["score"];
                            $nValoracions++;

                            unset($ratings[$key]);
                        }
                    }

                    $totalValorations = $nValoracions;
                    $valorations[$categories[$i]['titolCategoria']] = round($sumValoracions/$nValoracions, 0, PHP_ROUND_HALF_UP);
                    $sumValoracions = 0;
                    $nValoracions = 0;
                }

                $valorations['General'] = round(array_sum($valorations)/count($valorations), 0, PHP_ROUND_HALF_UP);
            }

            $route = $this->view->show("UniversityInfo.php");

            include($route);
        }else{
           include '../EEmobi/views/404.php';
        }
    }
    public function orderPublicationsByFilter($parameters){
        require_once 'models/PublicationsModel.php';
        require_once 'models/RatingsModel.php';
        $route = $this->view->show("PublicationsByFilter.php");
        $data = $parameters[0];
        $pathPhotos = "\EEmobi\\resources\img\post\\";
        $pathPhotoProfile = "\EEmobi\\resources\img\profiles\\";
        $publicationsModel = new PublicationsModel();
        $ratingsModel = new RatingsModel();

        $publications = $publicationsModel -> getPublicationsByFilter($data['idUni'],$data['idData'], $data['idCat']);
        $categories = $ratingsModel->getCategories();
        include($route);
    }

    public function publicationsByCategory($parameters){
        $idCategoria = $parameters[0]['idCat'];
        $idUni = $parameters[0]['idUni'];

        require 'models/PublicationsModel.php';
        require 'models/RatingsModel.php';

        $publicationsModel = new PublicationsModel();
        $ratingsModel = new RatingsModel();

        $pathPhotos = "\EEmobi\\resources\img\post\\";
        $pathPhotoProfile = "\EEmobi\\resources\img\profiles\\";

        if($idCategoria == -1){
            $publications = $publicationsModel->getPublicationOfUniversity($idUni);
        } else {
            $publications = $publicationsModel->getPublicationOfUniversityAndCategory($idUni, $idCategoria);
        }
        $categories = $ratingsModel->getCategories();

        $route = $this->view->show("PublicationsByFilter.php");

        $publicationsModel->disconnect();
        $ratingsModel->disconnect();

        include ($route);
    }


}
?>