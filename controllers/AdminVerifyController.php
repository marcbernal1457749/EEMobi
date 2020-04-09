<?php

class AdminVerifyController
{
    function __construct(){
        
        $this->view = new View();
    }
 
    public function login($parameters){
             
        	require_once 'suport/FilterFields.php';
        	require 'models/AdminModel.php';
            $passParameter = 1;
            $userParameter = 0;
        	$adminModel = new AdminModel();
    		$user = cleanInfo($parameters[$userParameter]);
			$password = cleanInfo($parameters[$passParameter]);
			$adminUser = $adminModel->getUserAdmin($user);

    		if($adminUser==null)
    		{
    			$route = $this->view->show("loginAdmin.php");
    			$fail = true;
    		}else{
    			if(password_verify($password, $adminUser->contrasenya)){
    				$_SESSION['loggedin'] = true;
                    $_SESSION["autentificado"] = "SI";
                    $_SESSION['type'] = "admin";
    				$_SESSION['username'] = $user;
				    $_SESSION['start'] = time();
                    $_SESSION['name']= $adminUser->nomAdmin;
                    $_SESSION['nom']= $adminUser->nomAdmin;
                    $_SESSION['niu']= $adminUser->idAdmin;
                    $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

                    //Parámetros extras para funcionar bien
                    $_SESSION['admin'] = 'admin';
                    $_SESSION['stay'] = 'si';
     				//$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    				$route = $this->view->show("adminpanel.php");
    			}else{
    				$route = $this->view->show("loginAdmin.php");
    				$fail = true;
    			}
    		}
            
            
            include($route);
        }
}


?>