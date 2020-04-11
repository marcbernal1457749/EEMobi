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

        $parameters = array();
        $controllerName = "UniversitySearcherController";
        $actionName = "loadUniversitySearcherView";

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