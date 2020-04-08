<?php
class AdminController{
    static function main(){

        require 'libs/Sessions.php';
        require 'libs/Config.php'; //de configuracion
        require 'libs/SPDO.php'; //PDO con singleton
        require 'libs/View.php'; //Mini motor de plantillas
        require 'configDB.php'; //Archivo con configuraciones.

        $url = "$_SERVER[REQUEST_URI]";
        $url_parameters= explode("/", $url);
        $parameters=array();
        if(isset($url_parameters[3])){
          $controller = $url_parameters[3];
        }else{
          $controller = $url_parameters[2];
        }
        $controllerName = "AdminBackendController";
        switch ($controller) {
          case 'createNewUniversity':
            $actionName = $controller;
            break;

          case 'addUniAndConvenis':
            $data['infoUni'] = $_POST['infoUni'];
            if (isset($_POST['infoConvenis'])){
                $data['infoConvenis'] = $_POST['infoConvenis'];
            }
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'editaUniversitiesBackend':
            $data = $_POST['data'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

            case 'updateUniversity':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'updateConvenis':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addConveni':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'updateEstades':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addStay':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'openSubjectModal':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'editAcords':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addAcord':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeAcord':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

          case 'otherActions':
            $actionName = $controller;
            break;

            case 'getFooterAdmin':
                $actionName = $controller;
                break;

            case 'updateSectionTitles':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'updateSubSections':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addSubSection':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeSubSection':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'getUrlTesterAdmin':
                $actionName = $controller;
                break;

            case 'testUrlsUniversitat':
                $actionName = $controller;
                break;

            case 'testUrlsAssigEXT':
                $actionName = $controller;
                break;
            case 'testUrlsAssigUAB':
                $actionName = $controller;
                break;
            case 'getfailedURLUnis':
                $actionName = $controller;
                break;
            case 'getfailedURLAssigUAB':
                $actionName = $controller;
                break;
            case 'getfailedURLAssigEXT':
                $actionName = $controller;
                break;
            case 'deletefailedURL':
                $actionName = $controller;
                break;

            case 'getAuxTablesAdmin':
                $actionName = $controller;
                break;

            case 'addTableCountries':
                $data['programaPais'] = $_POST['programaPais'];
                $data['nomPais'] = $_POST['nomPais'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeTableCountries':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeTableSubjects':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeTableDegree':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeTableTeachers':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'removeTableAdmins':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addTableSubjects':
                $data['codiSubject'] = $_POST['codiSubject'];
                $data['nom'] = $_POST['nom'];
                $data['credits'] = $_POST['credits'];
                $data['url'] = $_POST['url'];
                $data['codiEstudis'] = $_POST['codiEstudis'];

                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addTableDegrees':
                $data['nom'] = $_POST['nom'];
                $data['cicle'] = $_POST['cicle'];
                $data['descripcio'] = $_POST['descripcio'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addTableTeachers':
                $data['niu'] = $_POST['niu'];
                $data['nom'] = $_POST['nom'];
                $data['cognoms'] = $_POST['cognoms'];
                $data['correu'] = $_POST['correu'];
                $data['codiEstudis'] = $_POST['codiEstudis'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'addTableAdmins':
                $data['niu'] = $_POST['niuAdmin'];
                $data['nom'] = $_POST['nomAdmin'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

            case 'updateTableCountries':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;
            case 'updateTableSubjects':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;
            case 'updateTableDegrees':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;
            case 'updateTableTeachers':
                $data = $_POST['data'];
                array_push($parameters, $data);
                $actionName = $controller;
                break;

          case 'getInformationUniversities':
            $actionName = $controller;
            break;

          case 'getInformationPrograms':
            $actionName = $controller;
            break;

          case 'getInformationStudents':
            $actionName = $controller;
            break;

          case 'getInformationUniAndDegrees':
            $actionName = $controller;
            break;

          case 'getUniversitiesPlaces':
            $actionName = $controller;
            break;

          case 'getConvenis':
            $actionName = $controller;
            break;

          case 'getEstades':
            $actionName = $controller;
            break;

          case 'getAcordsEstudis':
            $actionName = $controller;
            break;

          case 'addOrupdateInfoUniDegree':
            $data['codiUni'] = $_POST['codiUni'];
            $data['codiGrau'] = $_POST['codiGrau'];
            if(isset($_POST['codiUniGrau'])){
              $data['codiUniGrau'] = $_POST['codiUniGrau'];
            }
            
            $data['ad'] = $_POST['ad'];
            array_push($parameters, $data);

            $actionName = $controller;
            break;

          case 'deleteInfoUniDegree':
            $data['codiUniGrau'] = $_POST['codiUniGrau'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoUniPlaces':
            $data['id'] = $_POST['id'];
            $data['places'] = $_POST['places'];
            $data['mesos'] = $_POST['mesos'];
            $data['periode'] = $_POST['periode'];
            $data['actiu'] = $_POST['actiu'];
            $data['teacher'] = $_POST['professor'];
            $data['ad'] = $_POST['ad'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'deleteInfoUniPlaces':
            $data['id'] = $_POST['id'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoUniversity':
            if (empty($_POST['nom'])){
              $errors['nom'] = 'El nom és necessari.';
            }
            if (empty($_POST['latitud'])){
              $data['latitud'] = NULL;
            }else{
              $data['latitud'] = $_POST['latitud'];
            }
            if (empty($_POST['longitud'])){
              $data['longitud'] = NULL;
            }else{
              $data['longitud'] = $_POST['longitud'];
            }
            if ( ! empty($errors)) {
              header("Location:http://deic-projectes.uab.cat/EEmobi/admin.php");
              $data['success'] = false;
              $data['errors']  = $errors;
             }else {
              $data['id'] = $_POST['id'];
              $data['nom'] = $_POST['nom'];
              $data['pais'] = $_POST['pais'];
              $data['adreça'] = $_POST['adreça'];
              $data['url'] = $_POST['url'];
              $data['urlIn'] = $_POST['urlIn'];
              $data['codi'] = $_POST['codi'];
              $data['acreditacio'] = $_POST['acreditacio'];
              $data['observacions'] = $_POST['observacions'];
              $data['success'] = true;
              $data['ad'] = $_POST['ad'];
              $data['message'] = 'Success!';
             }
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'deleteUniversity':
            $data['id'] = $_POST['id'];
            $data['success'] = true;
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoStudent':
              $data['niu'] = $_POST['niu'];
              $data['nom'] = $_POST['nom'];
              $data['cognom'] = $_POST['cognom'];
              $data['correu'] = $_POST['correu'];
              $data['nompublic'] = $_POST['nompublic'];
              $data['correupublic'] = $_POST['correupublic'];
              $data['ad'] = $_POST['ad'];
              array_push($parameters, $data);
              $actionName = $controller;
            break;

          case 'deleteStudent':
            $data['niu'] = $_POST['niu'];
            $data['success'] = true;
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoProgram':
            $data['codi'] = $_POST['codi'];
            $data['nom'] = $_POST['nom'];
            $data['descripcio'] = $_POST['descripcio'];
            $data['ad'] = $_POST['ad'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'deleteProgram':
            $data['codi'] = $_POST['codi'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoConvenis':
              $data['id'] = $_POST['id'];
              $data['codiConveni'] = $_POST['codiConveni'];
              $data['ad'] = $_POST['ad'];
              array_push($parameters, $data);
              $actionName = $controller;
              break;

          case 'deleteConveni':
            $data['id'] = $_POST['id'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoEstades':
              if(isset($_POST['id'])){
                  $data['id'] = $_POST['id'];
              }

              $data['niu'] = $_POST['niu'];
              $data['codiConveni'] = $_POST['codiConveni'];
              $data['curs'] = $_POST['curs'];
              $data['semestre'] = $_POST['semestre'];
              $data['ad'] = $_POST['ad'];
              array_push($parameters, $data);
              $actionName = $controller;
            break;

          case 'deleteStay':
            $data['id'] = $_POST['id'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'addOrupdateInfoAcord':
              $data['id'] = $_POST['id'];
              $data['estada'] = $_POST['estada'];
              $data['nomDesti'] = $_POST['nomDesti'];
              $data['codiDesti'] = $_POST['codiDesti'];
              $data['creditsDesti'] = $_POST['creditsDesti'];
              $data['assignatura'] = $_POST['assignatura'];
              $data['linkDesti'] = $_POST['linkDesti'];
              $data['ad'] = $_POST['ad'];
              array_push($parameters, $data);
              $actionName = $controller;
            break;

          case 'deleteAcord':
            $data['id'] = $_POST['id'];
            array_push($parameters, $data);
            $actionName = $controller;
            break;

          case 'updatePhoto':
            if(isset($_FILES['file'])) {
                $target_dir = "./resources/img/universities/";
                $data['target_dir']=$target_dir;
                $data['target_file'] = $target_dir . basename($_FILES['file']['name']);
                $data['imageFileType'] = pathinfo($data['target_file'],PATHINFO_EXTENSION);
                $data['check'] = getimagesize($_FILES['file']['tmp_name']);
                $data['university'] = $_POST['university'];
                $data['succes']=true;
            }else{
              $data['succes']=false;
            }

            array_push($parameters, $data);
            $actionName = $controller;
            break;

          default:
              $controllerName = "AdminLoginController";
              $actionName = "login";
              break;
        }
        
        $controllerPath = $config->get('controllersFolder') . $controllerName . '.php';

 
        //Incluimos el fichero que contiene nuestra clase controladora solicitada
        if(is_file($controllerPath)){
              require $controllerPath;
        }else{
              echo $controllerPath;

              die('El controlador no existe');
        }


        //Si todo esta bien, creamos una instancia del controlador y llamamos a la acción
        $controller = new $controllerName();
        $controller->$actionName($parameters);

    }
}
?>