<?php
class ProfileController{
    static function main(){
        require 'libs/Sessions.php';
        require 'libs/Config.php'; //de configuracion
        require 'libs/SPDO.php'; //PDO con singleton
        require 'libs/View.php'; //Mini motor de plantillas
        require 'configDB.php'; //Archivo con configuraciones.
        $url = "$_SERVER[REQUEST_URI]";
        $url_parameters= explode("/", $url);
        if(isset($url_parameters[3])){
          $controller = $url_parameters[3];
        }else{
          $controller = $url_parameters[2];
        }

        $parameters=array();
        $controllerName = "PerfilUsuariController";
        switch ($controller) {
          case 'Perfil':
            $actionName = "showProfile";          
            break;
          case 'editProfile':
            $actionName = "editProfile";
            break;
          case 'openFormPopup':
            $actionName = "openFormPopup";
            if(isset($url_parameters[4])){
              $data['idUniversitat'] = $url_parameters[4];
              array_push($parameters,$data);  
            }
            break;
          case 'openFormAcord':
            $actionName = "openFormAcord";
            if(isset($url_parameters[4])){
              $data['idConveni'] = $url_parameters[4];
              array_push($parameters,$data);  
            }
            break;

            case 'firstRatings':
                $actionName = "firstRatings";
                $data['idStay'] = $_POST['data'];
                array_push($parameters,$data);
                break;

            case 'editRating':
                $actionName = "editRating";
                $data['infoRating'] = $_POST['data'];
                array_push($parameters,$data);
                break;

            case 'filtrarAcordsAdmin':
                $actionName = "filtrarAcordsAdmin";
                $data['data'] = $_POST['data'];
                array_push($parameters,$data);
                break;

          case 'orderPublicationsByFilter':
            $controllerName = "InformationUniversityController";
            $actionName = "orderPublicationsByFilter";
              $data['idCat'] = $_POST['idCat'];
              $data['idUni'] = $_POST['university'];
              $data['idData'] = $_POST['data'];
            array_push($parameters, $data);
            break;

            case 'publicationsByCategory':
                $controllerName = "InformationUniversityController";
                $actionName = "publicationsByCategory";
                $data['idCat'] = $_POST['id'];
                $data['idUni'] = $_POST['university'];
                $data['idData'] = $_POST['data'];
                array_push($parameters, $data);
                break;

          case 'addPublication':
            $actionName = "addPublication";
            if(isset($_FILES['file'])) {
                $target_dir = "./resources/img/post/";
                $data['target_dir']=$target_dir;
                $data['target_file'] = $target_dir . basename($_FILES['file']['name']);
                $data['imageFileType'] = pathinfo($data['target_file'],PATHINFO_EXTENSION);
                $data['check'] = getimagesize($_FILES['file']['tmp_name']);
                $data['isFile'] = true;            
            }
            if(empty($_POST['idUni'])||empty($_POST['text'])){
              $data['succes']=false; 

            }else{
              $data['idUniversitat'] = $_POST['idUni'];
              $data['idCategoria'] = $_POST['idCat'];
              $data['text'] = $_POST['text'];
              $data['succes']=true;  
            }
            array_push($parameters, $data);
            break;
          case 'deletePublication':
            $data['idPublicacio'] = $_POST['idToDelete'];
            $actionName = "deletePublication";
            array_push($parameters, $data);
            break;
          case 'updatePhoto':
            if(isset($_FILES['file'])) {
                $target_dir = "./resources/img/profiles/"; ///var/www/EEmobi/resources/img/profiles/
                $data['target_dir']=$target_dir;
                $data['target_file'] = $target_dir . basename($_FILES['file']['name']);
                $data['imageFileType'] = pathinfo($data['target_file'],PATHINFO_EXTENSION);
                $data['check'] = getimagesize($_FILES['file']['tmp_name']);
                $data['succes']=true;               
            }else{

              $data['succes']=false;

            }
            array_push($parameters, $data);
            $actionName="editPhoto";
            break;
          case 'updateInfo':
            if (empty($_POST['name'])){
              $errors['name'] = 'Name is required.';
            }

            if (empty($_POST['surname'])){
              $errors['surname'] = 'surname is required.';
            }

            if (empty($_POST['mail'])){
              $errors['mail'] = 'Email is required.';
            }
            if (empty($_POST['nompublic'])){
              $errors['nompublic'] = 'Nom public is required.';
            }

            if (empty($_POST['correupublic'])){
              $errors['correupublic'] = 'correupublic';
            }
            if (!empty($errors)) {

              $data['success'] = false;
              $data['errors']  = $errors;
             }else {
              $data['name'] = $_POST['name'];
              $data['surname'] = $_POST['surname'];
              $data['mail'] = $_POST['mail'];
              $data['nompublic'] = $_POST['nompublic'];
              $data['correupublic'] = $_POST['correupublic'];
              $data['success'] = true;
              $data['message'] = 'Success!';
             }
             array_push($parameters, $data);
            $actionName = "verifyUpdate";
            break;
          case 'addAgreement':
              $data['codiEstada'] = $_POST['codiEstada'];
              $data['nomDesti'] = $_POST['nomDesti'];
              $data['linkDesti'] = $_POST['linkDesti'];
              $data['codiDesti'] = $_POST['codiDesti'];
              $data['creditsDesti'] = $_POST['creditsDesti'];
              $data['assignatura'] = $_POST['assignatura'];
              array_push($parameters, $data);
              $actionName = "addAgreement";
            break;
          default:
            $controllerName = "IndexController";
            $actionName = "index";
            break;
        }        
        $controllerPath = $config->get('controllersFolder') . $controllerName . '.php'; 
        if(is_file($controllerPath)){
              require $controllerPath;
        }else{
              die('El controlador no existe');
        }
        $controller = new $controllerName();
        $controller->$actionName($parameters);

    }
}
?>