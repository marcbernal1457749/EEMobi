<?php
class View
{
    function __construct()
    {
    }
    private  $rute;
    public function show($name)
    {
        //$name es el nombre de nuestra plantilla, por ej, listado.php
        //$vars es el contenedor de nuestras variables, es un arreglo del tipo llave => valor, opcional.
 
        //Traemos una instancia de nuestra clase de configuracion.
        $config = Config::getInstance();
 
        //Armamos la ruta a la plantilla
        global $rute;
        $rute = $config->get('viewsFolder') . $name;
 
        //Si no existe el fichero en cuestion, mostramos un 404
        if (file_exists($rute) == false)
        {
            //trigger_error ('Template `' . $rute . '` does not exist.', E_USER_NOTICE);
            return false;
        }
        return $rute;

    }
    
}

?>