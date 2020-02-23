<?php
class UserLoginController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function loginUser($parameters){
        //Incluye el modelo que corresponde
            $fail = false;
            $route = $this->view->show("loginUser.php");
            include($route);       
    }

}


?>