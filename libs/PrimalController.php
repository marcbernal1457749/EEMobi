<?php
/*Controlador pàgina principal*/
class PrimalController{
    static function main(){

        require 'libs/Sessions.php';
        require 'libs/Config.php'; //de configuracion
        require 'libs/SPDO.php'; //PDO con singleton
        require 'libs/View.php'; //Mini motor de plantillas
        require 'configDB.php'; //Archivo con configuraciones.

        $url = "$_SERVER[REQUEST_URI]";
        //echo $url;
        $url_parameters= explode("/", $url);

        if(isset($url_parameters[3])){
          $controller = $url_parameters[3];
        }else{
          $controller = $url_parameters[2];
        }
        //Lo mismo sucede con las acciones, si no hay acción, tomamos index como acción

        $parameters=array();
        switch ($controller) {
          case 'Map':
            $controllerName = "MapController";
            $actionName = $url_parameters[4];
            array_push($parameters,$url_parameters[5]); 
            if(isset($url_parameters[6])){
              array_push($parameters,$url_parameters[6]);
            }
            break;
          case 'OnChangeSelect':
            $controllerName = "OnChangeSelectController";
            $actionName = $url_parameters[4];
            array_push($parameters,$url_parameters[5]);         
            break;
          default:
            $controllerName = "IndexController";
            $actionName = "index";
            break;
        }
        
        $controllerPath = $config->get('controllersFolder') . $controllerName . '.php';

 
        //Incluimos el fichero que contiene nuestra clase controladora solicitada
        if(is_file($controllerPath)){
              require $controllerPath;
        }else{
              die('El controlador no existe');
        }
        

       
        /*if(! empty($_GET['data'])){
              $information = $_GET['data'];
              array_push($parameters, $information);
               if(! empty($_GET['type'])){
                  $type = $_GET['type'];
                  array_push($parameters, $type);
               }
               
        }else{
              array_push($parameters,$information= "");
        }*/
        
        //Si todo esta bien, creamos una instancia del controlador y llamamos a la acción
        $controller = new $controllerName();
        $controller->$actionName($parameters);

    }
}
?>