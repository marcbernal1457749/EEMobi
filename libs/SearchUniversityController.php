<?php
class SearchUniversityController
{

    static function main()
    {

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
        $controllerName = "UniversitySearcherController";
        switch ($controller) {
            case 'SearchUniversity':
                $actionName = "loadUniversitySearcherView";
                break;

            default:
                $controllerName = "IndexController";
                $actionName = "index";
                break;
        }
        $controllerPath = $config->get('controllersFolder') . $controllerName . '.php';

        //Incluimos el fichero que contiene nuestra clase controladora solicitada
        if (is_file($controllerPath)) {
            require $controllerPath;
        } else {
            echo $controllerPath;

            die('El controlador no existe');
        }
        //Si todo esta bien, creamos una instancia del controlador y llamamos a la acción
        $controller = new $controllerName();
        $controller->$actionName($parameters);


    }
}
?>