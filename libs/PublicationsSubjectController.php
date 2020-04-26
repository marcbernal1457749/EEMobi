<?php
class PublicationsSubjectController
{

    static function main()
    { require 'libs/Sessions.php';
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
        $controllerName = "SubjectPublicationsController";
        switch ($controller) {
            case 'subjectPublications':
                $actionName = "showSubjectPublications";
                $data = $_POST['data'];
                array_push($parameters, $data);
                break;
            case 'deletePublication':
                $data['idPublicacio'] = $_POST['idToDelete'];
                $actionName = "deletePublication";
                array_push($parameters, $data);
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