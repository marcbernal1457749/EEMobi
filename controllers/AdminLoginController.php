<?php
class AdminLoginController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function login($parameters){
        //Incluye el modelo que corresponde
            $fail = false;

            if(!isset($_SESSION['admin'])){
        	   $route = $this->view->show("loginAdmin.php");
            }else{
               $route = $this->view->show("adminpanel.php");
            }
            
            include($route);  

    }

}


?>