<?php
class InformationController{
    static function main(){

        require 'libs/Sessions.php';
        require 'libs/Config.php'; //de configuracion
        require 'libs/SPDO.php'; //PDO con singleton
        require 'libs/View.php'; //Mini motor de plantillas
        require 'configDB.php'; //Archivo con configuraciones.
        
        $parameters=array();
        if(isset($_SESSION['loggedin'])){
          $controllerName = "InformationUniversityController";
          $actionName = "showInfo";
          if(isset($_GET['id'])){
            $id = $_GET['id'];
            array_push($parameters, $id);
            if(isset($_GET['degree'])){
              array_push($parameters,$_GET['degree']);
     
            }
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

        }else{
            include '/EEmobi/views/404.php';

        }


    }
}
?>